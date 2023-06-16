<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $catchDate = null;

    #[ORM\Column(length: 255)]
    private ?string $catchPlace = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\Column]
    private ?bool $isShiny = null;

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

    public function getCatchDate(): ?\DateTimeInterface
    {
        return $this->catchDate;
    }

    public function setCatchDate(\DateTimeInterface $catchDate): static
    {
        $this->catchDate = $catchDate;

        return $this;
    }

    public function getCatchPlace(): ?string
    {
        return $this->catchPlace;
    }

    public function setCatchPlace(string $catchPlace): static
    {
        $this->catchPlace = $catchPlace;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function isIsShiny(): ?bool
    {
        return $this->isShiny;
    }

    public function setIsShiny(bool $isShiny): static
    {
        $this->isShiny = $isShiny;

        return $this;
    }
}
