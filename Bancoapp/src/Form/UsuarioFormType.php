<?php

namespace App\Form;

use App\Entity\Usuario;
use App\Entity\Moneda;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsuarioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre')
            ->add('DNI')
            ->add('telefono')
            ->add('CP')
            ->add('Moneda', EntityType::class, array(

                'class' => Moneda::class,

                'choice_label' => 'nombre',))

            ->add('save', SubmitType::class, array('label' => 'Enviar'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
