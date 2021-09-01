<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 *
 * @ORM\Table(name="achat", indexes={@ORM\Index(name="fk_achat_frs", columns={"idF"})})
 * @ORM\Entity
 */
class Achat
{
    /**
     * @var int
     *
     * @ORM\Column(name="numA", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateA", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $datea = 'CURRENT_DATE';

    /**
     * @var float
     *
     * @ORM\Column(name="tvaA", type="float", precision=4, scale=2, nullable=false)
     */
    private $tvaa;

    /**
     * @var \Frs
     *
     * @ORM\ManyToOne(targetEntity="Frs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idF", referencedColumnName="idF")
     * })
     */
    private $idf;

    public function getNuma(): ?int
    {
        return $this->numa;
    }

    public function getDatea(): ?\DateTimeInterface
    {
        return $this->datea;
    }

    public function setDatea(\DateTimeInterface $datea): self
    {
        $this->datea = $datea;

        return $this;
    }

    public function getTvaa(): ?float
    {
        return $this->tvaa;
    }

    public function setTvaa(float $tvaa): self
    {
        $this->tvaa = $tvaa;

        return $this;
    }

    public function getIdf(): ?Frs
    {
        return $this->idf;
    }

    public function setIdf(?Frs $idf): self
    {
        $this->idf = $idf;

        return $this;
    }
}
