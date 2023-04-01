<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
#[Vich\Uploadable]
class Quiz implements \Serializable
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


    #[ORM\Column(length:255)]
    private ?string $image = "";

    #[Vich\UploadableField(mapping:"quiz", fileNameProperty:"image")]
    private File $imageFile;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: QuestionHasQuiz::class)]
    private Collection $questionHasQuizzes;


    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column]
    private ?bool $is_published = null;

    #[ORM\Column]
    private ?bool $is_waiting = null;

    #[ORM\Column]
    private ?bool $is_refused = null;

    #[ORM\OneToOne(mappedBy: 'quiz', cascade: ['persist', 'remove'])]
    private ?CommentsQuiz $commentsQuiz = null;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function __construct()
    {
        $this->questionHasQuizzes = new ArrayCollection();
        $this->questions = new ArrayCollection();
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


    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->is_published;
    }

    public function setIsPublished(bool $is_published): self
    {
        $this->is_published = $is_published;

        return $this;
    }

    public function isIsWaiting(): ?bool
    {
        return $this->is_waiting;
    }

    public function setIsWaiting(bool $is_waiting): self
    {
        $this->is_waiting = $is_waiting;

        return $this;
    }

    public function isIsRefused(): ?bool
    {
        return $this->is_refused;
    }

    public function setIsRefused(bool $is_refused): self
    {
        $this->is_refused = $is_refused;

        return $this;
    }

    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): File
    {
        return $this->imageFile;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getCommentsQuiz(): ?CommentsQuiz
    {
        return $this->commentsQuiz;
    }

    public function setCommentsQuiz(?CommentsQuiz $commentsQuiz): self
    {
        // unset the owning side of the relation if necessary
        if ($commentsQuiz === null && $this->commentsQuiz !== null) {
            $this->commentsQuiz->setQuiz(null);
        }

        // set the owning side of the relation if necessary
        if ($commentsQuiz !== null && $commentsQuiz->getQuiz() !== $this) {
            $commentsQuiz->setQuiz($this);
        }

        $this->commentsQuiz = $commentsQuiz;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

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

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->image,

        ));
    }

    public function unserialize(string $data)
    {
        list (
            $this->id,

            ) = unserialize($data);
    }


}
