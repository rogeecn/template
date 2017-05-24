<?php
namespace widgets\ArticleList;


use common\base\Widget;
use common\extend\Html;
use common\extend\LinkPager;
use common\util\Request;
use widgets\ListHeader;
use yii\data\Pagination;
use yii\db\Query;

class ArticleList extends Widget
{
    /*
    public $items = [
        'title'=> '判断单、多张图片加载完成',
        'url'=> [],
        'options'=> [],
        'meta'=>[
            'time'=> "2017-02-02",
            'author'=> "小仙",
            'viewCount'=> 123,
            'commentCount'=> 233,
        ],
        'content'=>'在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。试想，如果模板中有图片，此时如何判断图...'
        'image'=>[
            'http://image.baidui.com/c.jpg',
            'http://image.baidui.com/c.jpg',
            'http://image.baidui.com/c.jpg',
            'http://image.baidui.com/c.jpg',
        ]
    ];
    */
    public $items = [];
    public $title = [];
    public $pager = [];

    public function init()
    {
        parent::init();

        $currentPage = intval(Request::input("page"));
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        $limit  = 10;
        $offset = ($currentPage - 1) * $limit;

        $columns = [
            'a.id',
            'a.title',
            'f.username username',
            'f.email email',
            'e.image',
            'a.type typeID',
            'd.name typeName',
            'a.created_at createdAt',
            'a.category_id catID',
            'b.name categoryName',
            'b.alias categoryAlias',
            'c.description',
        ];
        $query   = new Query();

        $this->pager['totalCount'] = $query->from("article")
                                           ->where(['type' => 2])
                                           ->count();

        $dataList = $query->from("article a")
                          ->select(implode(",", $columns))
                          ->where(['type' => 2])
                          ->leftJoin("category b", "a.category_id = b.id")
                          ->leftJoin("field_content_data c", "c.id = a.id")
                          ->leftJoin("article_type d", "d.id = a.type")
                          ->leftJoin("field_upload_image e", "e.id = a.id")
                          ->leftJoin("member f", "f.id = a.user_id")
                          ->limit($limit)
                          ->offset($offset)
                          ->orderBy(['id' => SORT_DESC])
                          ->all();

        $items = [];
        foreach ($dataList as $data) {
            $items[] = [
                'title'   => $data['title'],
                'url'     => ['article/id', 'id' => $data['id']],
                'meta'    => [
                    'time'         => date("Y-m-d", $data['createdAt']),
                    'author'       => $data['username'],
                    'viewCount'    => 0,
                    'commentCount' => 0,
                ],
                'content' => $data['description'],
                'image'   => array_filter(explode(",", $data['image'])),
            ];
        }
        $this->items = $items;
    }

    public function run()
    {
        $lastIndex = count($this->items) - 1;

        $itemList = [];
        foreach ($this->items as $index => $item) {
            if (!isset($item['options'])) {
                $item['options'] = [];
            }

            Html::addCssClass($item['options'], ['list-item']);

            if ($index == 0) {
                Html::addCssClass($item['options'], ['first']);
            }

            if ($index == $lastIndex) {
                Html::addCssClass($item['options'], ['last']);
            }


            if (count($item['image']) == 0) {
                Html::addCssClass($item['options'], ['no-image']);
                $content = $this->render("_no_image", $item);
            } elseif (count($item['image']) == 1) {
                Html::addCssClass($item['options'], ['has-image']);
                $content = $this->render("_head_image", $item);
            } else {
                Html::addCssClass($item['options'], ['list-image']);
                $content = $this->render("_image_list", $item);
            }
            $itemList[] = $content;
        }

        $title = ListHeader::widget($this->title);

        $linkPager = LinkPager::widget([
            'pagination' => new Pagination($this->pager),
        ]);
        $linkPager = Html::div($linkPager, ['class' => 'pager']);

        return $title . implode("\n", $itemList) . $linkPager;
    }
}