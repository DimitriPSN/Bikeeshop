<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 11/02/2019
 * Time: 00:52
 *
 * Gestion des appels vers l'API
 */

namespace App\Controller;

use GuzzleHttp\Client;

CONST API_URL = "http://127.0.0.1:8000/";

class ApiController
{
    /**
     * PARTIE : Article
     **/

    public function getArticles()
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'articles');

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getArticleById(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'articles/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getArticleByCategory(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'articles/categories/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getLastArticles(int $maxResults)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'lastArticles/'.$maxResults);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function postArticleAction($data)
    {
        $clientApi = new Client();
        $response = $clientApi->post(API_URL.'articles', array(
            'form_params' => array(
                'name' => $data->name,
                'description' => $data->description,
                'visual' => $data->visual,
                'price' => $data->price,
                'stock' =>  $data->stock,
            )
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }

    public function patchStock(int $id, int $stock)
    {
        $clientApi = new Client();
        $response = $clientApi->patch(API_URL.'articles/'.$id, array(
            'form_params' => array(
                'stock' =>  $stock,
            )
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }

    /**
     * PARTIE : Category
     **/

    public function getCategories()
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'categories');

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getCategoryById(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'categories/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    /**
     * PARTIE : LineOrder
     **/

    public function getLinesOrder()
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'linesOrder');

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getLinesOrderById(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'linesOrder/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function postLineOrderAction($orderId, $articleId, $qty)
    {
        $clientApi = new Client();
        $response = $clientApi->post(API_URL.'linesOrder', array(
            'form_params' => array(
                'order_id' => $orderId,
                'article_id' => $articleId,
                'quantity' => $qty,
            )
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }

    public function deleteLineOrder(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->delete(API_URL.'linesOrder/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function putLineOrder($data)
    {
        $clientApi = new Client();
        $response = $clientApi->put(API_URL.'linesOrder', array(
            'json' => array(
                'order_id' => $data->order_id,
                'article_id' => $data->article_id,
                'quantity' => $data->quantity,
            )
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }

    /**
     * PARTIE : Order
     **/

    public function getOrders()
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'orders');

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getOrdersById(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'orders/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function postOrderAction($clientId)
    {
        $clientApi = new Client();
        $response = $clientApi->post(API_URL.'orders', array(
            'form_params' => array(
                'client_id' => $clientId,
            )
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }

    /**
     * PARTIE : Client
     */

    public function getClientById(int $id)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'clients/'.$id);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function getClientByEmail(string $email)
    {
        $clientApi = new Client();
        $response = $clientApi->get(API_URL.'clients/'.$email);

        $response = (string)$response->getBody();
        $data = json_decode($response, true);

        return $data;
    }

    public function postClient($data)
    {
        $clientApi = new Client();
        $response = $clientApi->post(API_URL.'clients', array(
            'form_params' => array(
                'lastname' => $data->lastname,
                'firstname' => $data->firstname,
                'password' => $data->password,
                'address' => $data->address,
                'zipcode' =>  $data->zipcode,
                'city' => $data->city,
                'email' => $data->email,
                'phone' => $data->phone,
            ),
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }

    public function putClient($data)
    {
        $clientApi = new Client();
        $response = $clientApi->put(API_URL.'clients/'.$data['id'], array(
            'form_params' => array(
                'lastname' => $data['lastname'],
                'firstname' => $data['firstname'],
                'password' => $data['password'],
                'address' => $data['address'],
                'zipcode' =>  $data['zipcode'],
                'city' => $data['city'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ),
        ));

        $response = (string)$response->getBody();
        return json_decode($response, true);
    }
}