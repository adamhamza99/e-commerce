<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource 
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     */
    private $illustration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     */
    private $subtitle;

    /**
     * @ORM\Column(type="text")
     * @Groups("product:read")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups("product:read")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("product:read")
     */
    private $category;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("product:read")
     */
    private $isBest;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("product:read")
     */
    private $isNew;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(bool $isBest): self
    {
        $this->isBest = $isBest;

        return $this;
    }

    public function getIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(bool $isNew): self
    {
        $this->isNew = $isNew;

        return $this;
    }
}
