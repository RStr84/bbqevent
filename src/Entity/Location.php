<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
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
        minMessage: 'Das muss min. {{ limit }} Zeichen lang sein!',
        maxMessage: 'Das darf max. {{ limit }} Zeichen lang sein!')]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein!')]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Das muss min. {{ limit }} Zeichen lang sein!',
        maxMessage: 'Das darf max. {{ limit }} Zeichen lang sein!'
    )]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Das darf nicht leer sein!')]
    #[Assert\Email(message:'Das ist keine korrekte E-Mail-Adresse!')]
    private ?string $email = null;



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
}
