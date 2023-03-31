<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\EventListner\PasswordSubscriber;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email!')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TwoFactorInterface
{
    use TimestampableTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email (message: "The email '{{ value }}' is not a valid email.")]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];
    
    #[ORM\Column(type: "string", nullable: true)]
    private string $authCode;

    private ?string $plainPassword = null;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: CommentaireVideo::class, orphanRemoval: false)]
    private Collection $Commentaire_id;

    #[ORM\ManyToMany(targetEntity: HkStat::class, mappedBy: 'user_id')]
    private Collection $stats_id;

    public function __construct()
    {
        $this->Commentaire_id = new ArrayCollection();
        $this->stats_id = new ArrayCollection();
        $this->categories = new ArrayCollection();
     }
        
    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Category::class)]
    private Collection $categories;

    #[ORM\OneToOne(mappedBy: 'createdBy', cascade: ['persist', 'remove'])]
    private ?Quiz $quiz = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?QuizMade $quizMade = null;

    #[ORM\Column(length: 65)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 4,
        minMessage: "Your firstname should be at least {{ limit }} characters",
        max: 65,
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 128)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 4,
        minMessage: "Your lastname should be at least {{ limit }} characters",
        max: 128,
    )]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $bithdate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        if ($plainPassword) {
            $this->updatedAT = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;
        return $this;
    }

    public function isEmailAuthEnabled(): bool
    {
        return true; // This can be a persisted field to switch email code authentication on/off
    }

    public function getEmailAuthRecipient(): string
    {
        return $this->email;
    }

    public function getEmailAuthCode(): string
    {
        if (null === $this->authCode) {
            throw new \LogicException('The email authentication code was not set');
        }

        return $this->authCode;
    }

    public function setEmailAuthCode(string $authCode): void
    {
        $this->authCode = $authCode;
    }

    /**
     * @return Collection<int, CommentaireVideo>
     */
    public function getCommentaireId(): Collection
    {
        return $this->Commentaire_id;
    }

    public function addCommentaireId(CommentaireVideo $videoId): self
    {
        if (!$this->Commentaire_id->contains($videoId)) {
            $this->Commentaire_id->add($videoId);
	    $videoId->setUserId($this);
	}

	return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setOwner($this);
        }

        return $this;
    }

    public function removeVideoId(CommentaireVideo $videoId): self
    {
        if ($this->Commentaire_id->removeElement($videoId)) {
            // set the owning side to null (unless already changed)
            if ($videoId->getUserId() === $this) {
		    $videoId->setUserId(null);
	    }
	}

	return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getOwner() === $this) {
                $category->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HkStat>
     */
    public function getStatId(): Collection
    {
        return $this->stats_id;
    }

    public function addStatId(HkStat $stats_id): self
    {
        if (!$this->stats_id->contains( $stats_id)) {
            $this->stats_id->add($stats_id);
            $stats_id->addUserId($this);
        }
     }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(Quiz $quiz): self
    {
        // set the owning side of the relation if necessary
        if ($quiz->getCreatedBy() !== $this) {
            $quiz->setCreatedBy($this);
        }

        $this->quiz = $quiz;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getQuizMade(): ?QuizMade
    {
        return $this->quizMade;
    }

    public function setQuizMade(QuizMade $quizMade): self
    {
        // set the owning side of the relation if necessary
        if ($quizMade->getUserId() !== $this) {
            $quizMade->setUserId($this);
        }

        $this->quizMade = $quizMade;
    }
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getBithdate(): ?\DateTimeInterface
    {
        return $this->bithdate;
    }

    public function setBithdate(\DateTimeInterface $bithdate): self
    {
        $this->bithdate = $bithdate;
        return $this;
    }

}
