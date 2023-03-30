<?php

namespace App\Entity;

use App\Repository\CommentaireVideoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireVideoRepository::class)]
class CommentaireVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'Commentaire_id')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireVideos')]
    #[ORM\JoinColumn(nullable: true)]
    private ?HkVideo $video_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getVideoId(): ?HkVideo
    {
        return $this->video_id;
    }

    public function setVideoId(?HkVideo $video_id): self
    {
        $this->video_id = $video_id;

        return $this;
    }
}
