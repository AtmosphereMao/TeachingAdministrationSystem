<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Other\Models\Announcement
 *
 * @property int $id
 * @property string $title 公告标题
 * @property int $admin_id
 * @property string $announcement
 * @property int $view_times 浏览次数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereAnnouncement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Announcement whereViewTimes($value)
 * @mixin \Eloquent
 */
class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'admin_id', 'announcement', 'created_at',
        'view_times', 'title',
    ];
}
