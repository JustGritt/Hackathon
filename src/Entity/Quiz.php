<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: QuestionHasQuiz::class)]
    private Collection $questionHasQuizzes;

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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

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
}
