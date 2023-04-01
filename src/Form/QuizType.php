<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Form\Helpers\StringToFileTransformer;
use App\Form\Type\CategoryEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class)
            ->add('description',TextareaType::class,array(
                'attr' => array('cols' => '5', 'rows' => '5'),
            ))
            ->add('imageFile',VichImageType::class)
            ->add('is_active', CheckboxType::class, [
                'label' => 'Is Active?',
                'data' => false, // Set default value to true
                'required' => false
            ])
            ->add('is_published', CheckboxType::class, [
                'data' => false, // Set default value to true
                'required' => false
            ])
            ->add('is_waiting', CheckboxType::class,[
                'data' => false, // Set default value to true
                'required' => false
            ])
            ->add('is_refused', CheckboxType::class, [
                'data' => false, // Set default value to true
                'required' => false
            ])
            ->add('category', CategoryEntityType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}

