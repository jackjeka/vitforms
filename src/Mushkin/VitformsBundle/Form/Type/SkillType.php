<?php
namespace Mushkin\VitformsBundle\Form\Type;

use Mushkin\VitformsBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;

class SkillType extends AbstractType
{
    protected $users;

    public function __construct(Array $users)
    {
        $this->users = $users;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $builder
        ->add('Number')
        ->add('Description')
/*        ->add('SkillUsers', 'entity', [
            'mapped' => false,
            'disabled' => true,
            'data' => $this->users,
            'class' => 'Mushkin\VitformsBundle\Entity\User'
        ])
*/
        ->add('SkillUser', 'choice', [
                'mapped' => false,
                'choices'=> $this->users,
                'expanded' => true,
                'multiple' => true,
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