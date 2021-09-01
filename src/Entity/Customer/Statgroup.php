<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statgroup
 *
 * @ORM\Table(name="statgroup", uniqueConstraints={@ORM\UniqueConstraint(name="StatG", columns={"StatG"})})
 * @ORM\Entity
 */
class Statgroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="StatG", type="string", length=20, nullable=false)
     */
    private $statg;

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

    public function getStatg(): ?string
    {
        return $this->statg;
    }

    public function setStatg(string $statg): self
    {
        $this->statg = $statg;

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
