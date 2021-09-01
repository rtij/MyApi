<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ventepaiement
 *
 * @ORM\Table(name="Ventepaiement")
 * @ORM\Entity
 */
class Ventepaiement
{
    /**
     * @var \Vente
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Vente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numV", referencedColumnName="numV")
     * })
     */
    private $numv;

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

    public function getNumv(): ?Vente
    {
        return $this->numv;
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
