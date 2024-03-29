<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\Frontend\Member;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Frontend\BaseRequest;
use App\Services\Base\Services\ConfigService;
use App\Services\Base\Interfaces\ConfigServiceInterface;
use App\Huawei\OBS;

class AvatarChangeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'file' => 'required|image|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => __('file.required'),
            'file.image' => __('file.image'),
            'file.max' => __('file.max', ['size' => '1M']),
        ];
    }

    public function filldata()
    {
        /**
         * @var ConfigService
         */

        $file = $this->file('file');
        $obsService = app()->make(OBS::class);
        $obs = $obsService->createOBS();
        $input = [
            'filename' => $file,
            'md5Code' => md5($file)
        ];
        $response = $obsService->uploadObs($input, $obs, 'uploadAvatar/');


        return ['url' => $response['ObjectURL']];
    }
}
