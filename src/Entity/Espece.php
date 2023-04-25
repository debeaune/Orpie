<?php

namespace App\Entity;

use App\Repository\EspeceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspeceRepository::class)]
class Espece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $espece = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ordre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $famille = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomAnglais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomFrancais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripteur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $decritEn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $habitat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(string $espece): self
    {
        $this->espece = $espece;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getOrdre(): ?string
    {
        return $this->ordre;
    }

    public function setOrdre(?string $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(?string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getNomAnglais(): ?string
    {
        return $this->nomAnglais;
    }

    public function setNomAnglais(?string $nomAnglais): self
    {
        $this->nomAnglais = $nomAnglais;

        return $this;
    }

    public function getNomFrancais(): ?string
    {
        return $this->nomFrancais;
    }

    public function setNomFrancais(?string $nomFrancais): self
    {
        $this->nomFrancais = $nomFrancais;

        return $this;
    }

    public function getDescripteur(): ?string
    {
        return $this->descripteur;
    }

    public function setDescripteur(?string $descripteur): self
    {
        $this->descripteur = $descripteur;

        return $this;
    }

    public function getDecritEn(): ?\DateTimeInterface
    {
        return $this->decritEn;
    }

    public function setDecritEn(?\DateTimeInterface $decritEn): self
    {
        $this->decritEn = $decritEn;

        return $this;
    }

    public function getHabitat(): ?string
    {
        return $this->habitat;
    }

    public function setHabitat(?string $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }
}
