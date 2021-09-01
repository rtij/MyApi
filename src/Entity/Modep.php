<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modep
 *
 * @ORM\Table(name="modep")
 * @ORM\Entity
 */
class Modep
{
    /**
     * @var int
     *
     * @ORM\Column(name="CodeMp", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codemp;

    /**
     * @var string
     *
     * @ORM\Column(name="DesMp", type="string", length=20, nullable=false)
     */
    private $desmp;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ModeP_sup", type="boolean", nullable=true)
     */
    private $modepSup;

    public function getCodemp(): ?int
    {
        return $this->codemp;
    }

    public function getDesmp(): ?string
    {
        return $this->desmp;
    }

    public function setDesmp(string $desmp): self
    {
        $this->desmp = $desmp;

        return $this;
    }

    public function getModepSup(): ?bool
    {
        return $this->modepSup;
    }

    public function setModepSup(?bool $modepSup): self
    {
        $this->modepSup = $modepSup;

        return $this;
    }


}
