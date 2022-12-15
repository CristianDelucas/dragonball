<?php

namespace App\Entity;

use App\Repository\PlanetasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanetasRepository::class)
 */
class Planetas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Personaje::class, inversedBy="planetas")
     */
    private $personaje;

    public function __construct()
    {
        $this->personaje = new ArrayCollection();
    }

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Personaje[]
     */
    public function getPersonaje(): Collection
    {
        return $this->personaje;
    }

    public function addPersonaje(Personaje $personaje): self
    {
        if (!$this->personaje->contains($personaje)) {
            $this->personaje[] = $personaje;
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): self
    {
        $this->personaje->removeElement($personaje);

        return $this;
    }
}
