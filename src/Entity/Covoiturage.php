<?php

namespace App\Entity;

use App\Repository\CovoiturageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CovoiturageRepository::class)]
class Covoiturage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_depart = null;

    /**
     * @var Collection<int, Participe>
     */
    #[ORM\OneToMany(targetEntity: Participe::class, mappedBy: 'covoiturage')]
    private Collection $participants;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_depart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heure_depart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_arrivee = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $heure_arrivee = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_arrivee = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nb_place = null;

    #[ORM\Column]
    private ?int $prix_personne = null;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieu_depart;
    }

    public function setLieuDepart(string $lieu_depart): static
    {
        $this->lieu_depart = $lieu_depart;

        return $this;
    }

    /**
     * @return Collection<int, Participe>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participe $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setCovoiturage($this);
        }

        return $this;
    }

    public function removeParticipant(Participe $participant): static
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getCovoiturage() === $this) {
                $participant->setCovoiturage(null);
            }
        }

        return $this;
    }

    public function getDateDepart(): ?\DateTime
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTime $date_depart): static
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getHeureDepart(): ?\DateTime
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(\DateTime $heure_depart): static
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTime
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(?\DateTime $date_arrivee): static
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTime
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(?\DateTime $heure_arrivee): static
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getLieuArrivee(): ?string
    {
        return $this->lieu_arrivee;
    }

    public function setLieuArrivee(string $lieu_arrivee): static
    {
        $this->lieu_arrivee = $lieu_arrivee;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): static
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getPrixPersonne(): ?int
    {
        return $this->prix_personne;
    }

    public function setPrixPersonne(int $prix_personne): static
    {
        $this->prix_personne = $prix_personne;

        return $this;
    }
}
