<?php namespace MS\GestionBibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class DatePickerType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $dateOptions = $builder->get('date')->getOptions();
        
        //permettre la surchage des options
        array_merge($options, $dateOptions);
        
        $builder->remove('date')
        ->add('date', 'datePicker', $dateOptions);
    }
    
    
    public function setDefaultOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'date_widget' => 'single_text'
        ));
    }
    public function getParent() {
        return 'datetime';
    }
    
    public function getName() {
        return 'datePicker';
    }
}