<?php
namespace common\util;


class FullUrl
{
    private static function buildUrl($url_arr)
    {
        $new_url = $url_arr['scheme'] . "://" . $url_arr['host'];
        if (!empty($url_arr['port']))
            $new_url = $new_url . ":" . $url_arr['port'];
        $new_url = $new_url . $url_arr['path'];
        if (!empty($url_arr['query']))
            $new_url = $new_url . "?" . $url_arr['query'];
        if (!empty($url_arr['fragment']))
            $new_url = $new_url . "#" . $url_arr['fragment'];

        return $new_url;
    }

    public static function process($currentPageUrl, $pendingFullUrl)
    {
        if (substr($pendingFullUrl, 0, 4) == "http") {
            return $pendingFullUrl;
        }

        if (substr($pendingFullUrl, 0, 2) == "//") {
            return $pendingFullUrl;
        }

        $currentUrl = parse_url($currentPageUrl);
        if (substr($pendingFullUrl, 0, 1) == '/') {
            $currentUrl['path'] = $pendingFullUrl;

            return self::buildUrl($currentUrl);
        }

        $pathSplit                        = explode("/", isset($currentUrl['path']) ? $currentUrl['path'] : "/");
        $pathSplit[count($pathSplit) - 1] = $pendingFullUrl;
        $currentUrl['path']               = implode("/", $pathSplit);

        return self::buildUrl($currentUrl);

    }
}