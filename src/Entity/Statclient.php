<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statclient
 *
 * @ORM\Table(name="statclient", uniqueConstraints={@ORM\UniqueConstraint(name="StatCl", columns={"StatCl"})})
 * @ORM\Entity
 */
class Statclient
{
    /**
     * @var string
     *
     * @ORM\Column(name="StatCl", type="string", length=20, nullable=false)
     */
    private $statcl;

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

    public function getStatcl(): ?string
    {
        return $this->statcl;
    }

    public function setStatcl(string $statcl): self
    {
        $this->statcl = $statcl;

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
