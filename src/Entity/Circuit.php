<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 */
class Circuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_circuit;

    /**
     * @ORM\OneToMany(targetEntity=EtapeCircuit::class, mappedBy="circuit_étape", orphanRemoval=true)
     */
    private $des_circuit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $durée_circuit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etapeCircuits;

    public function __construct()
    {
        $this->etapeCircuits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCircuit(): ?string
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(string $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function getDesCircuit(): ?string
    {
        return $this->des_circuit;
    }

    public function setDesCircuit(string $des_circuit): self
    {
        $this->des_circuit = $des_circuit;

        return $this;
    }

    public function getDuréeCircuit(): ?string
    {
        return $this->durée_circuit;
    }

    public function setDuréeCircuit(string $durée_circuit): self
    {
        $this->durée_circuit = $durée_circuit;

        return $this;
    }

    /**
     * @return Collection|EtapeCircuit[]
     */
    public function getEtapeCircuits(): Collection
    {
        return $this->etapeCircuits;
    }

    public function addEtapeCircuit(EtapeCircuit $etapeCircuit): self
    {
        if (!$this->etapeCircuits->contains($etapeCircuit)) {
            $this->etapeCircuits[] = $etapeCircuit;
            $etapeCircuit->setCircuitétape($this);
        }

        return $this;
    }

    public function removeEtapeCircuit(EtapeCircuit $etapeCircuit): self
    {
        if ($this->etapeCircuits->contains($etapeCircuit)) {
            $this->etapeCircuits->removeElement($etapeCircuit);
            // set the owning side to null (unless already changed)
            if ($etapeCircuit->getCircuitétape() === $this) {
                $etapeCircuit->setCircuitétape(null);
            }
        }

        return $this;
    }
}
