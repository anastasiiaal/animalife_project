<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctorRepository::class)]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagePath = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $clinicName = null;

    #[ORM\ManyToMany(targetEntity: AnimalType::class, inversedBy: 'education')]
    private Collection $animalTypes;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $education = null;

    #[ORM\Column]
    private ?bool $isEmergency = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $experience = null;

    #[ORM\OneToMany(targetEntity: Consultation::class, mappedBy: 'doctorId')]
    private Collection $consultations;

    #[ORM\ManyToOne(inversedBy: 'doctors')]
    #[ORM\JoinColumn(nullable: true)]
    private ?City $cityId = null;

    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'doctors')]
    private Collection $services;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sex = null;

    #[ORM\Column(length: 255)]
    private ?string $nameSlug = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numRpps = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numAdeli = null;

    #[ORM\Column(nullable: true)]
    private ?int $consultationPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speciality = null;

    public function __construct()
    {
        $this->animalTypes = new ArrayCollection();
        $this->consultations = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getClinicName(): ?string
    {
        return $this->clinicName;
    }

    public function setClinicName(?string $clinicName): static
    {
        $this->clinicName = $clinicName;

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

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(?string $education): static
    {
        $this->education = $education;

        return $this;
    }

    public function isIsEmergency(): ?bool
    {
        return $this->isEmergency;
    }

    public function setIsEmergency(bool $isEmergency): static
    {
        $this->isEmergency = $isEmergency;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): static
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations->add($consultation);
            $consultation->setDoctorId($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getDoctorId() === $this) {
                $consultation->setDoctorId(null);
            }
        }

        return $this;
    }

    public function getCityId(): ?City
    {
        return $this->cityId;
    }

    public function setCityId(?City $cityId): static
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getNameSlug(): ?string
    {
        return $this->nameSlug;
    }

    public function setNameSlug(string $nameSlug): static
    {
        $this->nameSlug = $nameSlug;

        return $this;
    }

    public function getNumRpps(): ?string
    {
        return $this->numRpps;
    }

    public function setNumRpps(?string $numRpps): static
    {
        $this->numRpps = $numRpps;

        return $this;
    }

    public function getNumAdeli(): ?string
    {
        return $this->numAdeli;
    }

    public function setNumAdeli(?string $numAdeli): static
    {
        $this->numAdeli = $numAdeli;

        return $this;
    }

    public function getConsultationPrice(): ?int
    {
        return $this->consultationPrice;
    }

    public function setConsultationPrice(?int $consultationPrice): static
    {
        $this->consultationPrice = $consultationPrice;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): static
    {
        $this->speciality = $speciality;

        return $this;
    }
}
