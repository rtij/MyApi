<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Famille
 *
 * @ORM\Table(name="famille")
 * @ORM\Entity
 */
class Famille
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFamille", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfamille;

    /**
     * @var string
     *
     * @ORM\Column(name="Famille", type="string", length=20, nullable=false)
     */
    private $famille;

    /**
     * @var bool
     *
     * @ORM\Column(name="famille_sup", type="boolean", nullable=false)
     */
    private $familleSup;

    public function getIdfamille(): ?int
    {
        return $this->idfamille;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getFamilleSup(): ?bool
    {
        return $this->familleSup;
    }

    public function setFamilleSup(bool $familleSup): self
    {
        $this->familleSup = $familleSup;

        return $this;
    }


}
