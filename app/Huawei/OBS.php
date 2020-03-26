<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 2020/3/23
 * Time: 16:02
 */

namespace  App\Huawei;

use App\Models\VideoUploadId;
use Obs\ObsClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use TencentCloud\Dayu\V20180709\Models\DDoSAlarmThreshold;

class OBS
{
    public function createOBS()
    {
        // 创建ObsClient实例
        return ObsClient::factory([
            'key' => env('HW_OBS_ACCESS_KEY'),
            'secret' => env('HW_OBS_ACCESS_SECRET'),
            'endpoint' => env('HW_OBS_ENDPOINT')
        ]);
    }

    public function uploadObsBlock(array $input, ObsClient $obsClient)
    {
        if($input['offset'] == 0){
            // init upload
            $fileOriginal = ".".$input['filename']->getClientOriginalExtension();
            $resp = $obsClient->initiateMultipartUpload([
                'Bucket' => env('HW_OBS_BUCKET'),
                'Key' => 'uploadVideo/' . $input['md5Code'] . $fileOriginal,
                'ContentType' => 'text/plain',
                'Metadata' => ['property' => $input['md5Code']]
            ]);
            $upload_id = $resp['UploadId'];
            VideoUploadId::create(['md5_code'=>$input['md5Code'],'file_original'=>$fileOriginal,'upload_id'=>$upload_id]);
        }else{
            $VideoUploadId = VideoUploadId::query()->where('md5_code',$input['md5Code'])->first();
            $upload_id = $VideoUploadId->upload_id;
            $fileOriginal = $VideoUploadId->file_original;
        }
        $resp = $obsClient->uploadPart([
            'Bucket' => env('HW_OBS_BUCKET'),
            'Key' => 'uploadVideo/' . $input['md5Code'] . $fileOriginal,
            // 设置分段号，范围是1~10000
            'PartNumber' => $input['blockNum'],
            // 设置Upload ID
            'UploadId' => $upload_id,
            // 设置将要上传的大文件,localfile为上传的本地文件路径，需要指定到具体的文件名
            'SourceFile' => $input['filename'],
            // 设置分段大小
            'PartSize' => $input['blockSize'],
            // 设置分段的起始偏移大小
            'Offset' => $input['offset']
        ]);

        return ['PartNumber'=>$input['blockNum'], 'ETag'=>$resp['ETag']];
    }

    public function compleleUploadObsBlock(array $parts, array $input,ObsClient $obsClient){

        $VideoUploadId = VideoUploadId::query()->where('md5_code',$input['md5Code'])->first();
        $upload_id = $VideoUploadId->upload_id;
        $fileOriginal = $VideoUploadId->file_original;

        $resp = $obsClient->uploadPart([
            'Bucket' => env('HW_OBS_BUCKET'),
            'Key' => 'uploadVideo/' . $input['md5Code'] . $fileOriginal,
            // 设置分段号，范围是1~10000
            'PartNumber' => $input['blockNum'],
            // 设置Upload ID
            'UploadId' => $upload_id,
            // 设置将要上传的大文件,localfile为上传的本地文件路径，需要指定到具体的文件名
            'SourceFile' => $input['filename'],
            // 设置分段大小
            'PartSize' => $input['blockSize'],
            // 设置分段的起始偏移大小
            'Offset' => $input['offset']
        ]);
        $parts[count($parts)] = ['PartNumber'=>$input['blockNum'], 'ETag'=>$resp['ETag']];
        $resp = $obsClient->completeMultipartUpload([
            'Bucket' => env('HW_OBS_BUCKET'),
            'Key' => 'uploadVideo/' . $input['md5Code'] . $fileOriginal,
                // 设置Upload ID
            'UploadId' => $upload_id,
            'Parts' => $parts
        ]);
        VideoUploadId::query()->where('md5_code',$input['md5Code'])->delete();
        return $resp;
    }

    public function cancelUploadObsBlock(array $input, ObsClient $obsClient)
    {
        $VideoUploadId = VideoUploadId::query()->where('md5_code',$input['md5Code'])->first();
        $upload_id = $VideoUploadId->upload_id;
        $fileOriginal = $VideoUploadId->file_original;

        $resp = $obsClient->abortMultipartUpload([
            'Bucket' => env('HW_OBS_BUCKET'),
            'Key' => 'uploadVideo/' . $input['md5Code'] . $fileOriginal,
            // 设置Upload ID
            'UploadId' => $upload_id
        ]);
        return $resp;
    }

    public function uploadObs(array $input, ObsClient $obsClient)
    {
        $fix = ".".$input['filename']->getClientOriginalExtension();
        $resp = $obsClient->putObject( [
            'Bucket' =>  env('HW_OBS_BUCKET'),
            'Key' => 'uploadVideo/' .$input['md5Code'].$fix,
            'SourceFile' => $input['filename']
        ] );
        return $resp;
    }

    public function getMetadataObs(string $md5code, ObsClient $obsClient)
    {
        $resp = $obsClient->listObjects( [
            'Bucket' =>  env('HW_OBS_BUCKET'),
            'Prefix' => 'uploadVideo/'.$md5code
        ] );
        $resp = $obsClient->createV4SignedUrl([
            'Expires' => env('HW_OBS_Expires'),
            'Method' => 'GET',
            'Bucket' => env('HW_OBS_BUCKET'),
            'Key' => $resp['Contents'][0]['Key']
        ]);
        return $resp;
    }
}