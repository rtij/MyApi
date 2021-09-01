<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vente
 *
 * @ORM\Table(name="vente", indexes={@ORM\Index(name="fk_vente_client", columns={"idCl"})})
 * @ORM\Entity
 */
class Vente
{
    /**
     * @var int
     *
     * @ORM\Column(name="numV", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateV", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $datev = 'CURRENT_DATE';

    /**
     * @var float
     *
     * @ORM\Column(name="Tvav", type="float", precision=4, scale=2, nullable=false)
     */
    private $tvav;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCl", referencedColumnName="idCl")
     * })
     */
    private $idcl;

    public function getNumv(): ?int
    {
        return $this->numv;
    }
    
    public function getDatev(): ?\DateTimeInterface
    {
        return $this->datev;
    }

    public function setDatev(\DateTimeInterface $datev): self
    {
        $this->datev = $datev;

        return $this;
    }

    public function getTvav(): ?float
    {
        return $this->tvav;
    }

    public function setTvav(float $tvav): self
    {
        $this->tvav = $tvav;

        return $this;
    }

    public function getIdcl(): ?Client
    {
        return $this->idcl;
    }

    public function setIdcl(?Client $idcl): self
    {
        $this->idcl = $idcl;

        return $this;
    }


}
