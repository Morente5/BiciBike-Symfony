<?php

namespace BiciBikeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

use BiciBikeBundle\Entity\Order;
use BiciBikeBundle\Entity\OrderBike;


class OrderController extends FOSRestController {

    /**
     * @Rest\Get("/order/{orderId}")
     */
    public function orderAction($orderId) {
        $bike = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:Order')
            ->find($orderId);
        return $order;
    }

    /**
     * @Rest\Get("/order")
     */
    public function getOrdersAction() {
        $order = $this->getDoctrine()
            ->getRepository('BiciBikeBundle:Order')
            ->findAll();
        return $order;
    }

    /**
     * @Rest\Post("/order")
     */
    public function createOrderAction(Request $request) {

        $userId = $request->get('user');
        $user = $this->getDoctrine()->getRepository('BiciBikeBundle:User')
            ->findOneBy(array('id' => $userId));

        $order = new Order();
        $order->setUser($user);

        $em = $this->getDoctrine()->getManager();

        $em->persist($order);
        $em->flush();
        return $order;
    }



    /**
     * @Rest\Post("/orderline")
     */
    public function createOrderAction(Request $request) {

        $orderId = $request->get('order');
        $order = $this->getDoctrine()->getRepository('BiciBikeBundle:Order')
            ->findOneBy(array('id' => $orderId));
        $bikeId = $request->get('bike');
        $bike = $this->getDoctrine()->getRepository('BiciBikeBundle:Bike')
            ->findOneBy(array('id' => $bikeId));
        $quantity = $request->get('quantity');

        $orderline = new OrderBike();
        $orderline->setOrder($order);
        $orderline->setBike($bike);

        $em = $this->getDoctrine()->getManager();

        $em->persist($orderline);
        $em->flush();
        return $orderline;
    }

}
