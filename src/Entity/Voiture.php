<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'voiture', cascade: ['persist', 'remove'])]
    private ?Marque $marque = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'voiture')]
    private Collection $utilisateurs;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'voitures')]
    private Collection $utilisateur;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'utilisateur')]
    private Collection $voitures;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->utilisateur = new ArrayCollection();
        $this->voitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->addVoiture($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            $utilisateur->removeVoiture($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    /**
     * @return Collection<int, self>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(self $voiture): static
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->addUtilisateur($this);
        }

        return $this;
    }

    public function removeVoiture(self $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            $voiture->removeUtilisateur($this);
        }

        return $this;
    }
}
