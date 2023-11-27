<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Espece;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal', null, ['empty_data' => ''])
            ->add('descriptionAnimal', null, ['empty_data' => ''])
            ->add('espece', EntityType::class, [
                'class' => Espece::class,
                'choice_label' => 'libEspece',
                'required' => true,
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                        ->orderBy('e.libEspece', 'ASC');
                },
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
            'csrf_protection' => false,
        ]);
    }
}
