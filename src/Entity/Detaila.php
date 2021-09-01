<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detailv
 *
 * @ORM\Table(name="detaila", indexes={@ORM\Index(name="fk_produit_detaila", columns={"idProd"}), @ORM\Index(name="IDX_24CFF05FADC14BC", columns={"numA"})})
 * @ORM\Entity
 */
class Detaila
{
    /**
     * @var float
     *
     * @ORM\Column(name="QteA", type="float", precision=8, scale=2, nullable=false)
     */
    private $qtea;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixA", type="float", precision=10, scale=2, nullable=false)
     */
    private $prixa;

    /**
     * @var \Produit
     *
     * @ORM\Id     
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProd", referencedColumnName="idProd")
     * })
     */
    private $idprod;

    /**
     * @var \Achat
     *
     * @ORM\Id     
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Achat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numA", referencedColumnName="numA")
     * })
     */
    private $numa;

    public function getQtea(): ?float
    {
        return $this->qtea;
    }

    public function setQtea(float $qtea): self
    {
        $this->qtea = $qtea;

        return $this;
    }

    public function getPrixa(): ?float
    {
        return $this->prixa;
    }

    public function setPrixa(float $prixa): self
    {
        $this->prixa = $prixa;

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
