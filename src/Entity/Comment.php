<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[Groups('comment')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('comment')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[Groups('comment')]
    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[Groups('comment')]
    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $updatedAt = null;


    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(name: "trick_id", referencedColumnName: "id", nullable: false)]
    private ?Trick $trick;


    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private ?User $user;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCreatedAt(): ?string
    {
        if (!$this->createdAt) {
            return $this->createdAt;
        }
        return $this->createdAt->format('l jS \o\f F Y at h:i:s A');
    }
    public function getUpdatedAt(): ?string
    {
        if (!$this->updatedAt) {
            return $this->updatedAt;
        }
        return $this->updatedAt->format('l jS \o\f F Y at h:i:s A');
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
     * Get the value of comment
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
