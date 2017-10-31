<?php

namespace MS\GestionBibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdherentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('_nom')->add('_prenom')->add('_genre')->add('_dateNaissance')->add('_nbreEmpruntsAuthorises')->add('_email')->add('_numTelephone')->add('_carteBibliotheque');
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

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ms_gestionbibliothequebundle_adherent';
    }


}
