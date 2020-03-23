<?php

namespace obs;

require_once 'ObsConfig.php';
use Obs\ObsClient;

class ObsPut {
    // 桶名
    public $OBS_BUCKET_NAME = 'bucket-mxwl-01';
    // 文件路径
    public $SOURCE_FILE = 'C:\wamp64\www\Project\assets\obs_test.mp4';
    // 生成的md5文件名
    public $OBJECT_NAME = '';
    // 文件后缀
    public $SUFFIX = '.mp4';
    // 用户id, 用于生成md5值
    public $USER_ID = 1;

    function directUpload() {

        $this->SUFFIX = substr($this->SOURCE_FILE, strrpos($this->SOURCE_FILE, '.'));
        $this->OBJECT_NAME = md5(time() + $this->USER_ID);
        $OBJECT_NAME_TEMP = $this->OBJECT_NAME . $this->SUFFIX;

        echo $OBJECT_NAME_TEMP;

        $obsClient = ObsClient::factory ([
            'key' => OBS_AK,
            'secret' => OBS_SK,
            'endpoint' => OBS_END_POINT,
            'socket_timeout' => 30,
            'connect_timeout' => 10
        ]);

        $response = $obsClient->putObject([
            'Bucket' => $this->OBS_BUCKET_NAME,
            'Key' => $OBJECT_NAME_TEMP,
            'SourceFile' => $this->SOURCE_FILE
        ]);

        return $response['HttpStatusCode'];
    }
}