<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Specie::class, mappedBy: 'types')]
    private Collection $species;

    public function __construct()
    {
        $this->species = new ArrayCollection();
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

    /**
     * @return Collection<int, Specie>
     */
    public function getSpecies(): Collection
    {
        return $this->species;
    }

    public function addSpecies(Specie $species): static
    {
        if (!$this->species->contains($species)) {
            $this->species->add($species);
            $species->addType($this);
        }

        return $this;
    }

    public function removeSpecies(Specie $species): static
    {
        if ($this->species->removeElement($species)) {
            $species->removeType($this);
        }

        return $this;
    }


}
