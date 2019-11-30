<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Carrier
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Carrier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Carrier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Carrier query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Carrier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Carrier whereName($value)
 * @mixin \Eloquent
 */
class Carrier extends Model
{
    protected $table = "carrier";
    public $timestamps = false;
}
