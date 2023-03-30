<?php

namespace App\Entity;

use App\Repository\HkVideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: HkVideoRepository::class)]
class HkVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'video_id', targetEntity: CommentaireVideo::class, orphanRemoval: true)]
    private Collection $commentaireVideos;

    #[ORM\Column]
    private ?bool $waiting = null;

    #[ORM\Column]
    private ?bool $publish = null;

    #[ORM\Column]
    private ?bool $refused = null;

    #[ORM\ManyToMany(targetEntity: HkStat::class, mappedBy: 'video_id')]
    private Collection $hkStats;

    #[ORM\ManyToOne(inversedBy: 'hkVideos')]
    private ?Category $category = null;

    public function __construct()
    {
        $this->commentaireVideos = new ArrayCollection();
        $this->hkStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CommentaireVideo>
     */
    public function getCommentaireVideos(): Collection
    {
        return $this->commentaireVideos;
    }

    public function addCommentaireVideo(CommentaireVideo $commentaireVideo): self
    {
        if (!$this->commentaireVideos->contains($commentaireVideo)) {
            $this->commentaireVideos->add($commentaireVideo);
            $commentaireVideo->setVideoId($this);
        }

        return $this;
    }

    public function removeCommentaireVideo(CommentaireVideo $commentaireVideo): self
    {
        if ($this->commentaireVideos->removeElement($commentaireVideo)) {
            // set the owning side to null (unless already changed)
            if ($commentaireVideo->getVideoId() === $this) {
                $commentaireVideo->setVideoId(null);
            }
        }

        return $this;
    }

    public function isWaiting(): ?bool
    {
        return $this->waiting;
    }

    public function setWaiting(bool $waiting): self
    {
        $this->waiting = $waiting;

        return $this;
    }

    public function isPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(bool $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

    public function isRefused(): ?bool
    {
        return $this->refused;
    }

    public function setRefused(bool $refused): self
    {
        $this->refused = $refused;

        return $this;
    }

    /**
     * @return Collection<int, HkStat>
     */
    public function getHkStats(): Collection
    {
        return $this->hkStats;
    }

    public function addHkStat(HkStat $hkStat): self
    {
        if (!$this->hkStats->contains($hkStat)) {
            $this->hkStats->add($hkStat);
            $hkStat->addVideoId($this);
        }

        return $this;
    }

    public function removeHkStat(HkStat $hkStat): self
    {
        if ($this->hkStats->removeElement($hkStat)) {
            $hkStat->removeVideoId($this);
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
    
}
