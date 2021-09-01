<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cifclient
 *
 * @ORM\Table(name="cifclient", uniqueConstraints={@ORM\UniqueConstraint(name="CifCl", columns={"CifCl"})})
 * @ORM\Entity
 */
class Cifclient
{
    /**
     * @var string
     *
     * @ORM\Column(name="CifCl", type="string", length=20, nullable=false)
     */
    private $cifcl;

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

    public function getCifcl(): ?string
    {
        return $this->cifcl;
    }

    public function setCifcl(string $cifcl): self
    {
        $this->cifcl = $cifcl;

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
