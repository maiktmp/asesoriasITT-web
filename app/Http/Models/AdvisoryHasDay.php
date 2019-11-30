<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\AdvisoryHasDay
 *
 * @property int $id
 * @property string $name
 * @property string $start_hour
 * @property string $end_hour
 * @property int $fk_id_advisory
 * @property int $fk_id_day
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay whereEndHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay whereFkIdAdvisory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay whereFkIdDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdvisoryHasDay whereStartHour($value)
 * @mixin \Eloquent
 */
class AdvisoryHasDay extends Model
{
    protected $table = "advisory_has_day";
}
