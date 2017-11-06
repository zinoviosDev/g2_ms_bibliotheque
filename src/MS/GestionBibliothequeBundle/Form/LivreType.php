<?php
namespace MS\GestionBibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LivreType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('titre', TextType::class, array('required' => false))
        ->add('isbn', TextType::class, array('required' => false))
        ->add('auteur', AuteurType::class, array('required' => false))
            ->add('Rechercher', SubmitType::class   )
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MS\GestionBibliothequeBundle\Entity\Livre'
        ));
    }
}

