<?php

namespace Mushkin\VitformsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mushkin\VitformsBundle\Entity\User;
use Mushkin\VitformsBundle\Entity\Skill;


class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $User = new User();
        $User
            ->setName('Вася')
            ->setsecondName('Васечкин')
            ->setage(30)
        ;
        $User2 = new User();
        $User2
            ->setName('петя')
            ->setsecondName('Петечкин')
            ->setage(30)
        ;

        $Skill = new Skill();
        $Skill
            ->setNumber('Умение №1')
            ->setDescription('Капать');

        $Skill->addskillUser($User);
        $manager->persist($Skill);

        $Skill->addskillUser($User2);
        $manager->persist($Skill);

        $User->addskill($Skill);
        $User2->addskill($Skill);

        $manager->persist($User);
        $manager->persist($User2);

        $Skill2 = new Skill();
        $Skill2
            ->setNumber('Умение №2')
            ->setDescription('Писать');
        $Skill2->addskillUser($User);
        $User->addskill($Skill2);
        $manager->persist($Skill2);
        $manager->persist($User);

        $manager->flush();
    }
}
