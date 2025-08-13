<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'marque', cascade: ['persist', 'remove'])]
    private ?Voiture $voiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): static
    {
        // unset the owning side of the relation if necessary
        if ($voiture === null && $this->voiture !== null) {
            $this->voiture->setMarque(null);
        }

        // set the owning side of the relation if necessary
        if ($voiture !== null && $voiture->getMarque() !== $this) {
            $voiture->setMarque($this);
        }

        $this->voiture = $voiture;

        return $this;
    }
}
