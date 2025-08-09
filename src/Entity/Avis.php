<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $commentaire = null;

  #[ORM\Column]
  private ?int $note = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $statut = null;

  #[ORM\ManyToOne(inversedBy: 'depots')]
  private ?Utilisateur $depot = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getCommentaire(): ?string
  {
    return $this->commentaire;
  }

  public function setCommentaire(?string $commentaire): static
  {
    $this->commentaire = $commentaire;

    return $this;
  }

  public function getNote(): ?int
  {
    return $this->note;
  }

  public function setNote(int $note): static
  {
    $this->note = $note;

    return $this;
  }

  public function getStatut(): ?string
  {
    return $this->statut;
  }

  public function setStatut(?string $statut): static
  {
    $this->statut = $statut;

    return $this;
  }

  public function getDepot(): ?Utilisateur
  {
      return $this->depot;
  }

  public function setDepot(?Utilisateur $depot): static
  {
      $this->depot = $depot;

      return $this;
  }
}
