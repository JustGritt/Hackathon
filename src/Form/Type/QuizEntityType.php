<?php
namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizEntityType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Quiz::class,
            'choice_label' => function (Quiz $quiz) {
                return $quiz->getName();
            },
        ]);
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
