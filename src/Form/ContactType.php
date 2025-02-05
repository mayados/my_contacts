<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label' => "Prénom *",
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le titre ne peut pas être vide']),
                    new Assert\Length(['min' => 2, 'max' => 25, 'minMessage' => 'Le prénom doit faire au moins {{ limit }} caractères', 'maxMessage' => 'Le prénom ne peut pas faire plus de {{ limit }} caractères'])
                ]
            ])
            ->add('lastname',TextType::class,[
                'label' => "Nom *",
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom ne peut pas être vide']),
                    new Assert\Length(['min' => 2, 'max' => 100, 'minMessage' => 'Le nom doit faire au moins {{ limit }} caractères', 'maxMessage' => 'Le nom ne peut pas faire plus de {{ limit }} caractères'])
                ]
            ])
            ->add('phone',TextType::class,[
                'label' => "Téléphone",
                'required' => false,
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 20, 'minMessage' => 'Le numéro de téléphone doit faire au moins {{ limit }} caractères', 'maxMessage' => 'Le numéro de téléphone ne peut pas faire plus de {{ limit }} caractères'])
                ]
            ])
            ->add('mail', EmailType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Email([
                        'message' => "Le format de l'email n'est pas correct" // ✅ CORRECTION ICI
                    ])
                ]
            ])
            ->add('Soumettre', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
