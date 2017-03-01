<?php

namespace BiciBikeBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OrderController extends FOSRestController
{

    /**
     * @Rest\Get("/")
     */
    public function createOrderAction(Request $request)
    {
        $data = ['hello' => 'world'];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;
    }
    /**
     * @Rest\Get("/users/{userId}")
     */
    public function bikeAction(Request $request)
    {
        $userId = $request->get('userId');
        $data = ['getUsersByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }
 
    /**
     * @Rest\Post("/users")
     */
    public function postUsersAction(Request $request)
    {
        $data = ['postUsersAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }
 
    /**
     * @Rest\Put("/users/{userId}")
     */
    public function putUsersByIdAction(Request $request)
    {
        $userId = $request->get('userId');
        $data = ['putUsersByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }
 
    /**
     * @Rest\Delete("/users/{userId}")
     */
    public function deleteUsersByIdAction(Request $request)
    {
        $userId = $request->get('userId');
        $data = ['deleteUsersByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }
}
