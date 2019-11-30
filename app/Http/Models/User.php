<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\User
 *
 * @property int $id
 * @property string $full_name
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_rol
 * @property int $fk_id_carrier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Advisory[] $advisory
 * @property-read int|null $advisory_count
 * @property-read \App\Http\Models\Carrier $carrier
 * @property-read \App\Http\Models\Contact $contact
 * @property-read \App\Http\Models\Rol $rol
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereFkIdCarrier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereFkIdRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $table = "user";
    protected $fillable = [
        "full_name",
        "username",
        "password",
        "fk_id_rol",
        "fk_id_carrier"
    ];

    public function rol()
    {
        return $this->belongsTo(
            Rol::class,
            'fk_id_rol',
            'id'
        );
    }

    public function carrier()
    {
        return $this->belongsTo(
            Carrier::class,
            'fk_id_carrier',
            'id'
        );
    }

    public function advisories()
    {
        return $this->hasMany(
            Advisory::class,
            'fk_id_user',
            'id'
        );
    }

    public function contact()
    {
        return $this->hasOne(
            Contact::class,
            'fk_id_user',
            'id'
        );
    }

}
