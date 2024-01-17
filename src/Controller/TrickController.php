<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;
use App\Form\TrickType;
use App\Form\CommentType;
use Symfony\Component\Form\Form;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/trick')]
class TrickController extends AbstractController
{
    #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trick_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->saveMedia($trick, $form, $slugger);
            $slug = strtolower($slugger->slug($trick->getName()));
            $trick->setSlug($slug);
            $trick->setUser($this->getUser());
            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trick/new.html.twig', [
            'form' => $form,

        ]);
    }

    #[Route('/{id}/{slug}', name: 'app_trick_show', methods: ['GET'], requirements: ['id' => '\d+', 'slug'=> '.+'])]
    public function show(Trick $trick): Response
    {

        $form = $this->createForm(CommentType::class, new Comment(), ['action' => $this->generateUrl('app_comment_new',['id'=> $trick->getId()])]);
        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {

        $form = $this->createForm(TrickType::class, $trick);
        foreach($trick->getImages() as $key => $image)
        {
            $imagePath = $this->getParameter('trick_directory').'/'.$image->getFileName();
            $imageFile = new File($imagePath);
            $form->get('images')[$key]->get('image')->setData($imageFile);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveMedia($trick, $form, $slugger);
            $slug = strtolower($slugger->slug($trick->getName()));
            $trick->setSlug($slug);
            $entityManager->flush();
            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trick_delete', methods: ['DELETE'])]
    public function delete(Request $request, Trick $trick, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($trick);
        $entityManager->flush();
        return new JsonResponse(['status'=>'success']);
    }

    private function saveMedia(Trick $trick, FormInterface $form, SluggerInterface $slugger)
    {
        $videos = $form->get('videos')->getData();
        if (!empty($videos)) {
            foreach($videos as $video)
            {
                if(!empty($video->getLink()))
                {
                    $video->setTrick($trick);
                    $trick->addVideo($video);
                }

            }
        }
        // @var UploadedFile $illustratrionsFiles //
        $formImages = $form->get('images');

        // this condition is needed because the 'avatar' field is not required
        // so the file must be processed only when a file is uploaded
        foreach($formImages as $key=>$formImage)
        {
            $imageFile = $formImage->get('image')->getData();
            if(empty($imageFile))
            {
                continue;
            }

            //   $pic = $imageForm->get('name')->getData();
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
            // Move the file to the directory where brochures are stored
            try {
                $imageFile->move(
                    $this->getParameter('trick_directory'),
                    $newFilename
                );

                $image = $trick->getImages()[$key];
                $image->setFileName($newFilename);
                $image->setTrick($trick);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }

    }
}


