<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", uniqueConstraints={@ORM\UniqueConstraint(name="RefProduit", columns={"RefProduit"})}, indexes={@ORM\Index(name="fk_produit_famille", columns={"idFamille"}), @ORM\Index(name="fk_produit_unite", columns={"idU"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProd", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprod;

    /**
     * @var string
     *
     * @ORM\Column(name="RefProduit", type="string", length=30, nullable=false)
     */
    private $refproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="desProduit", type="string", length=50, nullable=false)
     */
    private $desproduit;

    /**
     * @var int
     *
     * @ORM\Column(name="PrixAP", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $prixap;

    /**
     * @var int
     *
     * @ORM\Column(name="PrixVP", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $prixvp;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="prod_sup", type="boolean", nullable=true)
     */
    private $prodSup;

    /**
     * @var int
     *
     * @ORM\Column(name="SeuilAp", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $seuilap;

    /**
     * @var \Famille
     *
     * @ORM\ManyToOne(targetEntity="Famille")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFamille", referencedColumnName="idFamille")
     * })
     */
    private $idfamille;

    /**
     * @var \Unite
     *
     * @ORM\ManyToOne(targetEntity="Unite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idU", referencedColumnName="idU")
     * })
     */
    private $idu;

    public function getIdprod(): ?int
    {
        return $this->idprod;
    }

    public function getRefproduit(): ?string
    {
        return $this->refproduit;
    }

    public function setRefproduit(string $refproduit): self
    {
        $this->refproduit = $refproduit;

        return $this;
    }

    public function getDesproduit(): ?string
    {
        return $this->desproduit;
    }

    public function setDesproduit(string $desproduit): self
    {
        $this->desproduit = $desproduit;

        return $this;
    }

    public function getPrixap(): ?int
    {
        return $this->prixap;
    }

    public function setPrixap(int $prixap): self
    {
        $this->prixap = $prixap;

        return $this;
    }

    public function getPrixvp(): ?int
    {
        return $this->prixvp;
    }

    public function setPrixvp(int $prixvp): self
    {
        $this->prixvp = $prixvp;

        return $this;
    }

    public function getProdSup(): ?bool
    {
        return $this->prodSup;
    }

    public function setProdSup(?bool $prodSup): self
    {
        $this->prodSup = $prodSup;

        return $this;
    }

    public function getSeuilap(): ?int
    {
        return $this->seuilap;
    }

    public function setSeuilap(int $seuilap): self
    {
        $this->seuilap = $seuilap;

        return $this;
    }

    public function getIdfamille(): ?Famille
    {
        return $this->idfamille;
    }

    public function setIdfamille(?Famille $idfamille): self
    {
        $this->idfamille = $idfamille;

        return $this;
    }

    public function getIdu(): ?Unite
    {
        return $this->idu;
    }

    public function setIdu(?Unite $idu): self
    {
        $this->idu = $idu;

        return $this;
    }

}
