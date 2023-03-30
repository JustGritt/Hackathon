<?php

namespace App\Form;

use App\Entity\HkVideo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HkVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('link')
            ->add('active')
            ->add('description')
            ->add('waiting')
            ->add('publish')
            ->add('refused')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HkVideo::class,
        ]);
    }
}
