<?php
namespace obs;

require 'vendor/autoload.php';
require 'obs-autoloader.php';

use Obs\ObsClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Obs\Internal;

define('OBS_METHOD', 'GET');
define('OBS_AK', '');
define('OBS_SK', '');
define('OBS_END_POINT', '');

define('OBS_REGION', 'cn-east-2');
define('OBS_BUCKET_NAME', 'bucket-shanghai');
