<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe", uniqueConstraints={@ORM\UniqueConstraint(name="nomg", columns={"nomg"})})
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
     * @var string|null
     *
     * @ORM\Column(name="nameg", type="string", length=80, nullable=true)
     */
    private $nameg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emailG", type="string", length=100, nullable=true)
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

    public function setNameg(?string $nameg): self
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
