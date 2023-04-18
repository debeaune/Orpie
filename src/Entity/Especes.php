<?php

namespace App\Entity;

use App\Repository\EspecesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use DateTime;

#[ORM\Entity(repositoryClass: EspecesRepository::class)]
class Especes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $espece = null;

    #[ORM\Column(length: 255)]
    private ?string $Ordre = null;

    #[ORM\Column(length: 255)]
    private ?string $famille = null;

    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAnglais = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFrancais = null;

    #[ORM\Column(type:'datetime')]
    private ?\DateTime $decritEn = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $update_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ordre = null;

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

    public function getOrdre(): ?string
    {
        return $this->Ordre;
    }

    public function setOrdre(string $Ordre): self
    {
        $this->Ordre = $Ordre;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getNomAnglais(): ?string
    {
        return $this->nomAnglais;
    }

    public function setNomAnglais(string $nomAnglais): self
    {
        $this->nomAnglais = $nomAnglais;

        return $this;
    }

    public function getNomFrancais(): ?string
    {
        return $this->nomFrancais;
    }

    public function setNomFrancais(string $nomFrancais): self
    {
        $this->nomFrancais = $nomFrancais;

        return $this;
    }

    public function getDecritEn(): ?\DateTime
    {
        return $this->decritEn;
    }

    public function setDecritEn(\DateTime $decritEn): self
    {
        $this->decritEn = $decritEn;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeImmutable $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }
}
