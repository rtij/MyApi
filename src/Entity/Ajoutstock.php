<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ajoutstock
 *
 * @ORM\Table(name="ajoutstock", indexes={@ORM\Index(name="fk_achat_ajoutStock", columns={"numA"}), @ORM\Index(name="fk_depot_ajoutStock", columns={"CodeD"}), @ORM\Index(name="IDX_BEDEAF33C6494F09", columns={"idProd"})})
 * @ORM\Entity
 */
class Ajoutstock
{
    /**
     * @var float
     *
     * @ORM\Column(name="QteP", type="float", precision=8, scale=2, nullable=false)
     */
    private $qtep;

    /**
     * @var \Achat
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Achat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numA", referencedColumnName="numA")
     * })
     */
    private $numa;

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

    public function getQtep(): ?float
    {
        return $this->qtep;
    }

    public function setQtep(float $qtep): self
    {
        $this->qtep = $qtep;

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


}
