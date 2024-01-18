<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Admin
 *
 * @property int $nik_admin
 * @property int $id_user
 * @property string $nama_admin
 * @property int $no_telp
 * @property string $email
 * @method static \Database\Factories\AdminFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereNamaAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereNikAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereNoTelp($value)
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Admin extends Model
{
    use HasFactory;
    protected $table = "admin";
    protected $primaryKey = "nik_admin";
    protected $fillable = [
        'nik_admin',
        'nama_admin',
        'username',
        'no_telp',
        'email'
    ];
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // public function berita(): HasMany
    // {
    //     return $this->hasMany(Berita::class, 'nik_admin');
    // }
}
