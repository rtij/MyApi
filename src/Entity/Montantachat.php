<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Montantachat
 *
 * @ORM\Table(name="montantachat")
 * @ORM\Entity
 */
class Montantachat
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

    
    public function getNuma(): ?Achat
    {
        return $this->numa;
    }

    public function getMont(): ?float
    {
        return $this->mont;
    }

}
