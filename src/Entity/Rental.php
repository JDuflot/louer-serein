<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\RentalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalRepository::class)]
#[ApiResource()]
class Rental
{
    use CreatedAtTrait;
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    // #[ORM\Column]
    // private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'rental', targetEntity: Picture::class)]
    private Collection $pictures;

    #[ORM\OneToMany(mappedBy: 'rental', targetEntity: RentalEquipment::class)]
    private Collection $rentalEquipment;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->rentalEquipment = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
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

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setRental($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getRental() === $this) {
                $picture->setRental(null);
            }
        }

        return $this;
    }

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
            $rentalEquipment->setRental($this);
        }

        return $this;
    }

    public function removeRentalEquipment(RentalEquipment $rentalEquipment): static
    {
        if ($this->rentalEquipment->removeElement($rentalEquipment)) {
            // set the owning side to null (unless already changed)
            if ($rentalEquipment->getRental() === $this) {
                $rentalEquipment->setRental(null);
            }
        }

        return $this;
    }
    // public function __toString()
    // {
    //     return $this->getRentalEquipment()->getTitle();
    // }
}
