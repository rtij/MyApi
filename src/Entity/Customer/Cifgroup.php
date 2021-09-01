<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cifgroup
 *
 * @ORM\Table(name="cifgroup", uniqueConstraints={@ORM\UniqueConstraint(name="CifG", columns={"CifG"})})
 * @ORM\Entity
 */
class Cifgroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="CifG", type="string", length=20, nullable=false)
     */
    private $cifg;

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

    public function getCifg(): ?string
    {
        return $this->cifg;
    }

    public function setCifg(string $cifg): self
    {
        $this->cifg = $cifg;

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
