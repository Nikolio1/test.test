<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $color;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="date")
     */
    private $createDat;

    /**
     *  @ORM\OneToMany(
     *     targetEntity="Supplier",
     *     mappedBy="product",cascade={"persist","remove"}
     *  )
     *
     * @var ArrayCollection
     */
    private $suppliers;

    public function __construct()
    {
        $this->suppliers = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string $price
     *
     * @return $this
     */
    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreateDat(): ?\DateTimeInterface
    {
        return $this->createDat;
    }

    /**
     * @param \DateTimeInterface $createDat
     *
     * @return $this
     */
    public function setCreateDat(\DateTimeInterface $createDat): self
    {
        $this->createDat = $createDat;

        return $this;
    }

    /**
     * @param Supplier $supplier
     *
     * @return $this
     */
    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->suppliers->contains($supplier)) {
            $this->suppliers[] = $supplier;
            $supplier->setProduct($this);
        }

        return $this;
    }

    /**
     * @param Supplier $supplier
     *
     * @return $this
     */
    public function removeSupplier(Supplier $supplier): self
    {
        if ($this->suppliers->contains($supplier)) {
            $this->suppliers->removeElement($supplier);
            // set the owning side to null (unless already changed)
            if ($supplier->getProduct() === $this) {
                $supplier->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }
}
