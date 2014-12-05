<?php
namespace Mushkin\VitformsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $builder
        ->add('name')
         ->add('secondName')
         ->add('age')
/*        ->add('skills', null, array(
            'expanded' => "true",
            "multiple" => "true"))
 */
        ->add('skills', 'collection', array(
                'type' => new SkillType(),
                'allow_add'    => true,
                'prototype' => true,
                'by_reference' => false,
                'allow_delete' => true,
                ))
         ->add('save', 'submit', array('label' => 'Create'));

    }

    public function getName()
    {
        return 'user';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mushkin\VitformsBundle\Entity\User',
        ));
    }
}