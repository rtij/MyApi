<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detailv
 *
 * @ORM\Table(name="detailv", indexes={@ORM\Index(name="fk_produit_detailv", columns={"idProd"}), @ORM\Index(name="fk_depot_detailv", columns={"CodeD"}), @ORM\Index(name="IDX_24CFF05FADC14BC", columns={"numV"})})
 * @ORM\Entity
 */
class Detailv
{
    /**
     * @var float
     *
     * @ORM\Column(name="QteV", type="float", precision=8, scale=2, nullable=false)
     */
    private $qtev;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixV", type="float", precision=10, scale=2, nullable=false)
     */
    private $prixv;

    /**
     * @var \Depot
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Depot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CodeD", referencedColumnName="CodeD")
     * })
     */
    private $coded;

    /**
     * @var \Produit
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProd", referencedColumnName="idProd")
     * })
     */
    private $idprod;

    /**
     * @var \Vente
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Vente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numV", referencedColumnName="numV")
     * })
     */
    private $numv;

    public function getQtev(): ?float
    {
        return $this->qtev;
    }

    public function setQtev(float $qtev): self
    {
        $this->qtev = $qtev;

        return $this;
    }

    public function getPrixv(): ?float
    {
        return $this->prixv;
    }

    public function setPrixv(float $prixv): self
    {
        $this->prixv = $prixv;

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

    public function getIdprod(): ?Produit
    {
        return $this->idprod;
    }

    public function setIdprod(?Produit $idprod): self
    {
        $this->idprod = $idprod;

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
