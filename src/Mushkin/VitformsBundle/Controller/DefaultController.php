<?php

namespace Mushkin\VitformsBundle\Controller;

use Mushkin\VitformsBundle\Entity\User;
use Mushkin\VitformsBundle\Form\Type\SkillType;
use Mushkin\VitformsBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mushkin\VitformsBundle\Entity\Skill;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('MushkinVitformsBundle:Default:index.html.twig',
            ['Users' => $this->getAllUsers(),'Skills' => $this->getAllSkills()]);
    }

    public function AddUserAction(Request $request)
    {
        $user = new user();
        $skill = $this->getDoctrine()->getManager()->getRepository('MushkinVitformsBundle:Skill')
                ->find('1');
        $user->addSkill($skill);
        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('mushkin_vitforms_homepage'));
        }

        return $this->render('MushkinVitformsBundle:Default:AddUser.html.twig',
            [
                'Users' => $this->getAllUsers(),
                'Skills' => $this->getAllSkills(),
                'form' => $form->createView(),
            ]);
    }

    public function AddSkillAction(Request $request)
    {
        $skill = new Skill();
        $user = $this->getDoctrine()->getManager()
            ->getRepository('MushkinVitformsBundle:User')->findOneById('1');
        $skill->addSkillUser($user);

        $form = $this->createForm(new SkillType(), $skill);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($skill);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('mushkin_vitforms_homepage'));
    }

        return $this->render('MushkinVitformsBundle:Default:AddSkill.html.twig',
            [
                'Users' => $this->getAllUsers(),
                'Skills' => $this->getAllSkills(),
                'form' => $form->createView(),
            ]);
    }

    public function getAllUsers()
    {
        $Users = $this->getDoctrine()->getManager()
            ->getRepository('MushkinVitformsBundle:User')->findAll();

        return $Users;
    }

    public function getAllSkills()
    {
        $Skills = $this->getDoctrine()->getManager()
            ->getRepository('MushkinVitformsBundle:Skill')->findAll();

        return $Skills;
    }
}