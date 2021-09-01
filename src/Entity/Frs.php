<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Frs
 *
 * @ORM\Table(name="frs")
 * @ORM\Entity
 */
class Frs
{
    /**
     * @var int
     *
     * @ORM\Column(name="idF", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idf;

    /**
     * @var string
     *
     * @ORM\Column(name="nomf", type="string", length=50, nullable=false)
     */
    private $nomf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AdrF", type="string", length=50, nullable=true)
     */
    private $adrf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EmailF", type="string", length=80, nullable=true)
     */
    private $emailf;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="frs_sup", type="boolean", nullable=true)
     */
    private $frsSup;

    public function getIdf(): ?int
    {
        return $this->idf;
    }

    public function getNomf(): ?string
    {
        return $this->nomf;
    }

    public function setNomf(string $nomf): self
    {
        $this->nomf = $nomf;

        return $this;
    }

    public function getAdrf(): ?string
    {
        return $this->adrf;
    }

    public function setAdrf(?string $adrf): self
    {
        $this->adrf = $adrf;

        return $this;
    }

    public function getEmailf(): ?string
    {
        return $this->emailf;
    }

    public function setEmailf(?string $emailf): self
    {
        $this->emailf = $emailf;

        return $this;
    }

    public function getFrsSup(): ?bool
    {
        return $this->frsSup;
    }

    public function setFrsSup(?bool $frsSup): self
    {
        $this->frsSup = $frsSup;

        return $this;
    }

}
