<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nifgroup
 *
 * @ORM\Table(name="nifgroup", uniqueConstraints={@ORM\UniqueConstraint(name="NifG", columns={"NifG"})})
 * @ORM\Entity
 */
class Nifgroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="NifG", type="string", length=20, nullable=false)
     */
    private $nifg;

    /**
     * @var \Groupe
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGroup", referencedColumnName="idGroup")
     * })
     */
    private $idgroup;

    public function getNifg(): ?string
    {
        return $this->nifg;
    }

    public function setNifg(string $nifg): self
    {
        $this->nifg = $nifg;

        return $this;
    }

    public function getIdgroup(): ?Groupe
    {
        return $this->idgroup;
    }

    public function setIdgroup(?Groupe $idgroup): self
    {
        $this->idgroup = $idgroup;

        return $this;
    }


}
