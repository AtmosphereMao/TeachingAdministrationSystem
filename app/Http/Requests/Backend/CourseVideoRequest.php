<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\Backend;

use Overtrue\Pinyin\Pinyin;

class CourseVideoRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_id' => 'required',
            'title' => 'required|max:255',
            'short_description' => 'required|max:255',
            'original_desc' => 'required',
            'render_desc' => 'required',
            'published_at' => 'required|date',
            'is_show' => 'required',
            'duration' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => '请选择视频所属课程',
            'title.required' => '请输入视频标题',
            'title.max' => '视频标题长度不能超过255个字符',
            'short_description.required' => '请输入视频简短介绍',
            'short_description.max' => '视频简短介绍长度不能超过255个字符',
            'original_desc.required' => '请输入视频详细介绍',
            'render_desc.required' => '请输入视频详细介绍',
            'published_at.required' => '请选择视频上线时间',
            'published_at.date' => '请选择正确的视频上线时间',
            'is_show.required' => '请选择视频是否显示',
            'duration.required' => '请输入视频时长',
            'duration.integer' => '视频时长必须为整数',
        ];
    }

    public function filldata()
    {
        $data = [
            'user_id' => $this->input('user_id', 0),
            'course_id' => $this->input('course_id'),
            'title' => $this->input('title'),
            'url' => $this->input('url', '') ?? '',
            'aliyun_video_id' => $this->input('aliyun_video_id', '') ?? '',
            'tencent_video_id' => $this->input('tencent_video_id', '') ?? '',
            'view_num' => $this->input('view_num', 0),
            'short_description' => $this->input('short_description'),
            'original_desc' => $this->input('original_desc'),
            'render_desc' => $this->input('render_desc'),
            'seo_keywords' => $this->input('seo_keywords', ''),
            'seo_description' => $this->input('seo_description', ''),
            'published_at' => $this->input('published_at'),
            'is_show' => $this->input('is_show'),
            'charge' => $this->input('charge', 0),
            'chapter_id' => $this->input('chapter_id', 0),
            'duration' => $this->input('duration'),
        ];

        if ($this->isMethod('post')) {
            $data['slug'] = implode('-', (new Pinyin())->convert($data['title']));
        }

        return $data;
    }
}
