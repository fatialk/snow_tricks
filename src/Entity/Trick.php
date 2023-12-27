<?php

namespace App\Entity;

use DateTime;
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
    #[ORM\Column]
    private array $illustrationsFilenames = [];

    #[Groups('trick')]
    #[ORM\Column]
    private array $videos = [];

    #[Groups('trick')]
    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[Groups('trick')]
    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tricks')]
    #[ORM\JoinColumn(name:"user_id", referencedColumnName:"id", nullable:false)]
    private ?User $user;

    #[Groups('trick')]
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'trick', orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    public function getIllustrationsFilenames(): array
    {
        return $this->illustrationsFilenames;
    }

    public function setIllustrationsFilenames(array $illustrationsFilenames): self
    {
        $this->illustrationsFilenames = $illustrationsFilenames;

        return $this;
    }

    public function getVideos(): array
    {
        return $this->videos;
    }

    public function setVideos(array $videos): self
    {
        $this->videos = $videos;

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
}

// enum Category: string {
//     case Cat1 = 'Butter tricks';
//     case  Cat2   = 'Grabs';
//     case  Cat3   = 'Spins, flips and corks';
//     case  Cat4   = 'Rails and boxes';
// }