<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiementvente
 *
 * @ORM\Table(name="paiementvente")
 * @ORM\Entity
 */
class Paiementvente
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
     * @ORM\Column(name="montantp", type="float", nullable=true)
     */
    private $montantp;

    
    public function getNumv(): ?Vente
    {
        return $this->numv;
    }

    public function getMont(): ?float
    {
        return $this->montantp;
    }

}
