<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Day
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Day query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Day whereName($value)
 * @mixin \Eloquent
 */
class Day extends Model
{
    protected $table = "day";

    public $timestamps = false;
}
