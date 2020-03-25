<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Backend\Api\V1;

use App\Huawei\OBS;
use Exception;
use Illuminate\Http\Request;
use vod\Request\V20170321 as vod;

class VideoUploadController extends BaseController
{
    public function tencentToken()
    {
        $signature = app()->make(\App\Meedu\Tencent\Vod::class)->getUploadSignature();

        return $this->successData(compact('signature'));
    }

    public function huaweiTokenBlock(Request $request)
    {
        $obsService = app()->make(OBS::class);
        $obs = $obsService->createOBS();
        $input = [
            'filename' => $request->file('filename'),   // 文件
            'md5Code' => $request->input('md5Code'),    // MD5 用于确认同一文件
            'blockNum' => $request->input('blockNum'),  // 设置分段号，范围是1~10000
            'blockSize' => $request->input('blockSize'),    // 设置分段大小
            'offset' => $request->input('offset'),  // 设置分段的起始偏移大小
            'flag' => $request->input('flag')   // 设置是否完成 0未完成 1完成
        ];
        // 判断是否完成分块上传
        if($input['flag']) {
            $parts = json_decode($request->input('parts'));
            $signature = $obsService->compleleUploadObsBlock($parts,$input,$obs);
        }else   // 未完成继续上传
            $signature = $obsService->uploadObsBlock($input, $obs);
        return $this->successData(compact('signature'));
    }

    public function huaweiToken(Request $request)
    {
        $obsService = app()->make(OBS::class);
        $obs = $obsService->createOBS();
        $input = [
            'filename' => $request->file('filename'),   // 文件
            'md5Code' => $request->input('md5Code'),    // MD5 用于确认同一文件
          ];
        $response = $obsService->uploadObs($input, $obs);
        $signature = ['ETag'=>$response['ETag'],'ObjectURL'=>$response['ObjectURL']];
        return $this->successData(compact('signature'));
    }

    public function huaweiTokenCancel(Request $request)
    {
        $obsService = app()->make(OBS::class);
        $obs = $obsService->createOBS();
        $input = [
            'md5Code' => $request->input('md5Code'),    // MD5 用于确认同一文件
        ];
        $response = $obsService->cancelUploadObsBlock($input, $obs);
        return $this->successData(compact('response'));
    }
    public function aliyunCreateVideoToken(Request $request)
    {

        $signature = app()->make(\App\Meedu\Tencent\Vod::class)->getUploadSignature();
        try {
            $title = $request->input('title');
            $filename = $request->input('filename');
            $client = aliyun_sdk_client();
            $request = new vod\CreateUploadVideoRequest();
            $request->setTitle($title);
            $request->setFileName($filename);
            $response = $client->getAcsResponse($request);

            return $this->successData([
                'upload_auth' => $response->UploadAuth,
                'upload_address' => $response->UploadAddress,
                'video_id' => $response->VideoId,
                'request_id' => $response->RequestId,
            ]);
        } catch (Exception $exception) {
            exception_record($exception);

            return $this->error($exception->getMessage());
        }
    }

    public function aliyunRefreshVideoToken(Request $request)
    {
        try {
            $videoId = $request->input('video_id');
            $client = aliyun_sdk_client();
            $request = new vod\RefreshUploadVideoRequest();
            $request->setVideoId($videoId);
            $response = $client->getAcsResponse($request);

            return [
                'upload_auth' => $response->UploadAuth,
                'upload_address' => $response->UploadAddress,
                'video_id' => $response->VideoId,
                'request_id' => $response->RequestId,
            ];
        } catch (Exception $exception) {
            exception_record($exception);

            return $this->error($exception->getMessage());
        }
    }

}
