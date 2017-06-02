<?php
namespace modules\ueditor\components;


use yii\base\Component;

class Loader extends Component
{
    private static $_CONFIG = [];

    public static function run($type)
    {
        if (empty(self::$_CONFIG)) {
            $config_data   = file_get_contents(__DIR__ . "/config.json");
            self::$_CONFIG = json_decode(preg_replace('/\/\*[\s\S]+?\*\//', "", $config_data), TRUE);
        }

        return call_user_func_array([Loader::className(), $type], []);

    }

    private static function config()
    {
        return self::$_CONFIG;
    }

    private static function uploadImage()
    {
        $config    = array(
            "pathFormat" => self::$_CONFIG['imagePathFormat'],
            "maxSize"    => self::$_CONFIG['imageMaxSize'],
            "allowFiles" => self::$_CONFIG['imageAllowFiles'],
        );
        $fieldName = self::$_CONFIG['imageFieldName'];

        $up = new UEditorUploader($fieldName, $config, 'upload');

        return $up->getFileInfo();
    }

    private static function uploadScrawl()
    {
        $config    = array(
            "pathFormat" => self::$_CONFIG['scrawlPathFormat'],
            "maxSize"    => self::$_CONFIG['scrawlMaxSize'],
//            "allowFiles" => self::$_CONFIG['scrawlAllowFiles'],
            "oriName"    => "scrawl.png",
        );
        $fieldName = self::$_CONFIG['scrawlFieldName'];

        $up = new UEditorUploader($fieldName, $config, 'base64');

        return $up->getFileInfo();
    }

    private static function uploadVideo()
    {
        $config    = array(
            "pathFormat" => self::$_CONFIG['videoPathFormat'],
            "maxSize"    => self::$_CONFIG['videoMaxSize'],
            "allowFiles" => self::$_CONFIG['videoAllowFiles'],
        );
        $fieldName = self::$_CONFIG['videoFieldName'];

        $up = new UEditorUploader($fieldName, $config, 'upload');

        return $up->getFileInfo();
    }

    private static function uploadFile()
    {
        $config    = array(
            "pathFormat" => self::$_CONFIG['filePathFormat'],
            "maxSize"    => self::$_CONFIG['fileMaxSize'],
            "allowFiles" => self::$_CONFIG['fileAllowFiles'],
        );
        $fieldName = self::$_CONFIG['fileFieldName'];
        $up        = new UEditorUploader($fieldName, $config, 'upload');

        return $up->getFileInfo();
    }

    private static function listFile()
    {
        $allowFiles = self::$_CONFIG['fileManagerAllowFiles'];
        $listSize   = self::$_CONFIG['fileManagerListSize'];
        $path       = self::$_CONFIG['fileManagerListPath'];

        return self::listFiles($allowFiles, $listSize, $path);
    }

    public static function listFiles($allowFiles, $listSize, $path)
    {
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

        /* 获取参数 */
        $size  = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end   = $start + $size;

        /* 获取文件列表 */
        $path  = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "" : "/") . $path;
        $files = self::getFiles($path, $allowFiles);
        if (!count($files)) {
            return array(
                "state" => "no match file",
                "list"  => array(),
                "start" => $start,
                "total" => count($files),
            );
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }

        return [
            "state" => "SUCCESS",
            "list"  => $list,
            "start" => $start,
            "total" => count($files),
        ];
    }

    private static function getFiles($path, $allowFiles, &$files = array())
    {
        if (!is_dir($path)) {
            return NULL;
        }
        if (substr($path, strlen($path) - 1) != '/') {
            $path .= '/';
        }
        $handle = opendir($path);
        while (FALSE !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    self::getFiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match('/\.(' . $allowFiles . ')$/i', $file)) {
                        $files[] = array(
                            'url'   => substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime' => filemtime($path2),
                        );
                    }
                }
            }
        }

        return $files;
    }

    private static function listImage()
    {
        $allowFiles = self::$_CONFIG['imageManagerAllowFiles'];
        $listSize   = self::$_CONFIG['imageManagerListSize'];
        $path       = self::$_CONFIG['imageManagerListPath'];

        return self::listFiles($allowFiles, $listSize, $path);
    }

    private function cacheImage()
    {
        $config    = array(
            "pathFormat" => self::$_CONFIG['catcherPathFormat'],
            "maxSize"    => self::$_CONFIG['catcherMaxSize'],
            "allowFiles" => self::$_CONFIG['catcherAllowFiles'],
            "oriName"    => "remote.png",
        );
        $fieldName = self::$_CONFIG['catcherFieldName'];

        /* 抓取远程图片 */
        $list = array();
        if (isset($_POST[$fieldName])) {
            $source = $_POST[$fieldName];
        } else {
            $source = $_GET[$fieldName];
        }
        foreach ($source as $imgUrl) {
            $item = new UEditorUploader($imgUrl, $config, "remote");
            $info = $item->getFileInfo();
            array_push($list, array(
                "state"    => $info["state"],
                "url"      => $info["url"],
                "size"     => $info["size"],
                "title"    => htmlspecialchars($info["title"]),
                "original" => htmlspecialchars($info["original"]),
                "source"   => htmlspecialchars($imgUrl),
            ));
        }

        /* 返回抓取数据 */

        return array(
            'state' => count($list) ? 'SUCCESS' : 'ERROR',
            'list'  => $list,
        );
    }
}