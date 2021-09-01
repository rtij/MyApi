<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usergroupe
 *
 * @ORM\Table(name="usergroupe", indexes={@ORM\Index(name="fk_group_usergroup", columns={"idGroup"}), @ORM\Index(name="fk_type_usergroup", columns={"idType"})})
 * @ORM\Entity
 */
class Usergroupe
{
    /**
     * @var \Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGroup", referencedColumnName="idGroup")
     * })
     */
    private $idgroup;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idType", referencedColumnName="idType")
     * })
     */
    private $idtype;

    /**
     * @var \Users
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

    public function getIdgroup(): ?Groupe
    {
        return $this->idgroup;
    }

    public function setIdgroup(?Groupe $idgroup): self
    {
        $this->idgroup = $idgroup;

        return $this;
    }

    public function getIdtype(): ?Type
    {
        return $this->idtype;
    }

    public function setIdtype(?Type $idtype): self
    {
        $this->idtype = $idtype;

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
