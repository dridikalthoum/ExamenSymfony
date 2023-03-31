<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $noteVote = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Joueur $id_joueur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNoteVote(): ?float
    {
        return $this->noteVote;
    }

    public function setNoteVote(float $noteVote): self
    {
        $this->noteVote = $noteVote;

        return $this;
    }

    public function getIdJoueur(): ?Joueur
    {
        return $this->id_joueur;
    }

    public function setIdJoueur(Joueur $id_joueur): self
    {
        $this->id_joueur = $id_joueur;

        return $this;
    }
}
