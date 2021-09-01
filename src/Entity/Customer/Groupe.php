<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe", uniqueConstraints={@ORM\UniqueConstraint(name="nameg", columns={"Nameg"}), @ORM\UniqueConstraint(name="nomg", columns={"Nameg"})})
 * @ORM\Entity
 */
class Groupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="idGroup", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgroup;

    /**
     * @var string
     *
     * @ORM\Column(name="Nameg", type="string", length=255, nullable=false)
     */
    private $nameg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Emailg", type="string", length=255, nullable=true)
     */
    private $emailg;

    public function getIdgroup(): ?int
    {
        return $this->idgroup;
    }

    public function getNameg(): ?string
    {
        return $this->nameg;
    }

    public function setNameg(string $nameg): self
    {
        $this->nameg = $nameg;

        return $this;
    }

    public function getEmailg(): ?string
    {
        return $this->emailg;
    }

    public function setEmailg(?string $emailg): self
    {
        $this->emailg = $emailg;

        return $this;
    }


}
