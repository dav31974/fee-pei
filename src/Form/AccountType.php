<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AccountType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom de famille..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email..."))
            ->add('phoneNumber', TextType::class, $this->getConfiguration("Tel", "Votre numéro de telephone"))        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
