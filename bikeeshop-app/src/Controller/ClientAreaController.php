<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 22/02/2019
 * Time: 19:37
 *
 * Partie Espace Membre : Inscription, Connexion, Deconnexion
 */

namespace App\Controller;

use App\Entity\Client;
use App\Form\LoginType;
use App\Form\RegisterType;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ApiController;

class ClientAreaController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, ApiController $api)
    {
        $client = new Client();

        $form = $this->createForm(RegisterType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            try {
                $api->getClientByEmail($data->getEmail());
                $this->addFlash('warning', 'Désolé, un compte est déjà existant avec cette adresse e-mail !');
            } catch (ClientException $e){
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                if ($statusCode == '404') {
                    $api->postClient($data);
                    $this->addFlash('success', 'Votre compte a bien été créé !');
                } else {
                    throw $e;
                }
            }
        }

        return $this->render('register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, ApiController $api)
    {
        $session = $request->getSession();
        $client = new Client();

        $form = $this->createForm(LoginType::class, $client);
        $form->handleRequest($request);

        if(!$session->has('client')) {
            if ($form->isSubmitted()) {
                $data = $form->getData();
                try {
                    $client = $api->getClientByEmail($data->getEmail());
                    if ($client['password'] == $data->getPassword()) {
                        $this->addFlash('success', 'Connexion réussie !');
                        $session->set('client', [
                            'id' => $client['id'],
                            'lastname' => $client['lastname'],
                            'firstname' => $client['firstname'],
                            'password' => $client['password'],
                            'address' => $client['address'],
                            'zipcode' => $client['zipcode'],
                            'city' => $client['city'],
                            'email' => $client['email'],
                            'phone' => $client['phone'],
                        ]);
                        return $this->redirectToRoute('homepage');
                    } else {
                        $this->addFlash('danger', 'Le mot de passe est incorrect !');
                    }
                } catch (ClientException $e) {
                    $response = $e->getResponse();
                    $statusCode = $response->getStatusCode();
                    if ($statusCode == '404') {
                        $this->addFlash('danger', 'Désolé, aucun compte n\'a été trouvé avec cette adresse e-mail !');
                    } else {
                        throw $e;
                    }
                }
            }
        } else {
            $this->addFlash('danger', 'Vous êtes déjà connecté(e) !');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
        $session = $request->getSession();
        if($session->has('client')) {
            $session->remove('client');
            $this->addFlash('success', 'Déconnexion réussie !');
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('homepage');
    }
}