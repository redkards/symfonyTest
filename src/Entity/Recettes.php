<?php

namespace App\Entity;

use App\Repository\RecettesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RecettesRepository::class)]
#[UniqueEntity('name')]
class Recettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit faire au plus {{ limit }} caractères'
    ) ]
    #[Assert\NotBlank()]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    #[Assert\Positive()]
    #[Assert\LessThan(1441)]
    private ?\DateTimeImmutable $time = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(51)]
    private ?int $nb_people = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(5)]
    private ?int $difficulty = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private ?string $description = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(1001)]
    private ?int $price = null;

    #[ORM\Column]
    private ?bool $is_favorite = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTime(): ?\DateTimeImmutable
    {
        return $this->time;
    }

    public function setTime(\DateTimeImmutable $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getNbPeople(): ?int
    {
        return $this->nb_people;
    }

    public function setNbPeople(?int $nb_people): static
    {
        $this->nb_people = $nb_people;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(?int $difficulty): static
    {
        $this->difficulty = $difficulty;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isFavorite(): ?bool
    {
        return $this->is_favorite;
    }

    public function setFavorite(bool $is_favorite): static
    {
        $this->is_favorite = $is_favorite;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    public function  __construct(){
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
       
    }
}
