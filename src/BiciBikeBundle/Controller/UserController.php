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
        $brand = $request->get('brand');
        $image = $request->get('image');
        $price = $request->get('price');
        $stock = $request->get('stock');
        $description = $request->get('description');
        $categoryId = $request->get('category');
        $category = $this->getDoctrine()->getRepository('BiciBikeBundle:Category')
            ->findOneBy(array('id' => $categoryId));

        $user = new Bike();
        $user->setName($name)
            ->setBrand($brand)
            ->setImage($image)
            ->setPrice($price)
            ->setStock($stock)
            ->setDescription($description)
            ->setCategory($category);

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return $user;
    }

    /**
     * @Rest\Put("/users/{userId}")
     */
    public function updateBikeAction($userId, Request $request) {
        $user = $this->getDoctrine()->getRepository('BiciBikeBundle:User')
            ->find($userId);

        if ($request->get('name')) {$user->setName($request->get('name'));}
        if ($request->get('brand')) {$user->setBrand($request->get('brand'));}
        if ($request->get('image')) {$user->setImage($request->get('image'));}
        if ($request->get('price')) {$user->setPrice($request->get('price'));}
        if ($request->get('stock')) {$user->setStock($request->get('stock'));}
        if ($request->get('description')) {$user->setDescription($request->get('description') || $user->getDescription());}
        if ($request->get('category')) {
            $user->setCategory($this->getDoctrine()->getRepository('BiciBikeBundle:Category')
                ->findOneBy( array('id' => $request->get('category'))));
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return $user;
    }



    /**
     * @Rest\Get("/category/{catId}")
     */
    public function categoryAction($catId) {
        $cat = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:Category')
            ->find($catId);
        return $cat;
    }

    /**
     * @Rest\Get("/category")
     */
    public function getCategoriesAction() {
        $cats = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:Category')
            ->findAll();
        return $cats;
    }

    /**
     * @Rest\Post("/category")
     */
    public function createCategoryAction(Request $request) {
        $name = $request->get('name');

        $cat = new Category();
        $cat->setName($name);

        $em = $this->getDoctrine()->getManager();

        $em->persist($cat);
        $em->flush();
        return $cat;
    }

    /**
     * @Rest\Put("/category/{catId}")
     */
    public function updateCategoryAction($catId, Request $request) {
        $cat = $this->getDoctrine()->getRepository('BiciBikeBundle:Category')
            ->find($catId);

        if ($request->get('name')) {$cat->setName($request->get('name'));}
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($cat);
        $em->flush();
        return $cat;
    }

}
