<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 29/01/2019
 * Time: 17:51
 */

namespace App\Controller;


use App\Entity\Client;
use App\Entity\Orders;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OrderController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/orders")
     */
    public function getOrdersAction() : View
    {
        $repository = $this->getDoctrine()->getRepository(Orders::class);
        $data = $repository->findAll();

        if(!$data){
            return new View(array("message"=>"Aucune commande n'a été trouvée !"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/orders/{id}")
     */
    public function getOrderByIdAction(int $id) : View
    {
        $repository = $this->getDoctrine()->getRepository(Orders::class);
        $data = $repository->findOneById($id);

        if(!$data){
            return new View(array("message"=>"Aucune commande trouvée ! [id = $id]"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/orders")
     */
    public function postOrderAction(Request $request)
    {
        $order = new Orders();

        $em = $this->getDoctrine()->getManager();
        $client = $em
            ->getRepository(Client::class)
            ->find($request->request->get('client_id'));

        $order->setClient($client);

        $em->persist($order);
        $em->flush();

        return new View(['message'=> 'La commande a été ajoutée !', 'id'=>$order->getId()], Response::HTTP_CREATED);
    }
}