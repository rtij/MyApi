<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contactfrs
 *
 * @ORM\Table(name="contactfrs", indexes={@ORM\Index(name="fk_contact_contactFrs", columns={"idContact"})})
 * @ORM\Entity
 */
class Contactfrs
{
    /**
     * @var \Frs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Frs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idF", referencedColumnName="idF")
     * })
      */
    private $idf;

    /**
     * @var \Contact
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idContact", referencedColumnName="idContact")
     * })
     */
    private $idcontact;

    public function getIdf(): ?Frs
    {
        return $this->idf;
    }

    public function getIdcontact(): ?Contact
    {
        return $this->idcontact;
    }

    
    public function setIdf(Frs $idf): self
    {
        $this->idf = $idf;

        return $this;
    }
    
    public function setIdcontact(Contact $idcontact): self
    {
        $this->idcontact = $idcontact;

        return $this;
    }
}
