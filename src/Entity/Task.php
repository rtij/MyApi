<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTask", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtask;

    /**
     * @var string
     *
     * @ORM\Column(name="TitleT", type="string", length=50, nullable=false)
     */
    private $titlet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descT", type="text", length=65535, nullable=true)
     */
    private $desct;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="taskF", type="binary", nullable=true, options={"default"="1"})
     */
    private $taskf = '1';

    public function getIdtask(): ?int
    {
        return $this->idtask;
    }

    public function getTitlet(): ?string
    {
        return $this->titlet;
    }

    public function setTitlet(string $titlet): self
    {
        $this->titlet = $titlet;

        return $this;
    }

    public function getDesct(): ?string
    {
        return $this->desct;
    }

    public function setDesct(?string $desct): self
    {
        $this->desct = $desct;

        return $this;
    }

    public function getTaskf()
    {
        return $this->taskf;
    }

    public function setTaskf($taskf): self
    {
        $this->taskf = $taskf;

        return $this;
    }


}
