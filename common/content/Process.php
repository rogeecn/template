<?php
namespace common\content;


use common\content\processors\CnBlogs;
use GuzzleHttp\Client;
use Monolog\Logger;
use yii\base\Exception;

class Process
{
    /** @var  IProcessor */
    private $processor;
    private $url;
    private $categoryID;

    /** @var  Logger */
    private static $_logger;

    public function __construct($url, $categoryID = 0)
    {
        $this->url        = $url;
        $this->categoryID = $categoryID;

        $host            = parse_url($url, PHP_URL_HOST);
        $this->processor = $this->getProcessor($host);

        self::$_logger = \common\util\Logger::instance("process");
    }

    private function getHtmlData()
    {
        $client   = new Client();
        $response = $client->get($this->url);
        if ($response->getStatusCode() != 200) {
            throw new Exception("http status code is " . $response->getStatusCode());
        }

        return $response->getBody();
    }

    /**
     *
     * $dataTpl = [
     * 'type'        => 2,
     * 'title'       => '',
     * 'index_show'  => '0',
     * 'source_url'  => [
     * 'source_url' => '',
     * ],
     * 'tag'         => [
     * 'tag' => '',
     * ],
     * 'category_id' => '90',
     * 'data'        => [
     * 'content'     => '',
     * 'description' => '',
     * ],
     * ];
     */
    public function publish()
    {
        $htmlData    = $this->getHtmlData();
        $processData = call_user_func_array([new $this->processor(), 'getPublishData'], [$htmlData]);

        $data = [
            'type'        => 2,
            'title'       => $processData['title'],
            'index_show'  => '0',
            'source_url'  => [
                'source_url' => $this->url,
            ],
            'tag'         => [
                'tag' => '',
            ],
            'category_id' => $this->categoryID,
            'data'        => [
                'content'     => $processData['content'],
                'description' => $processData['description'],
            ],
        ];

        // do publish
        $options = [
            'verify' => FALSE,
        ];
        $client  = new Client($options);
        $resp    = $client->post("http://officejineng.com/api/article/create", [
            'form_params' => $data,
        ]);

        if ($resp->getBody() == "ok") {
            self::$_logger->info("success: " . $this->url);

            return;
        }

        self::$_logger->err($resp->getBody());
        throw new \Exception($resp->getBody());
    }

    private function getProcessor($host)
    {
        $processorMapper = [
            'www.cnblogs.com' => CnBlogs::className(),
        ];

        if (!isset($processorMapper[$host])) {
            throw new Exception("no processor exist for host: " . $host);
        }

        return $processorMapper[$host];
    }
}