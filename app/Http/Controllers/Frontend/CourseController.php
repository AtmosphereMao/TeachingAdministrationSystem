<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Frontend;

use App\Services\Course\Models\Course;
use App\Services\Course\Models\CourseStudyRecord;
use App\Services\Course\Models\CourseVisitor;
use App\Services\Member\Models\UserCourse;
use function Couchbase\defaultDecoder;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Businesses\BusinessState;
use App\Constant\FrontendConstant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\Base\Services\ConfigService;
use App\Services\Member\Services\UserService;
use App\Services\Order\Services\OrderService;
use App\Services\Course\Services\VideoService;
use App\Services\Course\Services\CourseService;
use App\Services\Course\Services\CourseTagService;
use App\Services\Course\Services\CourseCommentService;
use App\Services\Course\Services\CourseCategoryService;
use App\Services\Base\Interfaces\ConfigServiceInterface;
use App\Services\Member\Interfaces\UserServiceInterface;
use App\Services\Order\Interfaces\OrderServiceInterface;
use App\Services\Course\Interfaces\VideoServiceInterface;
use App\Services\Course\Interfaces\CourseServiceInterface;
use App\Services\Course\Interfaces\CourseCommentServiceInterface;
use App\Services\Course\Interfaces\CourseCategoryServiceInterface;
use App\Services\Course\Interfaces\CourseTagServiceInterface;

use App\Services\Course\Interfaces\CourseVisitorServiceInterface;
use App\Services\Course\Services\CourseVisitorService;
use Weboap\Visitor\Facades\VisitorFacade;

class CourseController extends FrontendController
{
    /**
     * @var CourseService
     */
    protected $courseService;
    /**
     * @var ConfigService
     */
    protected $configService;
    /**
     * @var CourseCommentService
     */
    protected $courseCommentService;
    /**
     * @var UserService
     */
    protected $userService;
    /**
     * @var VideoService
     */
    protected $videoService;
    /**
     * @var OrderService
     */
    protected $orderService;
    /**
     * @var CourseCategoryService
     */
    protected $courseCategoryService;
    /**
     * @var CourseTagService
     */
    protected $courseTagService;
    /**
     * @var CourseVisitorService
     */
    protected $courseVisitorService;
    /**
     * @var BusinessState
     */
    protected $businessState;

    public function __construct(
        CourseServiceInterface $courseService,
        ConfigServiceInterface $configService,
        CourseCommentServiceInterface $courseCommentService,
        UserServiceInterface $userService,
        VideoServiceInterface $videoService,
        OrderServiceInterface $orderService,
        CourseCategoryServiceInterface $courseCategoryService,
        CourseTagServiceInterface $courseTagService,
        BusinessState $businessState
    ) {
        $this->courseService = $courseService;
        $this->configService = $configService;
        $this->courseCommentService = $courseCommentService;
        $this->userService = $userService;
        $this->videoService = $videoService;
        $this->orderService = $orderService;
        $this->courseCategoryService = $courseCategoryService;
        $this->courseTagService = $courseTagService;
        $this->businessState = $businessState;
    }

    public function index(Request $request)
    {
        $categoryId = (int)$request->input('category_id');
        $tagId = (array)$request->input('tag_id',[0]);
        $scene = $request->input('scene', '');
        $page = $request->input('page', 1);
        $pageSize = $this->configService->getCourseListPageSize();
        [
            'total' => $total,
            'list' => $list
        ] = $this->courseService->simplePage($page, $pageSize, $categoryId, $tagId, $scene);
        $courses = $this->paginator($list, $total, $page, $pageSize);
        $courses->appends([
            'category_id' => $categoryId,
            'scene' => $request->input('scene', ''),
        ]);
        [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
        ] = $this->configService->getSeoCourseListPage();
        $courseCategories = $this->courseCategoryService->all();
        $courseTags = $this->courseTagService->all();


        $queryParams = function ($param) {
            $request = \request();
            $params = [
                'page' => $request->input('page'),
                'category_id' => $request->input('category_id', 0),
                'scene' => $request->input('scene', ''),
                'tag_id' => $request->input('tag_id', [0]),
            ];
            if (array_key_exists('tag_id',$param)) {
                if(in_array(0,$param['tag_id']) || in_array(0,$params['tag_id'])){
                    $params = array_merge($params, $param);
                }elseif(array_intersect($params['tag_id'],$param['tag_id'])){
                    $params['tag_id'] = array_diff($params['tag_id'], $param['tag_id']);
                }
                else{
                    $params = array_merge_recursive($params, $param);
                }
            }else{
                $params = array_merge($params, $param);}
            return http_build_query($params);
        };

        return v('frontend.course.index', compact(
            'courses',
            'title',
            'keywords',
            'description',
            'courseCategories',
            'courseTags',
            'categoryId',
            'scene',
            'queryParams',
            'tagId'
        ));
    }

    public function show(Request $request, $id, $slug)
    {
        VisitorFacade::log($id);
        $logCount = CourseVisitor::query()->where('course_id',$id)->count();
        $scene = $request->input('scene', '');

        $course = $this->courseService->find($id);
        $chapters = $this->courseService->chapters($course['id']);
        $videos = $this->videoService->courseVideos($course['id']);
        $tempV = [];
        $count = 0;
        foreach ($videos as $v)
            foreach ($v as $key=>$value)
                $tempV[$count++] = $value['id'];
        $progress = CourseStudyRecord::query()->whereIn('video_id',$tempV)->where('user_id', Auth::id())->get()->toArray();
        $comments = $this->courseCommentService->courseComments($course['id']);
        $commentUsers = $this->userService->getList(array_column($comments, 'user_id'), ['role']);
        $commentUsers = array_column($commentUsers, null, 'id');
        $category = $this->courseCategoryService->findOrFail($course['category_id']);

        $title = $course['title'];
        $keywords = $course['seo_keywords'];
        $description = $course['seo_description'];

        // 是否购买
        $isBuy = $this->businessState->isBuyCourse($course['id']);
        // 喜欢课程
        $isLikeCourse = false;
        Auth::check() && $isLikeCourse = $this->userService->likeCourseStatus(Auth::id(), $course['id']);
        // 该课程的第一个视频
        $firstChapter = Arr::first($chapters);
        $firstVideo = [];
        if ($firstChapter && ($videos[$firstChapter['id']] ?? [])) {
            $firstVideo = $videos[$firstChapter['id']][0];
        } else {
            Arr::first($videos) && $firstVideo = $videos[0][0];
        }

        return v('frontend.course.show', compact(
            'course',
            'title',
            'keywords',
            'description',
            'comments',
            'commentUsers',
            'videos',
            'chapters',
            'isBuy',
            'category',
            'isLikeCourse',
            'firstVideo',
            'scene',
            'logCount',
            'progress'
        ));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function showBuyPage($id)
    {
        $course = $this->courseService->find($id);
        if ($this->userService->hasCourse(Auth::id(), $id)) {
            flash(__('You have already purchased this course'), 'success');
            return back();
        }
        $title = __('buy course', ['course' => $course['title']]);
        $goods = [
            'id' => $course['id'],
            'title' => $course['title'],
            'thumb' => $course['thumb'],
            'charge' => $course['charge'],
            'label' => '整套课程',
        ];
        $total = $course['charge'];
        $scene = get_payment_scene();
        $payments = get_payments($scene);

        return v('frontend.order.create', compact('goods', 'title', 'total', 'scene', 'payments'));
    }

    public function buyHandler(Request $request)
    {
        $id = $request->input('goods_id');
        $promoCodeId = abs((int)$request->input('promo_code_id'));
        $course = $this->courseService->find($id);
        $order = $this->orderService->createCourseOrder(Auth::id(), $course, $promoCodeId);

        if ($order['status'] === FrontendConstant::ORDER_PAID) {
            UserCourse::create(['user_id'=>$order['user_id'], 'course_id'=>$course['id'], 'created_at'=>Carbon::now(),'charge'=>$order['charge']]);
            Course::query()->where('id',$course['id'])->increment('user_count');
            flash(__('success'), 'success');
            return redirect(route('course.show', [$course['id'], $course['slug']]));
        }

        $paymentScene = $request->input('payment_scene');
        $payment = $request->input('payment_sign');

        return redirect(route('order.pay', ['scene' => $paymentScene, 'payment' => $payment, 'order_id' => $order['order_id']]));
    }
}
