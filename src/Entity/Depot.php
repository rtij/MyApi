<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depot
 *
 * @ORM\Table(name="depot")
 * @ORM\Entity
 */
class Depot
{
    /**
     * @var int
     *
     * @ORM\Column(name="CodeD", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codedepot;

    /**
     * @var string
     *
     * @ORM\Column(name="DesDep", type="string", length=20, nullable=false)
     */
    private $desdep;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Dep_Sup", type="boolean", nullable=true)
     */
    private $depSup;


    public function getCoded(): ?int
    {
        return $this->codedepot;
    }

    public function getDesdep(): ?string
    {
        return $this->desdep;
    }

    public function setDesdep(string $desdep): self
    {
        $this->desdep = $desdep;

        return $this;
    }

    public function getDepSup(): ?bool
    {
        return $this->depSup;
    }

    public function setDepSup(?bool $depSup): self
    {
        $this->depSup = $depSup;

        return $this;
    }


}
