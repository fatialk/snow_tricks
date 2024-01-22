<?php

namespace App\Service;

use App\Form\RegistrationFormType;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MediaService
{

    public $slugger;

    function __construct(SluggerInterface $slugger){

        $this->slugger = $slugger;

    }

    public function moveUploadedFile(UploadedFile $file, String $directory): String
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        // Move the file to the directory where avatar is stored
        try {
        $file->move($directory, $newFilename);

        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $newFilename;

    }



}