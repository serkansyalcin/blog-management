<?php

namespace App\Entity;

use App\Repository\ArticalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticalRepository::class)]
class Artical
{
    public const _ACTIVE             = true;
    public const _INACTIVE           = false;
    public const _ACTIVE_LABEL       = 'Active';
    public const _INACTIVE_LABEL     = 'In-active';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $blogTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $blogContent = null;

    #[ORM\Column(nullable: true, options: ["default" => 1])]
    private ?bool $blogStatus = self::_ACTIVE;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $authorName = null;

    #[Assert\Email(message: 'Enter Valid Email')]
    #[Assert\NotBlank(message: 'Email should not be blank')]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $authorEmail = null;

    #[ORM\Column(type: 'bigint',nullable: true)]
    private ?int $authorMobile = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $authorInfo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModified = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogTitle(): ?string
    {
        return $this->blogTitle;
    }

    public function setBlogTitle(?string $blogTitle): static
    {
        $this->blogTitle = $blogTitle;

        return $this;
    }

    public function getBlogContent(): ?string
    {
        return $this->blogContent;
    }

    public function setBlogContent(?string $blogContent): static
    {
        $this->blogContent = $blogContent;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): static
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getAuthorEmail(): ?string
    {
        return $this->authorEmail;
    }

    public function setAuthorEmail(?string $authorEmail): static
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    public function getAuthorMobile(): ?int
    {
        return $this->authorMobile;
    }

    public function setAuthorMobile(?int $authorMobile): static
    {
        $this->authorMobile = $authorMobile;

        return $this;
    }

    public function getAuthorInfo(): ?string
    {
        return $this->authorInfo;
    }

    public function setAuthorInfo(?string $authorInfo): static
    {
        $this->authorInfo = $authorInfo;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTimeInterface $dateModified): static
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getBlogStatus(): ?bool
    {
        return $this->blogStatus;
    }

    public function setBlogStatus(?bool $blogStatus): static
    {
        $this->blogStatus = $blogStatus;

        return $this;
    }
}
