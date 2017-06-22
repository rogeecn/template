<?php
namespace console\controllers;


use common\util\FullUrl;
use console\base\ConsoleController;
use GuzzleHttp\Client;
use yii\base\Exception;
use yii\helpers\FileHelper;

class GitBookController extends ConsoleController
{
    public function actionIndex()
    {
        $options = [
            'verify' => FALSE,
        ];
        $client  = new Client($options);

        $urlTpl = "https://t0data.gitbooks.io/burpsuite/content/chapter[_param_].html";

        $urlList = [];
        for ($i = 19; $i <= 19; $i++) {
            $urlList[] = strtr($urlTpl, [
                '[_param_]' => $i,
            ]);
        }
        self::$_logger->info("urlList :", $urlList);

        $dataTpl = [
            'type'        => 2,
            'title'       => '',
            'index_show'  => '0',
            'source_url'  => [
                'source_url' => '',
            ],
            'tag'         => [
                'tag' => '',
            ],
            'category_id' => '90',
            'data'        => [
                'content'     => '',
                'description' => '',
            ],
        ];

        try {
            foreach ($urlList as $url) {
                $url = strtr($url, [
                    'chapter14.html' => 'chater14.html',
                ]);
                self::$_logger->info("begin url : " . $url);

                $data                             = $dataTpl;
                $data['source_url']['source_url'] = $url;
                $data['tag']['tag']               = 'Burp Suit,渗透测试';

                $response = $client->get($url);
                if ($response->getStatusCode() != 200) {
                    throw new Exception("response code not 200, got " . $response->getStatusCode());
                }

                $html = (string)$response->getBody();
                $doc  = \phpQuery::newDocumentHTML($html);

                $title = $doc->find("section.normal.markdown-section h3")->text();
                $title = "BurpSuite系列教程之 " . $title;

                $data['title'] = $title;

                $doc->find("section.normal.markdown-section h3")->eq(0)->remove();
                $content = $doc->find("section.normal.markdown-section")->html();
                $content = html_entity_decode($content, ENT_COMPAT, 'UTF-8');
                $content = trim($content);

                $downloadImages = [];
                $imageList      = pq("img");
                foreach ($imageList as $image) {
                    $imgSrc  = pq($image)->attr("src");
                    $fullUrl = FullUrl::process($url, $imgSrc);
                    $ext     = array_pop(explode(".", $fullUrl));

                    $saveFilePath = sprintf("%s-%s.%s", date("Y/m/d/His"), md5($fullUrl), $ext);
                    $saveFileDir  = sprintf("%s/%s", \Yii::getAlias("@runtime"), $saveFilePath);
                    $fileDir      = dirname($saveFileDir);
                    if (!is_dir($fileDir)) {
                        FileHelper::createDirectory($fileDir);
                    }

                    $client->get($fullUrl, [
                        'save_to' => $saveFileDir,
                    ]);
                    self::$_logger->info("save image file: " . $saveFilePath);

                    $downloadImages[$imgSrc] = sprintf("http://files.officejineng.com/%s", $saveFilePath);
                }
                $content = strtr($content, $downloadImages);

                $data['data'] = [
                    'content'     => $content,
                    'description' => mb_substr(strip_tags($content), 0, 120),
                ];

                self::$_logger->info("page data: ", $data);

                $resp = $client->post("http://officejineng.com/api/article/create", [
                    'form_params' => $data,
                ]);

                if ($resp->getBody() == "ok") {
                    echo "SUCCESS: " . $url;
                } else {
                    echo "ERR: " . $resp->getBody();
                    throw new \Exception($resp->getBody());
                }
                echo "\n\n";
            }
        } catch (\Exception $e) {
            self::$_logger->error($e->getMessage() . ' line: ' . $e->getLine());
        }
    }
}