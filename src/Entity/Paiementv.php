<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiementv
 *
 * @ORM\Table(name="paiementv", indexes={@ORM\Index(name="fk_vente_paiementv", columns={"numV"})})
 * @ORM\Entity
 */
class Paiementv
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPaiementV", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaiementv;

    /**
     * @var int
     *
     * @ORM\Column(name="montantP", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $montantp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateP", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $datep = 'CURRENT_DATE';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Piece", type="string", length=255, nullable=true)
     */
    private $piece;

    /**
     * @var \Vente
     *
     * @ORM\ManyToOne(targetEntity="Vente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numV", referencedColumnName="numV")
     * })
     */
    private $numv;

    public function getIdpaiementv(): ?int
    {
        return $this->idpaiementv;
    }

    public function getMontantp(): ?int
    {
        return $this->montantp;
    }

    public function setMontantp(int $montantp): self
    {
        $this->montantp = $montantp;

        return $this;
    }

    public function getDatep(): ?\DateTimeInterface
    {
        return $this->datep;
    }

    public function setDatep(\DateTimeInterface $datep): self
    {
        $this->datep = $datep;

        return $this;
    }

    public function getPiece(): ?string
    {
        return $this->piece;
    }

    public function setPiece(?string $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getNumv(): ?Vente
    {
        return $this->numv;
    }

    public function setNumv(?Vente $numv): self
    {
        $this->numv = $numv;

        return $this;
    }


}
