<?php namespace MS\GestionBibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use SC\DatetimepickerBundle\Form\Type\DatetimeType;

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
        ->add('dateNaissance', DateType::class, array(
            'widget' => 'single_text',
            'html5' => true,
            'required' => false,
            'attr'   =>  array('class' => 'acmeDatePicker')
        ))
//         ->add('dateNaissance', 'date', array(
//             'picker' => true,
//             'format' => 'dd.MM.yyyy'
//         ))
//         ->add('dateNaissance', DatetimeType::class, array( 'pickerOptions' =>
//             array('format' => 'mm/dd/yyyy',
//                 'weekStart' => 0,
//                 'startDate' => date('m/d/Y'), //example
//                 'endDate' => '01/01/3000', //example
//                 'daysOfWeekDisabled' => '0,6', //example
//                 'autoclose' => false,
//                 'startView' => 'month',
//                 'minView' => 'hour',
//                 'maxView' => 'decade',
//                 'todayBtn' => false,
//                 'todayHighlight' => false,
//                 'keyboardNavigation' => true,
//                 'language' => 'en',
//                 'forceParse' => true,
//                 'minuteStep' => 5,
//                 'pickerReferer ' => 'default', //deprecated
//                 'pickerPosition' => 'bottom-right',
//                 'viewSelect' => 'hour',
//                 'showMeridian' => false,
//                 'initialDate' => date('m/d/Y', 1577836800), //example
//             )))
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
