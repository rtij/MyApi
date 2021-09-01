<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rcsf
 *
 * @ORM\Table(name="rcsf", uniqueConstraints={@ORM\UniqueConstraint(name="RcsF", columns={"RcsF"})})
 * @ORM\Entity
 */
class Rcsf
{
    /**
     * @var string
     *
     * @ORM\Column(name="RcsF", type="string", length=40, nullable=false)
     */
    private $rcsf;

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

    public function getRcsf(): ?string
    {
        return $this->rcsf;
    }

    public function setRcsf(string $rcsf): self
    {
        $this->rcsf = $rcsf;

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
