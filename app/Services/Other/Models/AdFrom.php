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
 * App\Services\Other\Models\AdFrom
 *
 * @property int $id
 * @property string $from_name
 * @property string $from_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Other\Models\AdFromNumber[] $numbers
 * @property-read int|null $numbers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom whereFromKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom whereFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\AdFrom whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdFrom extends Model
{
    protected $table = 'ad_from';

    protected $fillable = [
        'from_name', 'from_key',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function numbers()
    {
        return $this->hasMany(AdFromNumber::class, 'from_id');
    }
}
