<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unite
 *
 * @ORM\Table(name="unite")
 * @ORM\Entity
 */
class Unite
{
    /**
     * @var int
     *
     * @ORM\Column(name="idU", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idu;

    /**
     * @var string
     *
     * @ORM\Column(name="DesUnit", type="string", length=20, nullable=false)
     */
    private $desunit;

    public function getIdu(): ?int
    {
        return $this->idu;
    }

    public function getDesunit(): ?string
    {
        return $this->desunit;
    }

    public function setDesunit(string $desunit): self
    {
        $this->desunit = $desunit;

        return $this;
    }


}
