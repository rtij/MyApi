<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rcsgroup
 *
 * @ORM\Table(name="rcsgroup", uniqueConstraints={@ORM\UniqueConstraint(name="RcsG", columns={"RcsG"})})
 * @ORM\Entity
 */
class Rcsgroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="RcsG", type="string", length=40, nullable=false)
     */
    private $rcsg;

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

    public function getRcsg(): ?string
    {
        return $this->rcsg;
    }

    public function setRcsg(string $rcsg): self
    {
        $this->rcsg = $rcsg;

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
