<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Rol
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Rol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Rol whereName($value)
 * @mixin \Eloquent
 */
class Rol extends Model
{

    protected $table = "rol";
    public $timestamps = false;
}
