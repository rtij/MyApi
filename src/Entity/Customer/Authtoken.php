<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Authtoken
 *
 * @ORM\Table(name="authtoken", uniqueConstraints={@ORM\UniqueConstraint(name="token", columns={"token"})}, indexes={@ORM\Index(name="fk_user_token", columns={"idUser"})})
 * @ORM\Entity
 */
class Authtoken
{
    /**
     * @var int
     *
     * @ORM\Column(name="idToken", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtoken;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $createdat = 'CURRENT_DATE';

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

    public function getIdtoken(): ?int
    {
        return $this->idtoken;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

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
