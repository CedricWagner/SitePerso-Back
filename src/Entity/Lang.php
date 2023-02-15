<?php

namespace App\Entity;

use App\Repository\LangRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangRepository::class)]
class Lang
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 31)]
    private ?string $name = null;

    #[ORM\Column(length: 2)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?bool $isDefault = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function isIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }
}
