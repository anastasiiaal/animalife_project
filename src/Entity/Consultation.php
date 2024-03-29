<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
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
}
