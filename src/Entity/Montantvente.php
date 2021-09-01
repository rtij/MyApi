<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Montantvente
 *
 * @ORM\Table(name="montantvente")
 * @ORM\Entity
 */
class Montantvente
{
    
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

    /**
     * @var float
     *
     * @ORM\Column(name="mont", type="float", nullable=true)
     */
    private $mont;

    public function getNumv(): ?Vente
    {
        return $this->numv;
    }

    public function getMont(): ?float
    {
        return $this->mont;
    }

}
