<?php

namespace App\Entity;

use App\Repository\VaccinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VaccinationRepository::class)]
class Vaccination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: AnimalType::class, inversedBy: 'vaccinations')]
    private Collection $animalTypes;

    public function __construct()
    {
        $this->animalTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, AnimalType>
     */
    public function getAnimalTypes(): Collection
    {
        return $this->animalTypes;
    }

    public function addAnimalType(AnimalType $animalType): static
    {
        if (!$this->animalTypes->contains($animalType)) {
            $this->animalTypes->add($animalType);
        }

        return $this;
    }

    public function removeAnimalType(AnimalType $animalType): static
    {
        $this->animalTypes->removeElement($animalType);

        return $this;
    }
}
