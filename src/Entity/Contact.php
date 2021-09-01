<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="idContact", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontact;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=10, nullable=false)
     */
    private $tel;

    public function getIdcontact(): ?int
    {
        return $this->idcontact;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

}
