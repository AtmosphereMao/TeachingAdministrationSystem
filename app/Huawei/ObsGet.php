<?php
require_once 'ObsConfig.php';
use Obs\ObsClient;

$OBS_BUCKET_NAME = 'bucket-mxwl-01';
$OBS_OBJECT_NAME = 'register.mp4';

function getUrl() {
    global $OBS_BUCKET_NAME;
    global $OBS_OBJECT_NAME;
    $obsClient = ObsClient::factory ([
        'key' => OBS_AK,
        'secret' => OBS_SK,
        'endpoint' => OBS_END_POINT,
        'socket_timeout' => 30,
        'connect_timeout' => 10
    ] );

    $response = $obsClient->createV4SignedUrl([
        'Bucket' => $OBS_BUCKET_NAME,
        'Key' => $OBS_OBJECT_NAME,
        'Method' => OBS_METHOD
    ]);
    return $response['SignedUrl'];
}