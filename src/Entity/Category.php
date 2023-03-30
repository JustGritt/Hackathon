<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 65)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 4,
        minMessage: "Your category name should be at least {{ limit }} characters",
        max: 65,
    )]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?User $owner = null;

    #[ORM\Column(nullable: true)]
    #[Assert\LessThan(propertyPath: 'maxAge', message: 'The min age must be less than the max age')]
    #[Assert\GreaterThan(value: 0, message: 'The min age must be greater than 0')]
    private ?int $minAge = null;

    #[ORM\Column(nullable: true)]
    #[Assert\GreaterThan(propertyPath: 'minAge', message: 'The max age must be greater than the min age')]
    #[Assert\LessThan(value: 100, message: 'The max age must be less than 100')]
    private ?int $maxAge = null;

    #[ORM\OneToOne(mappedBy: 'category')]
    private ?Quiz $quiz = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Quiz::class)]
    private Collection $quizzes;

    public function __construct()
    {
        $this->quizzes = new ArrayCollection();
    }

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

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getMinAge(): ?int
    {
        return $this->minAge;
    }

    public function setMinAge(?int $minAge): self
    {
        $this->minAge = $minAge;

        return $this;
    }

    public function getMaxAge(): ?int
    {
        return $this->maxAge;
    }

    public function setMaxAge(?int $maxAge): self
    {
        $this->maxAge = $maxAge;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(Quiz $quiz): self
    {
        // set the owning side of the relation if necessary
        if ($quiz->getCategory() !== $this) {
            $quiz->setCategory($this);
        }

        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return Collection<int, Quiz>
     */
    public function getQuizzes(): Collection
    {
        return $this->quizzes;
    }

    public function addQuiz(Quiz $quiz): self
    {
        if (!$this->quizzes->contains($quiz)) {
            $this->quizzes->add($quiz);
            $quiz->setCategory($this);
        }

        return $this;
    }

    public function removeQuiz(Quiz $quiz): self
    {
        if ($this->quizzes->removeElement($quiz)) {
            // set the owning side to null (unless already changed)
            if ($quiz->getCategory() === $this) {
                $quiz->setCategory(null);
            }
        }

        return $this;
    }

}
