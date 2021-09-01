<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rcsclient
 *
 * @ORM\Table(name="rcsclient", uniqueConstraints={@ORM\UniqueConstraint(name="RcsCl", columns={"RcsCl"})})
 * @ORM\Entity
 */
class Rcsclient
{
    /**
     * @var string
     *
     * @ORM\Column(name="RcsCl", type="string", length=40, nullable=false)
     */
    private $rcscl;

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

    public function getRcscl(): ?string
    {
        return $this->rcscl;
    }

    public function setRcscl(string $rcscl): self
    {
        $this->rcscl = $rcscl;

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
