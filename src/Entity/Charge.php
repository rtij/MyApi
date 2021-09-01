<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Charge
 *
 * @ORM\Table(name="charge", indexes={@ORM\Index(name="fk_charge_produit", columns={"idProd"}), @ORM\Index(name="fk_depot_charge", columns={"codeD"})})
 * @ORM\Entity
 */
class Charge
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCharge", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcharge;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PrixP", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $prixp;

    /**
     * @var float
     *
     * @ORM\Column(name="QteP", type="float", precision=8, scale=2, nullable=false)
     */
    private $qtep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateC", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $datec = 'CURRENT_DATE';

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProd", referencedColumnName="idProd")
     * })
     */
    private $idprod;

    /**
     * @var \Depot
     *
     * @ORM\ManyToOne(targetEntity="Depot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codeD", referencedColumnName="CodeD")
     * })
     */
    private $coded;

    public function getIdcharge(): ?int
    {
        return $this->idcharge;
    }

    public function getPrixp(): ?int
    {
        return $this->prixp;
    }

    public function setPrixp(?int $prixp): self
    {
        $this->prixp = $prixp;

        return $this;
    }

    public function getQtep(): ?float
    {
        return $this->qtep;
    }

    public function setQtep(float $qtep): self
    {
        $this->qtep = $qtep;

        return $this;
    }

    public function getDatec(): ?\DateTimeInterface
    {
        return $this->datec;
    }

    public function setDatec(\DateTimeInterface $datec): self
    {
        $this->datec = $datec;

        return $this;
    }

    public function getIdprod(): ?Produit
    {
        return $this->idprod;
    }

    public function setIdprod(?Produit $idprod): self
    {
        $this->idprod = $idprod;

        return $this;
    }

    public function getCoded(): ?Depot
    {
        return $this->coded;
    }

    public function setCoded(?Depot $coded): self
    {
        $this->coded = $coded;

        return $this;
    }


}
