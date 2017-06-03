<?php
namespace common\util;

use common\traits\Setting;
use DateTime;
use JohnLui\AliyunOSS;

class AliOSS
{
    use Setting;
    private $cityList = [
        "杭州",
        "上海",
        "青岛",
        "北京",
        "张家口",
        "深圳",
        "香港",
        "硅谷",
        "弗吉尼亚",
        "新加坡",
        "悉尼",
        "日本",
        "法兰克福",
        "迪拜",
    ];

    private $networkTypeList = ["经典网络", 'VPC'];


    /* 城市名称：
     *
     *  经典网络下可选：杭州、上海、青岛、北京、张家口、深圳、香港、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
     *  VPC 网络下可选：杭州、上海、青岛、北京、张家口、深圳、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
     */

//    private $isInternal;
//    private $accessKeyId;
//    private $accessKeySecret;
//    private $city;
//    private $networkType;
    private $bucketId;

    /** @var \JohnLui\AliyunOSS */
    private $ossClient;

    private static $_instance;

    public function __construct()
    {
        $isInternal      = $this->setting("oss.is_internal");
        $accessKeyId     = $this->setting("oss.access_key_id");
        $accessKeySecret = $this->setting("oss.access_key_secret");
        $city            = $this->cityList[$this->setting("oss.region")];
        $networkType     = $this->networkTypeList[$this->setting("oss.network_type")];
        $this->bucketId  = $this->setting("oss.bucket_id");

        if ($networkType == 'VPC' && !$isInternal) {
            throw new \Exception("VPC 网络下不提供外网上传、下载等功能");
        }

        $this->ossClient = AliyunOSS::boot(
            $city,
            $networkType,
            $isInternal,
            $accessKeyId,
            $accessKeySecret
        );
        $this->ossClient->setBucket($this->bucketId);
    }

    /**
     * @return null|object|AliOSS
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    public function uploadFile($ossPath, $filePath, $options = [])
    {
        return $this->ossClient->uploadFile($ossPath, $filePath, $options);
    }

    public function uploadContent($ossKey, $content, $options = [])
    {
        return $this->ossClient->uploadContent($ossKey, $content, $options);
    }


    public function deleteObject($ossKey)
    {
        $this->ossClient->deleteObject($this->bucketId, $ossKey);
    }

    public function copyObject($sourceBucket, $sourceKey, $destBucket, $destKey)
    {
        return $this->ossClient->copyObject($sourceBucket, $sourceKey, $destBucket, $destKey);
    }

    public function moveObject($sourceBucket, $sourceKey, $destBucket, $destKey)
    {
        return $this->ossClient->moveObject($sourceBucket, $sourceKey, $destBucket, $destKey);
    }

    // 获取公开文件的 URL
    public function getPublicObjectURL($ossKey)
    {
        return $this->ossClient->getPublicUrl($ossKey);
    }

    // 获取私有文件的URL，并设定过期时间，如 \DateTime('+1 day')
    public function getPrivateObjectURLWithExpireTime($ossKey, DateTime $expire_time)
    {
        return $this->ossClient->getUrl($ossKey, $expire_time);
    }

    public function createBucket($bucketName)
    {
        return $this->ossClient->createBucket($bucketName);
    }

    public function getAllObjectKey($bucketName)
    {
        return $this->ossClient->getAllObjectKey($bucketName);
    }

    public function getObjectMeta($bucketName, $ossKey)
    {
        return $this->ossClient->getObjectMeta($bucketName, $ossKey);
    }

}
