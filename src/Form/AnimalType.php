<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Enclos;
use App\Entity\Espece;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal', null, ['empty_data' => ''])
            ->add('descriptionAnimal', null, ['empty_data' => ''])
            ->add('enclos', EntityType::class, [
                'class' => Enclos::class,
                'choice_label' => 'nomEnclos',
                'required' => true,
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                        ->orderBy('e.nomEnclos', 'ASC');
                }])
            ->add('espece', EntityType::class, [
                'class' => Espece::class,
                'choice_label' => 'libEspece',
                'required' => true,
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                        ->orderBy('e.libEspece', 'ASC');
                },
                ])
            ->add('image', FileType::class, [
                'data_class' => null,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ]]),
            ]])
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
