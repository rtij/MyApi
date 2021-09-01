<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achatpaiement
 *
 * @ORM\Table(name="achatpaiement")
 * @ORM\Entity
 */
class Achatpaiement
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
     * @var float
     *
     * @ORM\Column(name="mont", type="float", nullable=true)
     */
    private $mont;

    /**
     * @var int
     *
     * @ORM\Column(name="montantp", type="integer", nullable=true)
     */
    private $montantp;

    public function getNuma(): ?Achat
    {
        return $this->numa;
    }

    public function getMont(): ?float
    {
        return $this->mont;
    }

    
    public function getMontantp(): ?int
    {
        return $this->montantp;
    }
}
