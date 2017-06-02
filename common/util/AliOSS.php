<?php
namespace common\util;

use DateTime;
use JohnLui\AliyunOSS;
use yii\base\Component;

class AliOSS extends Component
{


    /* 城市名称：
     *
     *  经典网络下可选：杭州、上海、青岛、北京、张家口、深圳、香港、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
     *  VPC 网络下可选：杭州、上海、青岛、北京、张家口、深圳、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
     */
    public $city            = '杭州';
    public $networkType     = '经典网络'; # 经典网络 or VPC
    public $accessKeyId     = '';
    public $accessKeySecret = '';
    public $bucketId        = '';
    public $isInternal      = FALSE;


    /** @var \JohnLui\AliyunOSS */
    private $ossClient;

    public function __construct($config = [])
    {
        parent::__construct($config);

        if ($this->networkType == 'VPC' && !$this->isInternal) {
            throw new \Exception("VPC 网络下不提供外网上传、下载等功能");
        }

        $this->ossClient = AliyunOSS::boot(
            $this->city,
            $this->networkType,
            $this->isInternal,
            $this->accessKeyId,
            $this->accessKeySecret
        );
        $this->ossClient->setBucket($this->bucketId);
    }

    /**
     * @return null|object|AliOSS
     */
    public static function instance()
    {
        return \Yii::$app->get("oss");
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

    public function copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
    {
        return $this->ossClient->copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
    }

    public function moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
    {
        return $this->ossClient->moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
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
