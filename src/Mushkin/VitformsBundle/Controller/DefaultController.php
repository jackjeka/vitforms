<?php

namespace Mushkin\VitformsBundle\Controller;

use Mushkin\VitformsBundle\Entity\User;
use Mushkin\VitformsBundle\Form\Type\SkillType;
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

    public function AddSkillAction(Request $request)
    {
        $user = $this->getDoctrine()->getManager()
            ->getRepository('MushkinVitformsBundle:User')->findOneBy([]);

        $skill = new Skill();
        $form = $this->createForm(new SkillType($user), $skill);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user->addSkill($skill);
            $this->getDoctrine()->getManager()->persist($skill);
            $this->getDoctrine()->getManager()->persist($user);
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