<?php

namespace App\Entity;

use DateTime;
use App\Entity\Image;
use App\Entity\Video;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TrickRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(name: 'unique_name', columns: ['name'])]
class Trick
{


    #[Groups('trick')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[Groups('trick')]
    #[ORM\Column(length: 255)]
    private string $name;


    #[Groups('trick')]
    #[ORM\Column(length: 255)]
    public $category;

    #[Groups('trick')]
    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[Groups('trick')]
    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[Groups('trick')]
    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tricks')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private ?User $user;

    #[Groups('trick')]
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'trick', orphanRemoval: true)]
    private Collection $comments;

    #[Groups('trick')]
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'trick', orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $images;

    #[Groups('trick')]
    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'trick', orphanRemoval: true, cascade: ['persist', 'remove'])]
    private ?Collection $videos = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }


    public function addComment(Comment $comment): self
    {
        if (!$this->comments?->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments?->contains($comment)) {
            $this->comments?->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos?->contains($video)) {
            $this->videos[] = $video;
            $video->setTrick($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos?->contains($video)) {
            $this->videos?->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getTrick() === $this) {
                $video->setTrick(null);
            }
        }

        return $this;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images?->contains($image)) {
            $this->images[] = $image;
            $image->setTrick($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images?->contains($image)) {
            $this->images?->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getTrick() === $this) {
                $image->setTrick(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTime();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new DateTime();
    }


    /**
     * Get the value of comments
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @return  self
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get the value of images
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * Set the value of images
     */
    public function setImages(Collection $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get the value of videos
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    /**
     * Set the value of videos
     */
    public function setVideos(Collection $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}

// enum Category: string {
//     case Cat1 = 'Butter tricks';
//     case  Cat2   = 'Grabs';
//     case  Cat3   = 'Spins, flips and corks';
//     case  Cat4   = 'Rails and boxes';
// }