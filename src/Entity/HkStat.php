<?php

namespace App\Entity;

use App\Repository\HkStatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HkStatRepository::class)]
class HkStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'video_id')]
    private Collection $user_id;

    #[ORM\ManyToMany(targetEntity: HkVideo::class, inversedBy: 'hkStats')]
    private Collection $video_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->video_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->user_id->removeElement($userId);

        return $this;
    }

    /**
     * @return Collection<int, HkVideo>
     */
    public function getVideoId(): Collection
    {
        return $this->video_id;
    }

    public function addVideoId(HkVideo $videoId): self
    {
        if (!$this->video_id->contains($videoId)) {
            $this->video_id->add($videoId);
        }

        return $this;
    }

    public function removeVideoId(HkVideo $videoId): self
    {
        $this->video_id->removeElement($videoId);

        return $this;
    }
}
