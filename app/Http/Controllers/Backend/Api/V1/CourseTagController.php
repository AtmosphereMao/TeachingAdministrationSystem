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

use App\Http\Requests\Backend\CourseTagRequest;
use App\Services\Course\Models\CourseTag;

class CourseTagController extends BaseController
{
    public function index()
    {
        $navs = CourseTag::orderByDesc('id')->paginate(12);

        return $this->successData($navs);
    }

    public function store(CourseTagRequest $request)
    {
        CourseTag::create($request->filldata());
        return $this->success();
    }

    public function edit($id)
    {
        $info = CourseTag::findOrFail($id);

        return $this->successData($info);
    }

    public function update(CourseTagRequest $request, $id)
    {
        $role = CourseTag::findOrFail($id);
        $role->fill($request->filldata())->save();

        return $this->success();
    }

    public function destroy($id)
    {
        CourseTag::destroy($id);

        return $this->success();
    }
}
