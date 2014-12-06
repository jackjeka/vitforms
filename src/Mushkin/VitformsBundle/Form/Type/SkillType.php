<?php
namespace Mushkin\VitformsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', null, array(
                'label' => 'Название нового умения: ',
                'attr' =>array(
                    'class'=>'form-control col-sm-4'
                ),
            ))
            ->add('description', null, array(
                'label' => 'Описание нового умения: ',
                'attr' =>array(
                    'class'=>'form-control col-sm-4'
                ),
            ))
        ;
    }

        public function getName()
    {
        return 'skill';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mushkin\VitformsBundle\Entity\Skill',
            'csrf_protection' => false,
        ));
    }
}