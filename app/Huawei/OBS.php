<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 2020/3/23
 * Time: 16:02
 */

namespace  App\Huawei;

use Obs\ObsClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class OBS
{
    public function createOBS()
    {

        // 创建ObsClient实例
        $obsClient = new ObsClient ( [
            'key' => env('HW_OBS_ACCESS_KEY'),
            'secret' => env('HW_OBS_ACCESS_SECRET'),
            'endpoint' => env('HW_OBS_ENDPOINT').":443"
        ] );

        // URL有效期，3600秒
        $expires = 3600;
        // 创建桶
        $resp = $obsClient->createSignedUrl( [
            'Method' => 'PUT',
            'Bucket' => 'bucketname',
            'Expires' => $expires
        ] );
        printf("SignedUrl:%s\n", $resp ['SignedUrl']);

        $httpClient = new Client(['Verify' => false ]);
        $content = '<CreateBucketConfiguration><LocationConstraint>your-location</LocationConstraint></CreateBucketConfiguration>';
        $url = $resp['SignedUrl'];
//        dd($resp);
        try{
            $response = $httpClient -> createV4SignedUrl('GET', $url, ['body' => $content, 'headers'=> $resp['ActualSignedRequestHeaders']]);
            dd($response);
            printf("%s using temporary signature url:\n", 'Create bucket');
            printf("\t%s successfully.\n", $url);
            printf("\tStatus:%d\n", $response -> getStatusCode());
            printf("\tContent:%s\n", $response -> getBody() -> getContents());
            $response -> getBody()-> close();
        }catch (ClientException $ex){
            printf("%s using temporary signature url:\n", 'Create bucket');
            printf("\t%s failed!\n", $url);
            printf('Exception message:%s', $ex ->getMessage());
        }
    }
}