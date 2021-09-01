<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciff
 *
 * @ORM\Table(name="ciff", uniqueConstraints={@ORM\UniqueConstraint(name="cifF", columns={"cifF"})})
 * @ORM\Entity
 */
class Ciff
{
    /**
     * @var string
     *
     * @ORM\Column(name="cifF", type="string", length=20, nullable=false)
     */
    private $ciff;

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

    public function getCiff(): ?string
    {
        return $this->ciff;
    }

    public function setCiff(string $ciff): self
    {
        $this->ciff = $ciff;

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
