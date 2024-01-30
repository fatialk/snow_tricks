<?php

namespace App\Entity;

use App\Entity\Trick;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[Groups('image')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('image')]
    #[ORM\Column(length: 255)]
    private string $fileName;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'images')]
    #[ORM\JoinColumn(name: "trick_id", referencedColumnName: "id", nullable: false)]
    private ?Trick $trick;



    /**
     * Get the value of trick
     */
    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    /**
     * Set the value of trick
     */
    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }



    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of fileName
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }
}
