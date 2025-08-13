<?php

namespace App\Entity;

use App\Repository\CovoiturageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CovoiturageRepository::class)]
class Covoiturage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Participe>
     */
    #[ORM\OneToMany(targetEntity: Participe::class, mappedBy: 'covoiturage')]
    private Collection $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
