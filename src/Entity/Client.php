<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCl", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcl;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCl", type="string", length=50, nullable=false)
     */
    private $nomcl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AdrCl", type="string", length=50, nullable=true)
     */
    private $adrcl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EmailCl", type="string", length=80, nullable=true)
     */
    private $emailcl;

    /**
     * @var bool
     *
     * @ORM\Column(name="client_sup", type="boolean", nullable=false)
     */
    private $clientSup = '0';

    public function getIdcl(): ?int
    {
        return $this->idcl;
    }

    public function getNomcl(): ?string
    {
        return $this->nomcl;
    }

    public function setNomcl(string $nomcl): self
    {
        $this->nomcl = $nomcl;

        return $this;
    }

    public function getAdrcl(): ?string
    {
        return $this->adrcl;
    }

    public function setAdrcl(?string $adrcl): self
    {
        $this->adrcl = $adrcl;

        return $this;
    }

    public function getEmailcl(): ?string
    {
        return $this->emailcl;
    }

    public function setEmailcl(?string $emailcl): self
    {
        $this->emailcl = $emailcl;

        return $this;
    }

    public function getClientSup(): ?bool
    {
        return $this->clientSup;
    }

    public function setClientSup(bool $clientSup): self
    {
        $this->clientSup = $clientSup;

        return $this;
    }

}
