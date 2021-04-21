<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Member\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Member\Models\Socialite
 *
 * @property int $id
 * @property int $user_id
 * @property string $app
 * @property string $app_user_id
 * @property string $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereAppUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Socialite whereUserId($value)
 * @mixin \Eloquent
 */
class Socialite extends Model
{
    protected $table = 'socialite';

    protected $fillable = [
        'user_id', 'app', 'app_user_id', 'data',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
