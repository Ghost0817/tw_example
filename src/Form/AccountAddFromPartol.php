<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AccountAddFromPartol extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'User Name*:',
                'required'    => true,
                'constraints' => array(
                   new NotBlank(),
                   new Length(array('min' => 3,'max' => 60)),
                ),
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Password*:',
                'required'    => true,
                'constraints' => array(
                   new NotBlank(),
                   new Length(array('min' => 3,'max' => 60)),
                ),
            ))
            ->add('grade', EntityType::class,array(
                'label'=>'Add to Class*:',
                'class' => 'App:Grade',
                'required'    => false,
                'placeholder' => 'Ungrouped Students',
                'empty_data'  => null,
            ))
            ->add('save', SubmitType::class, array(
                'label'=>'Add Student Account',
                'attr' => array('class' => 'btn btn-defualt'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Form\Model\AddAccountFromPartol',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'intention'       => 'task_item',
        ));
    }
}
