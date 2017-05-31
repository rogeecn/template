<?php
namespace console\controllers;


use console\base\ConsoleController;
use GuzzleHttp\Client;

class TestController extends ConsoleController
{
    public function actionIndex()
    {
        $options  = [];
        $client   = new Client($options);
        $uri      = "http://officejineng.com/api/article/create";
        $response = $client->post($uri, [
            'form_params' => [
                'title'       => 'test api post',
                'category_id' => '0',
                'index_show'  => '0',
                'type'        => '2',
                'tag'         => [
                    'tag' => 'aa,bb',
                ],
                'data'        => [
                    'description' => 'aa,bb',
                    'content'     => 'aa,bb',
                ],
            ],
        ]);

        print_r($response->getStatusCode());
        print_r((string)$response->getBody());
    }
}