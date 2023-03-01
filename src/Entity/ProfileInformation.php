<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Repository\ProfileInformationRepository;
use App\State\ProfileInformationProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileInformationRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    order: ['weight' => 'ASC', 'slug' => 'ASC'],
    paginationEnabled: false
)]
#[ApiFilter(SearchFilter::class, properties: ['langs.slug' => 'exact', 'slug' => 'exact'])]
class ProfileInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 127)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\ManyToMany(targetEntity: Lang::class)]
    private Collection $langs;

    #[ORM\Column(nullable: true)]
    private ?bool $isPrivate = null;

    #[ORM\Column(nullable: true)]
    private ?int $weight = null;

    public function __construct()
    {
        $this->langs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, Lang>
     */
    public function getLangs(): Collection
    {
        return $this->langs;
    }

    public function addLang(Lang $lang): self
    {
        if (!$this->langs->contains($lang)) {
            $this->langs->add($lang);
        }

        return $this;
    }

    public function removeLang(Lang $lang): self
    {
        $this->langs->removeElement($lang);

        return $this;
    }

    public function isPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(?bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
