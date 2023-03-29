<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 4,
        minMessage: "Your quiz should be at least {{ limit }} characters",
        max: 255,
    )]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: QuestionHasQuiz::class)]
    private Collection $questionHasQuizzes;

    #[ORM\OneToOne(inversedBy: 'quiz', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToOne(inversedBy: 'quiz', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    public function __construct()
    {
        $this->questionHasQuizzes = new ArrayCollection();
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


    /**
     * @return Collection<int, QuestionHasQuiz>
     */
    public function getQuestionHasQuizzes(): Collection
    {
        return $this->questionHasQuizzes;
    }

    public function addQuestionHasQuiz(QuestionHasQuiz $questionHasQuiz): self
    {
        if (!$this->questionHasQuizzes->contains($questionHasQuiz)) {
            $this->questionHasQuizzes->add($questionHasQuiz);
            $questionHasQuiz->setQuiz($this);
        }
        return $this;
    }

    public function removeQuestionHasQuiz(QuestionHasQuiz $questionHasQuiz): self
    {
        if ($this->questionHasQuizzes->removeElement($questionHasQuiz)) {
            // set the owning side to null (unless already changed)
            if ($questionHasQuiz->getQuiz() === $this) {
                $questionHasQuiz->setQuiz(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
