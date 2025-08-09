<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nom = null;

  /**
   * @var Collection<int, Participe>
   */
  #[ORM\OneToMany(targetEntity: Participe::class, mappedBy: 'utilisateur')]
  private Collection $participations;

  #[ORM\Column(length: 255)]
  private ?string $prenom = null;

  #[ORM\Column(length: 255)]
  private ?string $email = null;

  #[ORM\Column(length: 255)]
  private ?string $password = null;

  #[ORM\Column(length: 255)]
  private ?string $telephone = null;

  #[ORM\Column(length: 255)]
  private ?string $adresse = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTime $date_naissance = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $photo = null;

  #[ORM\Column(length: 255)]
  private ?string $pseudo = null;

  /**
   * @var Collection<int, Role>
   */
  #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'utilisateurs')]
  private Collection $roles;

  /**
   * @var Collection<int, Avis>
   */
  #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'depot')]
  private Collection $depots;

  public function __construct()
  {
    $this->participations = new ArrayCollection();
    $this->roles = new ArrayCollection();
    $this->depots = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNom(): ?string
  {
    return $this->nom;
  }

  public function setNom(string $nom): static
  {
    $this->nom = $nom;

    return $this;
  }

  /**
   * @return Collection<int, Participe>
   */
  public function getParticipations(): Collection
  {
    return $this->participations;
  }

  public function addParticipation(Participe $participation): static
  {
    if (!$this->participations->contains($participation)) {
      $this->participations->add($participation);
      $participation->setUtilisateur($this);
    }

    return $this;
  }

  public function removeParticipation(Participe $participation): static
  {
    if ($this->participations->removeElement($participation)) {
      // set the owning side to null (unless already changed)
      if ($participation->getUtilisateur() === $this) {
        $participation->setUtilisateur(null);
      }
    }

    return $this;
  }

  public function getPrenom(): ?string
  {
    return $this->prenom;
  }

  public function setPrenom(string $prenom): static
  {
    $this->prenom = $prenom;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;

    return $this;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function setPassword(string $password): static
  {
    $this->password = $password;

    return $this;
  }

  public function getTelephone(): ?string
  {
    return $this->telephone;
  }

  public function setTelephone(string $telephone): static
  {
    $this->telephone = $telephone;

    return $this;
  }

  public function getAdresse(): ?string
  {
    return $this->adresse;
  }

  public function setAdresse(string $adresse): static
  {
    $this->adresse = $adresse;

    return $this;
  }

  public function getDateNaissance(): ?\DateTime
  {
    return $this->date_naissance;
  }

  public function setDateNaissance(\DateTime $date_naissance): static
  {
    $this->date_naissance = $date_naissance;

    return $this;
  }

  public function getPhoto(): ?string
  {
    return $this->photo;
  }

  public function setPhoto(?string $photo): static
  {
    $this->photo = $photo;

    return $this;
  }

  public function getPseudo(): ?string
  {
    return $this->pseudo;
  }

  public function setPseudo(string $pseudo): static
  {
    $this->pseudo = $pseudo;

    return $this;
  }

  /**
   * @return Collection<int, Role>
   */
  public function getRoles(): Collection
  {
    return $this->roles;
  }

  public function addRole(Role $role): static
  {
    if (!$this->roles->contains($role)) {
      $this->roles->add($role);
    }

    return $this;
  }

  public function removeRole(Role $role): static
  {
    $this->roles->removeElement($role);

    return $this;
  }

  /**
   * @return Collection<int, Avis>
   */
  public function getDepots(): Collection
  {
      return $this->depots;
  }

  public function addDepot(Avis $depot): static
  {
      if (!$this->depots->contains($depot)) {
          $this->depots->add($depot);
          $depot->setDepot($this);
      }

      return $this;
  }

  public function removeDepot(Avis $depot): static
  {
      if ($this->depots->removeElement($depot)) {
          // set the owning side to null (unless already changed)
          if ($depot->getDepot() === $this) {
              $depot->setDepot(null);
          }
      }

      return $this;
  }
}
