<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column]
    private array $illustrations = [];

    #[ORM\Column]
    private array $videos = [];

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private ?string $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE)]
    private ?string $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getIllustrations(): array
    {
        return $this->illustrations;
    }

    public function setIllustrations(array $illustrations): static
    {
        $this->illustrations = $illustrations;

        return $this;
    }

    public function getVideos(): array
    {
        return $this->videos;
    }

    public function setVideos(array $videos): static
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     */
    public function setUpdatedAt(?string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
