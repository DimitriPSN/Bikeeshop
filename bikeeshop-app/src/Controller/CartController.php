<?php
/**
 *
 * User: Dimitri
 * Date: 16/02/2019
 * Time: 17:49
 *
 * Gestion du panier. Indépendant de l'API.
 * Nous stockons les données en SESSION pour que le panier soit accessible sans compte utilisateur.
 * Une fois la validation du Panier, on pourrait alors utiliser "Order" & "LineOrder" qui serait
 * la commande d'un utilisateur X.
 *
 * On pourrait utiliser les COOKIES en plus des SESSIONS pour que le panier reste en mémoire
 * après la fermeture du navigateur, si l'utilisateur n'a pas valider son panier et revient plus tard.
 *
 * Ici, on utilise une SESSION qui s'appelle CART.
 * L'index = identifiant de l'article et elle contient la quantié voulue
 * cart[50] = 10  ===> Produit 50 et quantité 10
 */

namespace App\Controller;

use App\Entity\Client;
use App\Form\EditType;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ApiController;

class CartController extends AbstractController
{
    CONST TVA = "1.20";

    /**
     * Affichage du panier
     * @Route("/cart", name="cart")
     */
    public function cart(Request $request, ApiController $api)
    {
        $session = $request->getSession();

        if ($session->has('cart') && $session->get('cart') != []) {
            $idsArticle = array_keys($session->get('cart'));
            foreach ($idsArticle as $idArticle) {
                $articles[] = $api->getArticleById($idArticle);
            }

            return $this->render('cart.html.twig', [
                'articles' => $articles,
                'qte' => $session->get('cart'),
                'tva' => self::TVA,
            ]);
        }

        return $this->render('cart.html.twig', [
            'articles' => $articles = null,
            'qte' => null,
            'tva' => self::TVA,
        ]);
    }

    /**
     * Ajout un article dans le panier
     * @Route("/cart/add/{idArticle}", name="cart_add")
     */
    public function addCart(Request $request, int $idArticle)
    {
        $session = $request->getSession();

        if (!$session->has('cart')) {
            $session->set('cart', []);
        }

        $cart = $session->get('cart');
        if (array_key_exists($idArticle, $cart)) {
            $cart[$idArticle] += (int)$request->query->get('qty');
        } else {
            $cart[$idArticle] = (int)$request->query->get('qty');
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    /**
     * Modifie la quantité d'un article dans le panier
     * @Route("/cart/update/{idArticle}", name="cart_update")
     */
    public function updateCart(Request $request, int $idArticle)
    {
        $session = $request->getSession();

        if (!$session->has('cart')) {
            $session->set('cart', []);
        }

        $cart = $session->get('cart');
        if (array_key_exists($idArticle, $cart)) {
            $cart[$idArticle] = (int)$request->query->get('qty' . $idArticle);
        } else {
            $cart[$idArticle] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    /**
     * Supprime un article dans le panier
     * @Route("/cart/delete/{idArticle}", name="cart_delete")
     */
    public function deleteCart(Request $request, int $idArticle)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');

        if (array_key_exists($idArticle, $cart)) {
            unset($cart[$idArticle]);
            $session->set('cart', $cart);
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * Récapitulatif du panier
     * @Route("/cart/summary", name="cart_summary")
     */
    public function summaryCart(Request $request, ApiController $api)
    {
        $session = $request->getSession();

        if (!$session->has('client')) {
            $this->addFlash('warning', 'Vous devez être connecté pour procéder au paiement de votre panier !');
            return $this->redirectToRoute('login');
        }

        if ($session->has('cart') && $session->get('cart') != []) {
            $idsArticle = array_keys($session->get('cart'));
            foreach ($idsArticle as $idArticle) {
                $articles[] = $api->getArticleById($idArticle);
            }

            return $this->render('cart_summary.html.twig', [
                'client' => $session->get('client'),
                'articles' => $articles,
                'qte' => $session->get('cart'),
                'tva' => self::TVA,
            ]);
        }

        return $this->render('cart.html.twig', [
            'articles' => $articles = null,
            'qte' => null,
            'tva' => self::TVA,
        ]);
    }

    /**
     * Permet de modifier les informations du client (téléphone, adresse, code postal, ville)
     * @Route("/cart/summary/edit", name="cart_edit")
     */
    public function editCart(Request $request, ApiController $api)
    {
        $client = new Client();

        $session = $request->getSession();
        $current = $session->get("client");

        $form = $this->createForm(EditType::class, $client);
        $form->handleRequest($request);

        if ($session->has('client')){
            if ($form->isSubmitted()) {
                $data = $form->getData();

                $session->set('client', [
                    'id' => $current['id'],
                    'lastname' => $current['lastname'],
                    'firstname' => $current['firstname'],
                    'password' => $current['password'],
                    'address' => $data->address,
                    'zipcode' => $data->zipcode,
                    'city' => $data->city,
                    'email' => $current['email'],
                    'phone' => $data->phone,
                ]);

                try {
                    $api->putClient($session->get("client"));
                    $this->addFlash('success', 'Modification réussie !');
                } catch (ClientException $e){
                    $response = $e->getResponse();
                    $statusCode = $response->getStatusCode();
                    if ($statusCode == '404') {
                        $api->postClient($data);
                        $this->addFlash('danger', 'Une erreur a été rencontrée : le client n\'existe !');
                    } else {
                        throw $e;
                    }
                }

                return $this->redirectToRoute('cart_summary');
            }

            return $this->render("cart_edit.html.twig", [
                'form' => $form->createView(),
                'client' => $current,
            ]);
        }

        $this->addFlash('danger', 'Vous devez être connecté(e) pour modifier vos informations !');
        return $this->redirectToRoute('homepage');
    }

    /**
     * Confirmation du panier
     * @Route("/cart/confirm", name="cart_confirm")
     */
    public function confirmCart(Request $request, ApiController $api)
    {
        $session = $request->getSession();
        $client = $session->get("client");

        if ($session->has('cart') && $session->get('cart') != []) {
            $idsArticle = array_keys($session->get('cart'));
            $qte = $session->get('cart');

            foreach ($idsArticle as $idArticle) {
                $articles[] = $api->getArticleById($idArticle);
            }

            try{
                $order = $api->postOrderAction($client['id']);
                $err = false;
                foreach($articles as $article) {
                    if($article['stock'] >= $qte[$article['id']]){
                        $newStock = $article['stock']-$qte[$article['id']];

                        $api->postLineOrderAction($order['id'], $article['id'], $qte[$article['id']]);
                        $api->patchStock($article['id'], $newStock);
                    }
                    else {
                        $err = true;
                        $this->addFlash("danger", "Il n'y a pu assez de stock pour l'article n°".$article['id']." - ".$article['name']." (stock : ".$article['stock'].")");
                    }
                }

                if(!$err) {
                    $this->addFlash("success", "Votre commande a bien été passée !");
                }
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                if ($statusCode == '500') {
                    $this->addFlash("danger', 'Désolé, une erreur serveur s'est produite !");
                } else {
                    throw $e;
                }
            }

            return $this->render('cart.html.twig', [
                'articles' => $articles,
                'qte' => $session->get('cart'),
                'tva' => self::TVA,
            ]);
        }

        return $this->render('cart.html.twig', [
            'articles' => $articles = null,
            'qte' => null,
            'tva' => self::TVA,
        ]);
    }
}