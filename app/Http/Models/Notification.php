<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Notification
 *
 * @property int $id
 * @property string $content
 * @property int $fk_id_advisory_has_day
 * @property-read \App\Http\Models\AdvisoryHasDay $grop
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Notification whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Notification whereFkIdAdvisoryHasDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Notification whereId($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{

    protected $table = "notification";

    public function grop()
    {
        return $this->belongsTo(
            AdvisoryHasDay::class,
            'fk_id_advisory_has_day',
            'id'
        );
    }
}
