<?php
namespace Overlord\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('screenName', 'text', array(
            'max_length' => 100,
            'label' => 'Display name',
        ));
        $builder->add('email', 'email', array(
            'max_length' => 255,
            'label' => 'Email address',
        ));
        $builder->add('password', 'repeated', array(
           'max_length' => 10,
           'first_name' => 'password',
           'second_name' => 'confirm',
           'type' => 'password',
           'label' => 'Password',
           'second_options' => array(
            'label' => 'Confirm password',
           ),
        ));
    }

    public function getName()
    {
        return 'user';
    }
}