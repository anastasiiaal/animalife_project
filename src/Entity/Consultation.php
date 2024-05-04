<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animalId = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Doctor $doctorId = null;

    #[ORM\Column(length: 255)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $resume = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $prescription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $animalWeight = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $nextVisit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $document = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlEyes = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlEars = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlSkin = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlDigestion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlHeart = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlLungs = null;

    #[ORM\Column(nullable: true)]
    private ?bool $controlMovement = null;

    #[ORM\ManyToMany(targetEntity: Vaccination::class)]
    private Collection $vaccinations;

    public function __construct()
    {
        $this->vaccinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimalId(): ?Animal
    {
        return $this->animalId;
    }

    public function setAnimalId(?Animal $animalId): static
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getDoctorId(): ?Doctor
    {
        return $this->doctorId;
    }

    public function setDoctorId(?Doctor $doctorId): static
    {
        $this->doctorId = $doctorId;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPrescription(): ?array
    {
        return $this->prescription;
    }

    public function setPrescription(?array $prescription): static
    {
        $this->prescription = $prescription;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getAnimalWeight(): ?string
    {
        return $this->animalWeight;
    }

    public function setAnimalWeight(?string $animalWeight): static
    {
        $this->animalWeight = $animalWeight;

        return $this;
    }

    public function getNextVisit(): ?\DateTimeInterface
    {
        return $this->nextVisit;
    }

    public function setNextVisit(?\DateTimeInterface $nextVisit): static
    {
        $this->nextVisit = $nextVisit;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function isControlEyes(): ?bool
    {
        return $this->controlEyes;
    }

    public function setControlEyes(?bool $controlEyes): static
    {
        $this->controlEyes = $controlEyes;

        return $this;
    }

    public function isControlEars(): ?bool
    {
        return $this->controlEars;
    }

    public function setControlEars(?bool $controlEars): static
    {
        $this->controlEars = $controlEars;

        return $this;
    }

    public function isControlSkin(): ?bool
    {
        return $this->controlSkin;
    }

    public function setControlSkin(?bool $controlSkin): static
    {
        $this->controlSkin = $controlSkin;

        return $this;
    }

    public function isControlDigestion(): ?bool
    {
        return $this->controlDigestion;
    }

    public function setControlDigestion(?bool $controlDigestion): static
    {
        $this->controlDigestion = $controlDigestion;

        return $this;
    }

    public function isControlHeart(): ?bool
    {
        return $this->controlHeart;
    }

    public function setControlHeart(?bool $controlHeart): static
    {
        $this->controlHeart = $controlHeart;

        return $this;
    }

    public function isControlLungs(): ?bool
    {
        return $this->controlLungs;
    }

    public function setControlLungs(?bool $controlLungs): static
    {
        $this->controlLungs = $controlLungs;

        return $this;
    }

    public function isControlMovement(): ?bool
    {
        return $this->controlMovement;
    }

    public function setControlMovement(?bool $controlMovement): static
    {
        $this->controlMovement = $controlMovement;

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
        }

        return $this;
    }

    public function removeVaccination(Vaccination $vaccination): static
    {
        $this->vaccinations->removeElement($vaccination);

        return $this;
    }
}
