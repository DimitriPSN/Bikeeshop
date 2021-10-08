<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 10/02/2019
 * Time: 20:38
 *
 * Partie Home : affichage de la page d'accueil
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ApiController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homePage(ApiController $api)
    {
        $lastArticles = $api->getLastArticles(8);
        $categories = $api->getCategories();

        return $this->render('home.html.twig', [
            'lastArticles' => $lastArticles,
            'categories' => $categories,
        ]);
    }
}