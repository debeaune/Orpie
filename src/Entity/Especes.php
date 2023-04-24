<?php

namespace App\Entity;

use App\Repository\EspecesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspecesRepository::class)]
class Especes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $espece = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ordre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $famille = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomAnglais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomFrancais = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $decrit_en = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $update_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(?string $espece): self
    {
        $this->espece = $espece;

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

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

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

    public function getDecritEn(): ?\DateTimeInterface
    {
        return $this->decrit_en;
    }

    public function setDecritEn(?\DateTimeInterface $decrit_en): self
    {
        $this->decrit_en = $decrit_en;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeImmutable $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }
}