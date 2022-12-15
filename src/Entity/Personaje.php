<?php

namespace App\Entity;

use App\Repository\PersonajeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonajeRepository::class)
 */
class Personaje
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
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $race;

    /**
     * @ORM\ManyToMany(targetEntity=Planetas::class, mappedBy="personaje")
     */
    private $planetas;

    public function __construct()
    {
        $this->planetas = new ArrayCollection();
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

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection|Planetas[]
     */
    public function getPlanetas(): Collection
    {
        return $this->planetas;
    }

    public function addPlaneta(Planetas $planeta): self
    {
        if (!$this->planetas->contains($planeta)) {
            $this->planetas[] = $planeta;
            $planeta->addPersonaje($this);
        }

        return $this;
    }

    public function removePlaneta(Planetas $planeta): self
    {
        if ($this->planetas->removeElement($planeta)) {
            $planeta->removePersonaje($this);
        }

        return $this;
    }
}
