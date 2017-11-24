<?php namespace MS\GestionBibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdherentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//         $datePickerType = $this->container->get(DatePickerType::class);
        $builder
        ->add('nom', TextType::class, array('required' => false))
        ->add('prenom', TextType::class, array('required' => false))
        ->add('genre', TextType::class, array('required' => false))
//         ->add('dateNaissance', DatePickerType::class, array('required' => false))
        ->add('nbreEmpruntsAutorises', IntegerType::class, array('required' => false))
        ->add('nbreReservationsAutorisees', IntegerType::class, array('required' => false))
        ->add('email', EmailType::class, array('required' => false))
        ->add('numTelephone', TextType::class, array('required' => false))
        ->add('numCarte', TextType::class, array('required' => false))
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
    
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ms_gestionbibliothequebundle_adherent';
    }
    
    
}
