<?php

namespace App\Entity;

use App\Repository\AnimalTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalTypeRepository::class)]
class AnimalType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeName = null;

    #[ORM\OneToMany(targetEntity: Animal::class, mappedBy: 'typeId')]
    private Collection $animals;

    #[ORM\ManyToMany(targetEntity: Doctor::class, mappedBy: 'animalTypes')]
    private Collection $doctors;

    #[ORM\ManyToMany(targetEntity: Vaccination::class, mappedBy: 'animalTypes')]
    private Collection $vaccinations;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->doctors = new ArrayCollection();
        $this->vaccinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    public function setTypeName(string $typeName): static
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setTypeId($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getTypeId() === $this) {
                $animal->setTypeId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctors(): Collection
    {
        return $this->doctors;
    }

    public function addDoctors(Doctor $doctors): static
    {
        if (!$this->doctors->contains($doctors)) {
            $this->doctors->add($doctors);
            $doctors->addAnimalType($this);
        }

        return $this;
    }

    public function removeDoctors(Doctor $doctors): static
    {
        if ($this->doctors->removeElement($doctors)) {
            $doctors->removeAnimalType($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Vaccination>
     */
    public function getVaccinations(): Collection
    {
        return $this->vaccinations;
    }

    public function addVaccination(Vaccination $vaccination): static
    {
        if (!$this->vaccinations->contains($vaccination)) {
            $this->vaccinations->add($vaccination);
            $vaccination->addAnimalType($this);
        }

        return $this;
    }

    public function removeVaccination(Vaccination $vaccination): static
    {
        if ($this->vaccinations->removeElement($vaccination)) {
            $vaccination->removeAnimalType($this);
        }

        return $this;
    }
}
