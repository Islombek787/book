<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\PersonCreateAction;
use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'createPerson' => [
            'method' => 'post',
            'path' => 'persons',
            'controller' => PersonCreateAction::class
        ]
    ],
    itemOperations: ['delete', 'get'],
    denormalizationContext: ['groups' => ['person:read']],
    normalizationContext: ['groups' => ['person:write']]
)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['person:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['person:read', 'person:write'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['person:write', 'person:read'])]
    private $lastname;

    #[ORM\Column(type: 'integer')]
    #[Groups(['person:read','person:write'])]
    private $age;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
