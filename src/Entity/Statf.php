<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statf
 *
 * @ORM\Table(name="statf", uniqueConstraints={@ORM\UniqueConstraint(name="statF", columns={"statF"})})
 * @ORM\Entity
 */
class Statf
{
    /**
     * @var string
     *
     * @ORM\Column(name="statF", type="string", length=20, nullable=false)
     */
    private $statf;

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

    public function getStatf(): ?string
    {
        return $this->statf;
    }

    public function setStatf(string $statf): self
    {
        $this->statf = $statf;

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
