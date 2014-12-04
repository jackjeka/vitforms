<?php
namespace Mushkin\VitformsBundle\Form\Type;

use Mushkin\VitformsBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkillType extends AbstractType
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $builder
        ->add('Number')
        ->add('Description')
        ->add('SkillUsers', 'entity', [
            'mapped' => false,
            'disabled' => true,
            'data' => $this->user,
            'class' => 'Mushkin\VitformsBundle\Entity\User'
        ])
        ->add('Сохранить', 'submit');
    }

    public function getName()
    {
        return 'Skill';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mushkin\VitformsBundle\Entity\Skill',
        ));
    }
}