<?php

namespace App\Form;

class VoteType
{
    public function buildForm(FormBuilderInterface $builder,
                              array                $options): void
    {
        $builder
            ->add('noteVote', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5],
                'multiple' => false,
                'expanded' => true
            ])
            ->add('joueur', EntityType::class, [
                'class' => Joueur::class,
                'choice_label' => 'nom']
            )
            ->add('vote',SubmitType::class)
        ;
    }
}