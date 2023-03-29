<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 4,
        minMessage: "Your question should be at least {{ limit }} characters",
        max: 150,
    )]
    private ?string $content = null;

    #[ORM\Column]
    private bool $is_response = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isIsResponse(): ?bool
    {
        return $this->is_response;
    }

    public function setIsResponse(bool $is_response): self
    {
        $this->is_response = $is_response;

        return $this;
    }
}
