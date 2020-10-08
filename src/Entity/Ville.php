<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $code_ville;

    /**
     * @ORM\OneToMany(targetEntity=EtapeCircuit::class, mappedBy="ville_etape", orphanRemoval=true)
     
     */
    private $des_ville;

    /**
     * @ORM\ManyToOne(targetEntity=Destination::class, inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dest_ville;

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

    public function getCodeVille(): ?int
    {
        return $this->code_ville;
    }

    public function setCodeVille(int $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function getDesVille(): ?string
    {
        return $this->des_ville;
    }

    public function setDesVille(string $des_ville): self
    {
        $this->des_ville = $des_ville;

        return $this;
    }

    public function getDestVille(): ?destination
    {
        return $this->dest_ville;
    }

    public function setDestVille(?destination $dest_ville): self
    {
        $this->dest_ville = $dest_ville;

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
            $etapeCircuit->setVilleEtape($this);
        }

        return $this;
    }

    public function removeEtapeCircuit(EtapeCircuit $etapeCircuit): self
    {
        if ($this->etapeCircuits->contains($etapeCircuit)) {
            $this->etapeCircuits->removeElement($etapeCircuit);
            // set the owning side to null (unless already changed)
            if ($etapeCircuit->getVilleEtape() === $this) {
                $etapeCircuit->setVilleEtape(null);
            }
        }

        return $this;
    }
}
