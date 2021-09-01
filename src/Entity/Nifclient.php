<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nifclient
 *
 * @ORM\Table(name="nifclient", uniqueConstraints={@ORM\UniqueConstraint(name="NifCl", columns={"NifCl"})})
 * @ORM\Entity
 */
class Nifclient
{
    /**
     * @var string
     *
     * @ORM\Column(name="NifCl", type="string", length=20, nullable=false)
     */
    private $nifcl;

    /**
     * @var \Client
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCl", referencedColumnName="idCl")
     * })
     */
    private $idcl;

    public function getNifcl(): ?string
    {
        return $this->nifcl;
    }

    public function setNifcl(string $nifcl): self
    {
        $this->nifcl = $nifcl;

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
