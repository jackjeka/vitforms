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
            ->add('number')
            ->add('description')
/*            ->add('skillUsers', 'collection', array(
                'type' => new UserType(),
            ))*/
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
        ));
    }
}