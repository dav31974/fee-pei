<?php

namespace App\Form;

use App\Entity\Product;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre","Choisissez un titre pour la prestation / produit"))
            ->add('description', TextareaType::class, $this->getConfiguration("description","Tapez la description du produit"))
            ->add('duration', TimeType::class, $this->getConfiguration("Durée de la prestation",""))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix de la prestation","Entrez le prix de la prestation / produit"))
            ->add('cover', FileType::class, array(
                'data_class' => null
                )
            )
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Visage' => "visage",
                    'Corps' => "corps",
                    'Epilations' => "epilation",
                    'Boutique' => "boutique",
                    'regard' => "regard"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class, 
        ]);
    }
}
