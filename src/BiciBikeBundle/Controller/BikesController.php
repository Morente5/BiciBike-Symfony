<?php

namespace BiciBikeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

use BiciBikeBundle\Entity\Bike;
use BiciBikeBundle\Entity\Category;


class BikesController extends FOSRestController {

    /**
     * @Rest\Get("/bikes/{bikeId}")
     */
    public function bikeAction($bikeId) {
        $bike = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:Bike')
            ->find($bikeId);
        return $bike;
    }

    /**
     * @Rest\Get("/bikes")
     */
    public function getBikesAction() {
        $bikes = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:Bike')
            ->findAll();
        return $bikes;
    }

    /**
     * @Rest\Post("/bikes")
     */
    public function createBikeAction(Request $request) {
        $name = $request->get('name');
        $brand = $request->get('brand');
        $image = $request->get('image');
        $price = $request->get('price');
        $stock = $request->get('stock');
        $description = $request->get('description');
        $categoryId = $request->get('category');
        $category = $this->getDoctrine()->getRepository('BiciBikeBundle:Category')
            ->findOneBy(array('id' => $categoryId));

        $bike = new Bike();
        $bike->setName($name)
            ->setBrand($brand)
            ->setImage($image)
            ->setPrice($price)
            ->setStock($stock)
            ->setDescription($description)
            ->setCategory($category);

        $em = $this->getDoctrine()->getManager();

        $em->persist($bike);
        $em->flush();
        return $bike;
    }

    /**
     * @Rest\Put("/bikes/{bikeId}")
     */
    public function updateBikeAction($bikeId, Request $request) {
        $bike = $this->getDoctrine()->getRepository('BiciBikeBundle:Bike')
            ->find($bikeId);

        if ($request->get('name')) {$bike->setName($request->get('name'));}
        if ($request->get('brand')) {$bike->setBrand($request->get('brand'));}
        if ($request->get('image')) {$bike->setImage($request->get('image'));}
        if ($request->get('price')) {$bike->setPrice($request->get('price'));}
        if ($request->get('stock')) {$bike->setStock($request->get('stock'));}
        if ($request->get('description')) {$bike->setDescription($request->get('description') || $bike->getDescription());}
        if ($request->get('category')) {
            $bike->setCategory($this->getDoctrine()->getRepository('BiciBikeBundle:Category')
                ->findOneBy( array('id' => $request->get('category'))));
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($bike);
        $em->flush();
        return $bike;
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
