<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\RentalEquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalEquipmentRepository::class)]
#[ApiResource()]
class RentalEquipment
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    // #[ORM\Column]
    // private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'rentalEquipment')]
    private ?rental $rental = null;

    #[ORM\ManyToMany(targetEntity: equipment::class, inversedBy: 'rentalEquipment')]
    private Collection $equipment;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        
    }

    public function getId(): ?int
    {
        return $this->id;
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

    // public function getCreatedAt(): ?\DateTimeImmutable
    // {
    //     return $this->created_at;
    // }

    // public function setCreatedAt(\DateTimeImmutable $created_at): static
    // {
    //     $this->created_at = $created_at;

    //     return $this;
    // }

    public function getRental(): ?rental
    {
        return $this->rental;
    }

    public function setRental(?rental $rental): static
    {
        $this->rental = $rental;

        return $this;
    }

    /**
     * @return Collection<int, equipment>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(equipment $equipment): static
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment->add($equipment);
        }

        return $this;
    }

    public function removeEquipment(equipment $equipment): static
    {
        $this->equipment->removeElement($equipment);

        return $this;
    }
}
