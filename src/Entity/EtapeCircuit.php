<?php

namespace App\Entity;

use App\Repository\EtapeCircuitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapeCircuitRepository::class)
 */
class EtapeCircuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ville_etape;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="etapeCircuits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $circuit_étape;

    /**     
     * @ORM\ManyToOne(targetEntity=Circuit::class, inversedBy="etapeCircuits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $durée_étape;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre_étape;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleEtape(): ?ville
    {
        return $this->ville_etape;
    }

    public function setVilleEtape(?ville $ville_etape): self
    {
        $this->ville_etape = $ville_etape;

        return $this;
    }

    public function getCircuitétape(): ?circuit
    {
        return $this->circuit_étape;
    }

    public function setCircuitétape(?circuit $circuit_étape): self
    {
        $this->circuit_étape = $circuit_étape;

        return $this;
    }

    public function getDuréeétape(): ?int
    {
        return $this->durée_étape;
    }

    public function setDuréeétape(int $durée_étape): self
    {
        $this->durée_étape = $durée_étape;

        return $this;
    }

    public function getOrdreétape(): ?int
    {
        return $this->ordre_étape;
    }

    public function setOrdreétape(int $ordre_étape): self
    {
        $this->ordre_étape = $ordre_étape;

        return $this;
    }
}
