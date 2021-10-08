<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 29/01/2019
 * Time: 17:50
 */
namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/*
 * Rappel : CRUD
 *
 * Créer (create) => POST = Ajoute une ressource
 * Afficher (read) => GET = Accède à une ressource
 * Mettre à jour (update) => PUT = Met à jour une ressource
 * complète en la remplaçant par une nouvelle version (99% des cas).
 * PATCH = Met à jour une partie d’une ressource en envoyant un différentiel
 * Supprimer (delete) => DELETE = Supprime une ressource
 *
 * https://blog.nicolashachet.com/niveaux/confirme/larchitecture-rest-expliquee-en-5-regles/
 * https://www.maxpou.fr/rest-crud
 */

class ArticleController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/articles")
     */
    public function getArticlesAction() : View
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $data = $repository->findAll();

        if(!$data){
            return new View(array("message"=>"Aucun article n'a été trouvé !"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/articles/{id}")
     */
    public function getArticleByIdAction(int $id) : View
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $data = $repository->findOneById($id);

        if(!$data){
            return new View(array("message"=>"Aucun article trouvé ! [id = $id]"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/articles/categories/{id}")
     */
    public function getArticleByCategoryAction(int $id) : View
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $data = $repository->findByCategory($id);

        if(!$data){
            return new View(array("message"=>"Aucun article trouvé dans la categorie definie ! [id = $id]"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/lastArticles/{maxResults}")
     */
    public function getLastArticlesAction(int $maxResults) : View
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $data = $repository->findBy([], ['id' => 'DESC'], $maxResults);

        if(!$data){
            return new View(array("message"=>"Aucun article n'a été trouvé !"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/articles")
     */
    public function postArticleAction(Request $request)
    {
        $article = new Article();

        $article->setName($request->request->get('name'));
        $article->setDescription($request->request->get('description'));
        $article->setVisual($request->request->get('visual'));
        $article->setPrice($request->request->get('price'));
        $article->setStock($request->request->get('stock'));

        $em = $this->getDoctrine()->getManager();
        $category = $em
            ->getRepository(Category::class)
            ->find($request->request->get('category_id'));

        $article->setCategory($category);

        $em->persist($article);
        $em->flush();

        return new View(["message" => "L'article a été ajouté !"], Response::HTTP_CREATED, []);
    }


    /**
     * @Rest\View()
     * @Rest\Delete("/articles/{id}")
     */
    public function deleteArticleAction(Article $article)
    {
        if($article !== null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

            return new View(['message' => "L'article a été supprimé !"], Response::HTTP_OK, []);
        }

        return new View(['message' => "L'article n'existe pas !"], Response::HTTP_NOT_FOUND, []);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/articles/{id}")
     */
    public function putArticleAction(Article $article, Request $request)
    {
        if($article !== null){
            $em = $this->getDoctrine()->getManager();
            $categorie = $em->getRepository(Category::class)->find($request->request->get('category_id'));

            $article->setName($request->request->get('name'))
                ->setDescription($request->request->get('description'))
                ->setVisual($request->request->get('visual'))
                ->setPrice($request->request->get('price'))
                ->setStock($request->request->get('stock'))
                ->setCategory($categorie);

            $em->merge($article);
            $em->flush();

            return new View(['message' => "L'article a été modifié !"], Response::HTTP_OK, []);
        }

        return new View(['message' => "L'article n'existe pas !"], Response::HTTP_NOT_FOUND, []);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/articles/{id}")
     */
    public function patchArticleStockAction(Article $article, Request $request)
    {
        if($article !== null){
            $em = $this->getDoctrine()->getManager();

            $article->setStock($request->request->get('stock'));

            $em->merge($article);
            $em->flush();

            return new View(['message' => "Le stock de l'article a été modifié !"], Response::HTTP_OK, []);
        }

        return new View(['message' => "L'article n'existe pas !"], Response::HTTP_NOT_FOUND, []);
    }
}