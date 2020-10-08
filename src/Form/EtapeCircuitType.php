<?php

namespace App\Form;

use App\Entity\EtapeCircuit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtapeCircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('durée_étape')
            ->add('ordre_étape')
            ->add('ville_etape')
            ->add('circuit_étape')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtapeCircuit::class,
        ]);
    }
}
