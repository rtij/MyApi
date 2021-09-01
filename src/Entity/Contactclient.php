<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contactclient
 *
 * @ORM\Table(name="contactclient", indexes={@ORM\Index(name="fk_contact_contactClient", columns={"idContact"})})
 * @ORM\Entity
 */
class Contactclient
{
    /**
     * @var \Client
     *
     *  @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCl", referencedColumnName="idCl")
     * })
     */
    private $idcl;
    

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

    public function getIdcl(): ?Client
    {
        return $this->idcl;
    }

    public function getIdcontact(): ?Contact
    {
        return $this->idcontact;
    }

    
    public function setIdcl(Client $idcl): self
    {
        $this->idcl = $idcl;

        return $this;
    }
    
    public function setIdcontact(Contact $idcontact): self
    {
        $this->idcontact = $idcontact;

        return $this;
    }
}
