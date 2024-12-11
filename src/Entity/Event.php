<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein')]
    #[Assert\Length(
        min: 5,
        max: 100,
        minMessage: 'Das muss min. {{ limit }} Zeichen haben!',
        maxMessage: 'Das darf max. {{ limit }} Zeichen haben!'
    )]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein')]
    #[Assert\PositiveOrZero(message: 'Der Wert muss größer/gleich 0 sein!')]
    private ?int $bookedSeats = null;

    #[ORM\Column(nullable: true, enumType: EventTypeEnum::class)]
    private ?EventTypeEnum $eventType = null;




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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBookedSeats(): ?int
    {
        return $this->bookedSeats;
    }

    public function setBookedSeats(int $bookedSeats): static
    {
        $this->bookedSeats = $bookedSeats;

        return $this;
    }

    public function seats(): int
    {
        return 200 - $this->bookedSeats;
    }

    /**
     * @return ?EventTypeEnum
     */
    public function getEventType(): ?EventTypeEnum
    {
        return $this->eventType;
    }

    public function setEventType(?EventTypeEnum $eventType): static
    {
        $this->eventType = $eventType;

        return $this;
    }



}
