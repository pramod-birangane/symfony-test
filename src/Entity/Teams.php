<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamsRepository")
 */
class Teams
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Leagues", inversedBy="Teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $League;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Strip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeague(): ?Leagues
    {
        return $this->League;
    }

    public function setLeague(?Leagues $League): self
    {
        $this->League = $League;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getStrip(): ?string
    {
        return $this->Strip;
    }

    public function setStrip(string $Strip): self
    {
        $this->Strip = $Strip;

        return $this;
    }
}
