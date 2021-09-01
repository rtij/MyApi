<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Approvisionnement
 *
 * @ORM\Table(name="Approvisionnement")
 * @ORM\Entity
 */
class Approvisionnement
{
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
     * @var float
     *
     * @ORM\Column(name="qtea", type="float",  nullable=false)
     */
    private $qtea;

    /**
     * @var float
     *
     *  @ORM\Column(name="qtep", type="float", nullable=false)
     *
     */
    private $qtep;

    public function getNuma(): ?Achat
    {
        return $this->numa;
    }
    
    
    public function getIdprod(): ?Produit
    {
        return $this->idprod;
    }

    public function getQtea(): ?float
    {
        return $this->qtea;
    }

    public function getQtep(): ?float
    {
        return $this->qtep;
    }


}
