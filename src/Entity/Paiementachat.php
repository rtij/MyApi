<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiementachat
 *
 * @ORM\Table(name="paiementachat")
 * @ORM\Entity
 */
class Paiementachat
{
    /**
     * @var \Frs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\ManyToOne(targetEntity="Frs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idF", referencedColumnName="idF")
     * })
     */
    private $idf;

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
     * @ORM\Column(name="montantp", type="float", nullable=true)
     */
    private $montantp;

    
    public function getNuma(): ?Achat
    {
        return $this->numa;
    }

    public function getMont(): ?float
    {
        return $this->montantp;
    }

}
