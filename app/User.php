<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Order;
use App\Models\Video;
use App\Models\Course;
use App\Models\Socialite;
use App\Models\OrderGoods;
use Illuminate\Support\Str;
use App\Models\VideoComment;
use App\Models\CourseComment;
use App\Models\UserJoinRoleRecord;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\traits\CreatedAtBetween;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User.
 *
 * @property int $id
 * @property \Illuminate\Config\Repository|mixed $avatar
 * @property string $nick_name
 * @property string $mobile
 * @property string $password
 * @property int $credit1
 * @property int $credit2
 * @property int $credit3
 * @property int $is_active       1:active,-1:unactive
 * @property int $is_lock         1:lock,-1:unlock
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role_id         角色ID
 * @property string|null $role_expired_at 过期时间
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Video[] $buyVideos
 * @property \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\CourseComment[] $courseComments
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $courses
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $joinCourses
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\UserJoinRoleRecord[] $joinRoles
 * @property \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property \App\Models\Role $role
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Socialite[] $socialite
 * @property \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\VideoComment[] $videoComments
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User createdAtBetween($startDate, $endDate)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCredit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCredit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCredit3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsLock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNickName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $email
 * @property int $invite_balance 邀请奖励余额
 * @property int $invite_user_id 邀请人id
 * @property string|null $invite_user_expired_at 邀请过期时间
 * @property int $is_password_set 密码是否配置,0否,1是
 * @property int $is_set_nickname 配置昵称,1是,0否
 * @property string $activity_token 激活验证token
 * @property string $activity_expire 激活过期时间
 * @property int $is_activity 是否激活1是，0否
 * @property-read int|null $buy_videos_count
 * @property-read int|null $course_comments_count
 * @property-read int|null $courses_count
 * @property-read int|null $join_courses_count
 * @property-read int|null $join_roles_count
 * @property-read int|null $notifications_count
 * @property-read int|null $orders_count
 * @property-read int|null $socialite_count
 * @property-read int|null $video_comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivityExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivityToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInviteBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInviteUserExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInviteUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsPasswordSet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsSetNickname($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use CreatedAtBetween;

    const ACTIVE_YES = 1;
    const ACTIVE_NO = -1;

    const LOCK_YES = 1;
    const LOCK_NO = -1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'nick_name', 'email', 'password',
        'is_lock', 'is_active', 'role_id', 'role_expired_at',
        'invite_user_id', 'invite_balance', 'invite_user_expired_at',
        'activity_token','activity_expire',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 重载passport方法.
     *
     * @param $name
     *
     * @return mixed
     */
    public function findForPassport($name)
    {
        return self::whereEmail($name)->first();
    }

    /**
     * 所属角色.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * 获取随机呢称.
     *
     * @return string
     */
    public static function randomNickName()
    {
        return 'random.' . str_random(10);
    }

    /**
     * 该用户下的课程.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id', 'id');
    }

    /**
     * 用户加入（购买）的课程.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function joinCourses()
    {
        return $this->belongsToMany(Course::class, 'user_course', 'user_id', 'course_id')
            ->withPivot('created_at', 'charge');
    }

    /**
     * 用户购买的视频.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function buyVideos()
    {
        return $this->belongsToMany(Video::class, 'user_video', 'user_id', 'video_id')
            ->withPivot('created_at', 'charge');
    }

    /**
     * 用户的课程评论.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseComments()
    {
        return $this->hasMany(CourseComment::class, 'user_id');
    }

    /**
     * 用户的视频评论.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoComments()
    {
        return $this->hasMany(VideoComment::class, 'user_id');
    }

    /**
     * 方法：加入一个课程.
     *
     * @param Course $course
     */
    public function joinACourse(Course $course)
    {
        if (!$this->joinCourses()->whereId($course->id)->exists()) {
            $this->joinCourses()->attach($course->id, [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'charge' => $course->charge,
            ]);
        }
    }

    /**
     * 方法：购买一个视频.
     *
     * @param Video $video
     */
    public function buyAVideo(Video $video)
    {
        if (!$this->buyVideos()->whereId($video->id)->exists()) {
            $this->buyVideos()->attach($video->id, [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'charge' => $video->charge,
            ]);
        }
    }

    /**
     * 头像修饰器.
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getAvatarAttribute($avatar)
    {
        return $avatar ?: url(config('meedu.member.default_avatar'));
    }

    /**
     * 关联订单.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * 余额扣除.
     *
     * @param $money
     */
    public function credit1Dec($money)
    {
        $this->credit1 -= $money;
        $this->save();
    }

    /**
     * 判断用户是否可以观看指定的视频.
     *
     * @param Video $video
     *
     * @return bool
     */
    public function canSeeThisVideo(Video $video)
    {
        $course = $video->course;
        if ($course->charge == 0 || $video->charge == 0) {
            return true;
        }

        // 是否是会员
        if ($this->activeRole()) {
            return true;
        }

        // 是否加入课程
        $hasJoinCourse = $this->joinCourses()->whereId($video->course->id)->exists();
        if ($hasJoinCourse) {
            return true;
        }

        // 是否购买视频
        return $this->buyVideos()->whereId($video->id)->exists();
    }

    /**
     * 是否为有效会员.
     *
     * @return bool
     */
    public function activeRole()
    {
        return $this->role_id && time() < strtotime($this->role_expired_at);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function joinRoles()
    {
        return $this->hasMany(UserJoinRoleRecord::class, 'user_id');
    }

    /**
     * @param Role $role
     *
     * @throws \Throwable
     */
    public function buyRole(Role $role)
    {
        throw_if($this->role && $this->role->weight != $role->weight, new Exception('该账户已经存在会员记录'));

        if ($this->role) {
            $startDate = $this->role_expired_at;
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $this->role_expired_at)->addDays($role->expire_days);
        } else {
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addDays($role->expire_days);
        }

        $this->role_id = $role->id;
        $this->role_expired_at = $endDate;
        $this->save();

        $this->joinRoles()->save(new UserJoinRoleRecord([
            'role_id' => $this->role_id,
            'charge' => $role->charge,
            'started_at' => $startDate,
            'expired_at' => $endDate,
        ]));
    }

    /**
     * 今日注册用户数量.
     *
     * @return mixed
     */
    public static function todayRegisterCount()
    {
        return self::createdAtBetween(
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->addDays(1)->format('Y-m-d')
        )->count();
    }

    /**
     * 订单成功的处理.
     *
     * @param Order $order
     *
     * @return bool
     *
     * @throws \Throwable
     */
    public function handlerOrderSuccess(Order $order)
    {
        $goods = $order->goods;
        DB::beginTransaction();
        try {
            foreach ($goods as $goodsItem) {
                switch ($goodsItem->goods_type) {
                    case OrderGoods::GOODS_TYPE_COURSE:
                        $course = Course::find($goodsItem->goods_id);
                        $this->joinACourse($course);
                        break;
                    case OrderGoods::GOODS_TYPE_VIDEO:
                        $video = Video::find($goodsItem->goods_id);
                        $this->buyAVideo($video);
                        break;
                    case OrderGoods::GOODS_TYPE_ROLE:
                        $role = Role::find($goodsItem->goods_id);
                        $this->buyRole($role);
                        break;
                }
            }

            DB::commit();

            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            exception_record($exception);

            return false;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialite()
    {
        return $this->hasMany(Socialite::class, 'user_id');
    }

    /**
     * @param $name
     * @param $avatar
     *
     * @return mixed
     */
    public static function createUser($name, $avatar)
    {
        return User::create([
            'avatar' => $avatar ?: config('meedu.member.default_avatar'),
            'nick_name' => $name ?? '',
            'mobile' => random_int(2, 9) . random_int(1000, 9999) . random_int(1000, 9999),
            'password' => Hash::make(Str::random(6)),
            'is_lock' => config('meedu.member.is_lock_default'),
            'is_active' => config('meedu.member.is_active_default'),
            'role_id' => 0,
            'role_expired_at' => Carbon::now(),
        ]);
    }

    /**
     * 绑定Socialite.
     *
     * @param $app
     * @param $socialite
     *
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function bindSocialite($app, $socialite)
    {
        return $this->socialite()->save(new Socialite([
            'app' => $app,
            'app_user_id' => $socialite->getId(),
            'data' => serialize($socialite),
        ]));
    }

    /**
     * 判断是否绑定手机.
     *
     * @return bool
     */
    public function isBindMobile()
    {
        return substr($this->mobile, 0, 1) == 1;
    }
}
