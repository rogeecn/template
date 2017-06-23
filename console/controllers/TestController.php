<?php
namespace console\controllers;


use console\base\ConsoleController;
use GuzzleHttp\Client;

class TestController extends ConsoleController
{
    public function actionIndex()
    {
        $pages = [
            "http://www.chengxuyuans.com/Perl/",
            "http://www.chengxuyuans.com/ADO.NET/",
            "http://www.chengxuyuans.com/Android/",
            "http://www.chengxuyuans.com/C/",
            "http://www.chengxuyuans.com/DB2/",
            "http://www.chengxuyuans.com/Dreamweaver/",
            "http://www.chengxuyuans.com/Fireworks/",
            "http://www.chengxuyuans.com/HTML5/",
            "http://www.chengxuyuans.com/J2ME/",
            "http://www.chengxuyuans.com/Java+/",
            "http://www.chengxuyuans.com/Javaframework/",
            "http://www.chengxuyuans.com/Linux/",
            "http://www.chengxuyuans.com/MySQL/",
            "http://www.chengxuyuans.com/PHP/",
            "http://www.chengxuyuans.com/Photoshop/",
            "http://www.chengxuyuans.com/Python/",
            "http://www.chengxuyuans.com/Ruby/",
            "http://www.chengxuyuans.com/SQL%20Server/",
            "http://www.chengxuyuans.com/Unix/",
            "http://www.chengxuyuans.com/VB.NET/",
            "http://www.chengxuyuans.com/Visual%20Studio/",
            "http://www.chengxuyuans.com/Windows%20Phone/",
            "http://www.chengxuyuans.com/Windows/",
            "http://www.chengxuyuans.com/asp.net/",
            "http://www.chengxuyuans.com/css/",
            "http://www.chengxuyuans.com/css3/",
            "http://www.chengxuyuans.com/database/SQLite/",
            "http://www.chengxuyuans.com/download/qianduan/",
            "http://www.chengxuyuans.com/hacker_knowledge/",
            "http://www.chengxuyuans.com/html/",
            "http://www.chengxuyuans.com/html5/",
            "http://www.chengxuyuans.com/iPhone_IOS/",
            "http://www.chengxuyuans.com/ibatis/",
            "http://www.chengxuyuans.com/j2ee/",
            "http://www.chengxuyuans.com/javabase/",
            "http://www.chengxuyuans.com/javascript/",
            "http://www.chengxuyuans.com/jquery/",
            "http://www.chengxuyuans.com/jquery_plugin/",
            "http://www.chengxuyuans.com/jsp/",
            "http://www.chengxuyuans.com/nodejs/",
            "http://www.chengxuyuans.com/oracle/",
            "http://www.chengxuyuans.com/qianduan/tool/",
            "http://www.chengxuyuans.com/slverlight/",
            "http://www.chengxuyuans.com/sybase/",
            "http://www.chengxuyuans.com/syskills/",
            "http://www.chengxuyuans.com/xml/",
        ];

        $config = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
        ];
        $client = new Client($config);

        foreach ($pages as $page) {
            self::$_logger->info("begin: " . $page);
            $response = $client->get($page);
            if ($response->getStatusCode() != 200) {
                self::$_logger->err(sprintf("get page: %s", $page));
                continue;
            }

            $html     = mb_convert_encoding($response->getBody(), "utf-8");
            $phpQuery = \phpQuery::newDocumentHTML($html, "UTF8");
            $pageCnt  = $phpQuery->find(".pageinfo strong:eq(0)")->text();
            self::$_logger->info(sprintf("%s has %s pages...", $page, $pageCnt));

            if ($pageCnt == 0) {
                $this->saveURL($page);
                continue;
            }

            $categoryUrlTpl = $phpQuery->find(".page li:eq(2)")->find("a")->attr("href");
            if (!$categoryUrlTpl) {
                $this->saveURL($page);
                continue;
            }

            $tpl    = explode("_", $categoryUrlTpl);
            $tpl[2] = sprintf("┠0┨<0,1,%d,1,False,False>.html", $pageCnt);
            $url    = sprintf("%s%s", $page, implode("_", $tpl));
            $this->saveURL($url);
        }
    }

    private function saveURL($url)
    {
        self::$_logger->info(sprintf("save url %s", $url));
        file_put_contents("url.txt", $url . "\n", FILE_APPEND);
    }
}