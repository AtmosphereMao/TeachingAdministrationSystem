<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Backend\Api\V1;

use App\Models\CourseComment;

class CourseCommentController extends BaseController
{
    public function index()
    {
        $comments = CourseComment::with(['user', 'course'])
            ->orderByDesc('id')
            ->paginate(request()->input('size', 12));

        return $this->successData($comments);
    }

    public function destroy($id)
    {
        CourseComment::destroy($id);

        return $this->success();
    }
}
