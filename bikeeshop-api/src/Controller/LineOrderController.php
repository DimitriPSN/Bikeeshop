<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 29/01/2019
 * Time: 17:51
 */

namespace App\Controller;


use App\Entity\Article;
use App\Entity\LineOrder;
use App\Entity\Orders;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LineOrderController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/linesOrder")
     */
    public function getLinesOrderAction()
    {
        $em = $this->getDoctrine()->getManager();

        $linesOrder = $em->getRepository(LineOrder::class)->findAll();

        if ($linesOrder == null){
            return new View(['message'=> 'Aucune ligne de commande trouvée !'], Response::HTTP_NOT_FOUND);
        }

        return new View($linesOrder, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Get("linesOrder/{id}")
     */
    public function getLineOrderAction(LineOrder $lineOrder)
    {
        if ($lineOrder == null){
            return new View(['message'=> 'Ligne de commande non trouvée !'], Response::HTTP_NOT_FOUND);
        }

        return new View($lineOrder, Response::HTTP_OK, []);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/linesOrder")
     */
    public function postLineOrderAction(Request $request)
    {
        $lineOrder = new LineOrder();

        $em = $this->getDoctrine()->getManager();

        $order = $em
            ->getRepository(Orders::class)
            ->find($request->request->get('order_id'));
        $lineOrder->setOrder($order);

        $article = $em
            ->getRepository(Article::class)
            ->find($request->request->get('article_id'));
        $lineOrder->setArticle($article);

        $lineOrder->setQuantity($request->request->get('quantity'));

        $em ->persist($lineOrder);
        $em->flush();

        return new View(['message'=>'La ligne de commande a été ajoutée !', 'id'=>$lineOrder->getId()], Response::HTTP_CREATED);
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/linesOrder/{id}")
     */
    public function deleteLineOrderAction(LineOrder $lineOrder)
    {
        if($lineOrder == null){
            return new View(['message' => "Cette ligne de commande n'existe pas !"], Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($lineOrder);
        $em->flush();

        return new View(['message'=> "La ligne de commande a été supprimée !"], Response::HTTP_OK);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/linesOrder/{id}")
     */
    public function putLineOrderAction(LineOrder $lineOrder, Request $request)
    {
        if($lineOrder == null){
            return new View(['message'=> "La ligne ne commande n'existe pas !"],Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $order = $em
            ->getRepository(Orders::class)
            ->find($request->request->get('order_id'));
        $lineOrder->setOrder($order);

        $article = $em
            ->getRepository(Article::class)
            ->find($request->request->get('article_id'));
        $lineOrder->setArticle($article);

        $lineOrder->setQuantity($request->request->get('quantity'));

        $em->merge($lineOrder);
        $em->flush();

        return new View(['message'=>'La ligne de commande a été modifiée !'], Response::HTTP_OK);
    }
}