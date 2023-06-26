<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
#[ApiResource()]
class Equipment
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
    private ?string $additionalProperties = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    // #[ORM\Column]
    // private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToMany(targetEntity: RentalEquipment::class, mappedBy: 'equipment')]
    private Collection $rentalEquipment;

    public function __construct()
    {
        $this->rentalEquipment = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
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

//     public function getAdditionalProperties(): ?array
// {
//     if ($this->additionalProperties === null) {
//         return null;
//     }
// // explode pour récupérer les valeurs qu'il divise en string
//     return explode(',', $this->additionalProperties);
// }

// public function setAdditionalProperties(?array $additionalProperties): static
// {
//     //on vérifie si $additionalProperties n'est pas nul
//     // si elle n'est pas nul, valeurs supplémentaires, utilisé la fonction 'implode' pour fusionner toutes les valeurs du tableau en string
//     if ($additionalProperties !== null) {
//         $this->additionalProperties = implode(',', $additionalProperties);
//     } else {
//         $this->additionalProperties = null;
//     }

//     return $this;
// }

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

    /**
     * @return Collection<int, RentalEquipment>
     */
    public function getRentalEquipment(): Collection
    {
        return $this->rentalEquipment;
    }

    public function addRentalEquipment(RentalEquipment $rentalEquipment): static
    {
        if (!$this->rentalEquipment->contains($rentalEquipment)) {
            $this->rentalEquipment->add($rentalEquipment);
            $rentalEquipment->addEquipment($this);
        }

        return $this;
    }

    public function removeRentalEquipment(RentalEquipment $rentalEquipment): static
    {
        if ($this->rentalEquipment->removeElement($rentalEquipment)) {
            $rentalEquipment->removeEquipment($this);
        }

        return $this;
    }
}
