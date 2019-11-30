<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Advisory
 *
 * @property int $id
 * @property string $name
 * @property int $fk_id_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Day[] $days
 * @property-read int|null $days_count
 * @property-read \App\Http\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Advisory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Advisory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Advisory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Advisory whereFkIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Advisory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Advisory whereName($value)
 * @mixin \Eloquent
 */
class Advisory extends Model
{
    protected $table = "advisory";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'fk_id_user',
            'id'
        );
    }

    public function days()
    {
        return $this->belongsToMany(
            Day::class,
            'advisory_has_day',
            'fk_id_advisory',
            'fk_id_day'
        )->withPivot(['start_hour', 'end_hour']);
    }


}
