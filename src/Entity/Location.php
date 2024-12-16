<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: LocationRepository::class)]
#[UniqueEntity('email', message: '{{ value }} ist schon in Gebrauch!')]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein!')]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Das muss min. {{ limit }} Zeichen haben!',
        maxMessage: 'Das darf max. {{ limit }} Zeichen haben!')]
    private ?string $name = null;


    #[ORM\Column]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein!')]
    #[Assert\PositiveOrZero(message: 'Der Wert muss größer/gleich 0 sein!')]
    private ?int $capacity = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein!')]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Das muss min. {{ limit }} Zeichen haben!',
        maxMessage: 'Das darf max. {{ limit }} Zeichen haben!'
    )]
    private ?string $address = null;


    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein!')]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Das muss min. {{ limit }} Zeichen haben!',
        maxMessage: 'Das darf max. {{ limit }} Zeichen haben!'
    )]
    #[Assert\Email(message:'Das ist keine korrekte E-Mail-Adresse!')]
    private ?string $email = null;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'location')]
    private Collection $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

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

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setLocation($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getLocation() === $this) {
                $event->setLocation(null);
            }
        }

        return $this;
    }
}
