<?php

namespace BiciBikeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

use BiciBikeBundle\Entity\User;

class UserController extends FOSRestController {

    /**
     * @Rest\Get("/users/{userId}")
     */
    public function userAction($userId) {
        $user = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:User')
            ->find($userId);
        return $user;
    }

    /**
     * @Rest\Get("/users")
     */
    public function getUsersAction() {
        $users = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:User')
            ->findAll();
        return $users;
    }

    /**
     * @Rest\Post("/users")
     */
    public function createUserAction(Request $request) {
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $password = $request->get('password');

        $user = new User();
        $user->setName($name)
            ->setEmail($email)
            ->setPhone($phone)
            ->setPassword($password);

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return $user;
    }

    /**
     * @Rest\Put("/users/{userId}")
     */
    public function updateUserAction($userId, Request $request) {
        $user = $this->getDoctrine()->getRepository('BiciBikeBundle:User')
            ->find($userId);

        if ($request->get('name')) {$user->setName($request->get('name'));}
        if ($request->get('email')) {$user->setEmail($request->get('email'));}
        if ($request->get('phone')) {$user->setPhone($request->get('phone'));}
        if ($request->get('password')) {$user->setPassword($request->get('password'));}

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return $user;
    }

}
