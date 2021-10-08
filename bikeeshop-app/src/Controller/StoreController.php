<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 11/02/2019
 * Time: 21:07
 *
 * Gestion de la partie boutique du site.
 *
 * La pagination est créée en JS à partir de la librairie jPlist en transmettant le tableau de données entier.
 * J'ai utilisé cette méthode car c'était le moyen le plus rapide et le plus simple à mettre en place dans le temps imparti.
 * Je pense que le mieux serait de faire le système de pagination via l'API afin de retourner qu'une partie des articles et
 * donc avoir une économie de temps sur le chargement de la page et de ressource serveur. En utilisant par exemple
 * KnpPaginatorBundle qui semble compatible API ou alors utiliser ApiPlatform à la place de FOSRestBundle qui semble
 * intégrer un système de pagination (que je ne connaissais pas avant).
 *
 * https://medium.com/@mischenkoandrey/simple-restful-pagination-with-symfony-and-angularjs-9cb003cb38f
 * https://api-platform.com/docs/core/pagination/
 *
 * Néanmoins cette méthode permet pour l'utilisateur de ne pas avoir le rechargement de la page et nous pouvons ajouter un système
 * de trie en plus du système de pagination ainsi qu'un système pour choisir le nombre d'articles par page très rapidement en
 * ajoutant un paramètre sur le code HTML, grâce à la librairie.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ApiController;

class StoreController extends AbstractController
{
    /**
     * @Route("/store", name="store")
     */
    public function store(ApiController $api)
    {
        $articles = $api->getArticles();
        $categories = $api->getCategories();

        return $this->render('store.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/store/category/{idCategory}", name="store_category", methods={"GET"}, requirements={"idCategory"="\d+"})
     */
    public function storeByCategory(ApiController $api, int $idCategory)
    {
        $articles = $api->getArticleByCategory($idCategory);
        $categories = $api->getCategories();

        return $this->render('store.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/article/{idArticle}", name="article-details", methods={"GET"}, requirements={"idArticle"="\d+"})
     */
    public function article(ApiController $api, int $idArticle)
    {
        $article = $api->getArticleById($idArticle);

        return $this->render('article-details.html.twig', [
            'article' => $article,
        ]);
    }
}