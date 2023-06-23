<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        min:3,
        max:255,
        minMessage: "The name is too short. It has to contain 3 or more letters.",
        maxMessage: "The name is too long. It cannot be longer than 255 letters.")]

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $catchDate = null;

    #[ORM\Column(length: 255)]
    #[Assert\Assert\NotBlank()]
    private ?string $catchPlace = null;

    #[ORM\Column]
    #[Assert\Assert\NotBlank()]
    #[Assert\Positive]
    private ?int $level = null;

    #[ORM\Column]
    #[Assert\Assert\NotBlank()]
    #[Assert\PositiveOrZero]
    private ?int $hp = null;

    #[ORM\Column]
    private ?bool $isShiny = null;

    #[Assert\Assert\NotBlank()]
    #[ORM\ManyToOne(inversedBy: 'pokemons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Specie $specie = null;

    #[ORM\ManyToMany(targetEntity: Attacks::class)]
    private Collection $attacks;

    public function __construct()
    {
        $this->attacks = new ArrayCollection();
    }



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

    public function getSpecie(): ?Specie
    {
        return $this->specie;
    }

    public function setSpecie(?Specie $specie): static
    {
        $this->specie = $specie;

        return $this;
    }

    /**
     * @return Collection<int, Attacks>
     */
    public function getAttacks(): Collection
    {
        return $this->attacks;
    }

    public function addAttack(Attacks $attack): static
    {
        if (!$this->attacks->contains($attack)) {
            $this->attacks->add($attack);
        }

        return $this;
    }

    public function removeAttack(Attacks $attack): static
    {
        $this->attacks->removeElement($attack);

        return $this;
    }

}
