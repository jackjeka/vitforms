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
        $Skills = $this->getAllSkills();
        $form = $this->createForm(new UserType($Skills), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $skills2 = $form->get('Skills')->getData();
            foreach ($skills2 as $skill){
                $skill_obj = $this->getDoctrine()->getManager()
                    ->getRepository('MushkinVitformsBundle:Skill')->findOneById($Skills[$skill]);

                $skill_obj->addSkillUser($user);
                $this->getDoctrine()->getManager()->persist($skill_obj);
                $user->addSkill($skill_obj);
                $this->getDoctrine()->getManager()->persist($user);
            }

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
        $users = $this->getAllUsers();
        $form = $this->createForm(new SkillType($users), $skill);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $users2 = $form->get('SkillUser')->getData();
            foreach ($users2 as $user){
                $user_obj = $this->getDoctrine()->getManager()
                    ->getRepository('MushkinVitformsBundle:User')->findOneById($users[$user]);

                $user_obj->addSkill($skill);
                $this->getDoctrine()->getManager()->persist($user_obj);
                $skill->addSkillUser($user_obj);
                $this->getDoctrine()->getManager()->persist($skill);
            }

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