<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niff
 *
 * @ORM\Table(name="niff", uniqueConstraints={@ORM\UniqueConstraint(name="NifF", columns={"NifF"})})
 * @ORM\Entity
 */
class Niff
{
    /**
     * @var string
     *
     * @ORM\Column(name="NifF", type="string", length=20, nullable=false)
     */
    private $niff;

    /**
     * @var \Frs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Frs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idF", referencedColumnName="idF")
     * })
     */
    private $idf;

    public function getNiff(): ?string
    {
        return $this->niff;
    }

    public function setNiff(string $niff): self
    {
        $this->niff = $niff;

        return $this;
    }

    public function getIdf(): ?Frs
    {
        return $this->idf;
    }

    public function setIdf(?Frs $idf): self
    {
        $this->idf = $idf;

        return $this;
    }


}
