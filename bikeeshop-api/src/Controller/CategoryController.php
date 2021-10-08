<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 29/01/2019
 * Time: 17:49
 */

namespace App\Controller;


use App\Entity\Category;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/categories")
     */
    public function getCategoriesAction() : View
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $data = $repository->findAll();

        if(!$data){
            return new View(array("message"=>"Aucune categorie trouvée !"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/categories/{id}")
     */
    public function getCategoryByIdAction(int $id) : View
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $data = $repository->findOneById($id);

        if(!$data){
            return new View(array("message"=>"Aucune categorie trouvée ! [id = $id]"), Response::HTTP_NOT_FOUND, []);
        }

        return new View($data, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/categories")
     */
    public function postCategoryAction(Request $request)
    {
        $category = new Category();

        $category->setName($request->request->get('name'));
        $category->setDescription($request->request->get('description'));
        $category->setVisual($request->request->get('visual'));

        $em = $this->getDoctrine()->getManager();
        $em ->persist($category);
        $em->flush();

        return new View(["message" => "La catégorie a été ajoutée !"], Response::HTTP_CREATED, []);
    }


    /**
     * @Rest\View()
     * @Rest\Delete("/categories/{id}")
     */
    public function deleteCategoryAction(Category $category)
    {
        if($category !== null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();

            return new View(['message' => "La catégorie a été supprimée !"],
                Response::HTTP_OK);
        }

        return new View(['message' => "La catégorie n'existe pas !"],
            Response::HTTP_NOT_FOUND);

    }

    /**
     * @Rest\View()
     * @Rest\Put("/categories/{id}")
     */
    public function putCategoryAction(Category $category, Request $request)
    {
        if($category !== null){
            $em = $this->getDoctrine()->getManager();

            $category->setName($request->request->get('name'));
            $category->setDescription($request->request->get('description'));
            $category->setVisual($request->request->get('visual'));

            $em->merge($category);
            $em->flush();

            return new View(['message'=> "La catégorie a été modifiée !"],Response::HTTP_OK);
        }

        return new View(['message' => "La catégorie n'existe pas !"], Response::HTTP_NOT_FOUND);
    }
}