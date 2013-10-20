<?php
namespace Overlord\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CompanyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'max_length' => 100,
            'label' => 'Company Name',
        ));
        $builder->add('email', 'email', array(
            'max_length' => 255,
            'label' => 'Email address',
        ));
    }

    public function getName()
    {
        return 'company';
    }
}