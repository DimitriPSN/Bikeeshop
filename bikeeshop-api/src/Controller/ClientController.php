<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 22/02/2019
 * Time: 00:04
 */

namespace App\Controller;

use App\Entity\Client;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/clients")
     */
    public function getClientsAction() : View
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $data = $repository->findAll();

        if(!$data){
            return new View(array("message"=>"Aucun client n'a été trouvé !"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/clients/{id}", requirements={"id" = "\d+"})
     */
    public function getClientByIdAction(int $id) : View
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $data = $repository->findOneById($id);

        if(!$data){
            return new View(array("message"=>"Aucun client trouvé ! [id = $id]"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/clients/{email}")
     */
    public function getClientByEmailAction(string $email) : View
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $data = $repository->findOneByEmail($email);

        if(!$data){
            return new View(array("message"=>"Aucun client trouvé ! [email = $email]"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/clients")
     */
    public function postClientAction(Request $request)
    {
        $client = new Client();

        $client->setLastname($request->request->get('lastname'));
        $client->setFirstname($request->request->get('firstname'));
        $client->setPassword($request->request->get('password'));
        $client->setAddress($request->request->get('address'));
        $client->setZipcode($request->request->get('zipcode'));
        $client->setCity($request->request->get('city'));
        $client->setEmail($request->request->get('email'));
        $client->setPhone($request->request->get('phone'));

        $em = $this->getDoctrine()->getManager();
        $em ->persist($client);
        $em->flush();

        return new View(["message" => "Le client a été créé !"], Response::HTTP_CREATED, []);
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/clients/{id}")
     */
    public function deleteClientAction(Client $client)
    {
        if($client !== null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();

            return new View(['message' => "Le client a été supprimé !"], Response::HTTP_OK, []);
        }

        return new View(['message' => "Le client n'existe pas !"], Response::HTTP_NOT_FOUND, []);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/clients/{id}")
     */
    public function putClientAction(Client $client, Request $request)
    {
        if($client !== null){

            $client->setLastname($request->request->get('lastname'))
                ->setFirstname($request->request->get('firstname'))
                ->setPassword($request->request->get('password'))
                ->setAddress($request->request->get('address'))
                ->setZipcode($request->request->get('zipcode'))
                ->setCity($request->request->get('city'))
                ->setEmail($request->request->get('email'))
                ->setPhone($request->request->get('phone'));

            $em = $this->getDoctrine()->getManager();
            $em->merge($client);
            $em->flush();

            return new View(['message' => "Le client a été modifié !"], Response::HTTP_OK, []);
        }

        return new View(['message' => "Le client n'existe pas !"], Response::HTTP_NOT_FOUND, []);
    }
}