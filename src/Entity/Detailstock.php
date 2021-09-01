<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailStock
 *
 * @ORM\Table(name="detailstock")
 * @ORM\Entity(repositoryClass="App\Repository\DetailStockRepository")
 */
class Detailstock
{
    
    
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
    private $codedepot;

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
     * @var int
     *
     * @ORM\Column(name="QteP", type="integer", nullable=false)
     */
    private $qtep;


    public function getQtep(): ?int
    {
        return $this->qtep;
    }

    public function setQtep(int $qtep): self
    {
        $this->qtep = $qtep;

        return $this;
    }

    public function getCoded(): ?Depot
    {
        return $this->codedepot;
    }

    public function setCoded(?Depot $coded): self
    {
        $this->codedepot = $coded;

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
