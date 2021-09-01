<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contactuser
 *
 * @ORM\Table(name="contactuser", indexes={@ORM\Index(name="fk_user_contact", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="App\Repository\ContactUserRepository")
 */
class Contactuser
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
     * @ORM\Column(name="tel", type="string", length=20, nullable=false)
     */
    private $tel;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

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

    public function getIduser(): ?Users
    {
        return $this->iduser;
    }

    public function setIduser(?Users $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }


}
