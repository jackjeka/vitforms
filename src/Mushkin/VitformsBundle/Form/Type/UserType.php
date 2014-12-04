<?php
namespace Mushkin\VitformsBundle\Form\Type;

use Mushkin\VitformsBundle\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;

class UserType extends AbstractType
{
    protected $skills;

    public function __construct(Array $skills)
    {
        $this->skills = $skills;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $builder
        ->add('name')
         ->add('secondName')
         ->add('age')

/*        ->add('SkillUsers', 'entity', [
            'mapped' => false,
            'disabled' => true,
            'data' => $this->users,
            'class' => 'Mushkin\VitformsBundle\Entity\User'
        ])
*/
        ->add('Skills', 'choice', [
                'mapped' => false,
                'choices'=> $this->skills,
                'expanded' => true,
                'multiple' => true,
            ])
        ->add('Сохранить', 'submit');
    }

    public function getName()
    {
        return 'User';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mushkin\VitformsBundle\Entity\User',
        ));
    }
}