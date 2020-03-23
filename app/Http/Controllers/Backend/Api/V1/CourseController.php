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

use Illuminate\Http\Request;
use App\Constant\BackendApiConstant;
use App\Services\Course\Models\Video;
use App\Services\Course\Models\Course;
use App\Http\Requests\Backend\CourseRequest;
use App\Services\Course\Models\CourseCategory;
use App\Services\Course\Models\CourseTagLink;

class CourseController extends BaseController
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');
        $cid = $request->input('cid');
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');
        $courses = Course::when($keywords, function ($query) use ($keywords) {
            return $query->where('title', 'like', '%' . $keywords . '%');
        })->when($cid, function ($query) use ($cid) {
            return $query->whereCategoryId($cid);
        })
            ->orderBy($sort, $order)
            ->paginate(12);

        $courses->appends($request->input());

        $categories = CourseCategory::select(['id', 'name'])->orderBy('sort')->get();

        return $this->successData(compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = CourseCategory::show()->get();
        return $this->successData(compact('categories'));
    }

    public function store(CourseRequest $request, Course $course)
    {
        $data = $request->filldata();
        $tags = $request->getTagsId();
//        $course->fill($data)->save();
        $id = Course::insertGetId($data);
//        dd($tags);
        foreach ($tags as $item){
            CourseTagLink::create(['tag_id'=>$item, 'course_id'=>$id]);
        }

        return $this->success();
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $tagId = CourseTagLink::query()->where(['course_id'=>$id])->get();
        $temp = [];
        foreach ($tagId as $item) {
            array_push($temp,$item->id);
        }
        $course->setAttribute('tag_id',$temp);
//        dd($course);
        return $this->successData($course);
    }

    public function update(CourseRequest $request, $id)
    {
        $data = $request->filldata();
        /**
         * @var Course
         */
        $course = Course::findOrFail($id);

        // 标签
        $tags = $request->getTagsId();
        $tags_table_temp = [];
        $tags_table = CourseTagLink::query()->where('course_id',$id)->select(['id','tag_id'])->get();
        if($tags_table) {$tags_table = $tags_table->toArray();}
        // 删除
        foreach ($tags_table as $item){
            if(in_array($item['tag_id'],$tags)){
                array_push($tags_table_temp,$item['tag_id']);
                continue;}
            CourseTagLink::query()->findOrFail($item['id'])->delete();
        }
        // 创建
        $tags_table_temp = array_diff($tags,$tags_table_temp);
        foreach ($tags_table_temp as $item){
            CourseTagLink::create(['tag_id'=>$item, 'course_id'=>$id]);
        }

        $originIsShow = $course->is_show;
        $course->fill($data)->save();


        // 判断是否修改了显示的状态
        if ($originIsShow != $data['is_show']) {
            // 修改下面的视频显示状态
            Video::where('course_id', $course->id)->update(['is_show' => $data['is_show']]);
        }

        return $this->success();
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if ($course->videos()->exists()) {
            return $this->error(BackendApiConstant::COURSE_BAN_DELETE_FOR_VIDEOS);
        }
        $course->delete();
        CourseTagLink::query()->where('course_id',$id)->delete();
        return $this->success();
    }
}
