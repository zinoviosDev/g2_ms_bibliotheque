<?php namespace MS\GestionBibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdherentSearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//             ->remove('dateNaissance')
            ->add('Rechercher', SubmitType::class, array(
                'attr' => array('class' => 'left')))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MS\GestionBibliothequeBundle\Entity\Adherent'
        ));
    }

    public function getParent() {
        return AdherentType::class;
    }
}
