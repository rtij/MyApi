<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiementa
 *
 * @ORM\Table(name="paiementa", indexes={@ORM\Index(name="fk_achat_paiement", columns={"numA"})})
 * @ORM\Entity
 */
class Paiementa
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPaiement", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaiement;

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
     * @var \Achat
     *
     * @ORM\ManyToOne(targetEntity="Achat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numA", referencedColumnName="numA")
     * })
     */
    private $numa;

    public function getIdpaiement(): ?int
    {
        return $this->idpaiement;
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

    public function getNuma(): ?Achat
    {
        return $this->numa;
    }

    public function setNuma(?Achat $numa): self
    {
        $this->numa = $numa;

        return $this;
    }


}
