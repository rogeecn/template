<?php
namespace common\content\processors;


use common\content\IProcessor;
use yii\base\Component;

class CnBlogs extends Component implements IProcessor
{
    public function processContent($content)
    {
        $pattern = '/<pre>(.*?)<\/pre>/im';
        $content = preg_replace_callback($pattern, function ($matches) {
            $matchHtml = $matches[1];
            $matchHtml = strip_tags($matchHtml, "<br>");
            $matchHtml = str_replace("<br />", "\n", $matchHtml);

            return sprintf("<pre>%s</pre>", $matchHtml);
        }, $content);

        $content = strtr($content, [
            '<div class="cnblogs_code">' => '<p>',
            '</div>'                     => '</p>',
        ]);

        return $content;
    }

    public function getPublishData($htmlData)
    {
        $phpQuery = \phpQuery::newDocumentHTML($htmlData);
        $title    = $phpQuery->find("#post_detail .postTitle")->text();

        $contentHtml = $phpQuery->find("#post_detail #cnblogs_post_body")->html();
        $content     = $this->processContent($contentHtml);
        $description = mb_substr(strip_tags($content), 0, 120);
        $description = strtr($description, [
            " " => '',
        ]);

        return [
            'title'       => $title,
            'content'     => $content,
            'description' => $description,
        ];
    }
}