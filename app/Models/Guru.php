<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Pelatih
 *
 * @property int $nik_pelatih
 * @property int $id_user
 * @property string $nama_pelatih
 * @property string|null $deskripsi_pelatih
 * @property string $alamat
 * @property int $no_telp
 * @property string $email
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PelatihFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereDeskripsiPelatih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereNamaPelatih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereNikPelatih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelatih whereTempatLahir($value)
 * @mixin \Eloquent
 */
class Pelatih extends Model
{
    use HasFactory;
    protected $table = "guru";
    protected $primaryKey = "nik_guru";
    protected $fillable = [
        'nama_guru',
        'nik_guru',
        'alamat',
        'deskripsi_guru',
        'email',
        'no_telp',
        'tanggal_lahir',
        'tempat_lahir'
    ];

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public $timestamps = false;

    // public function presensi()
    // {
    //     return $this->hasMany(Presensi_detail::class, "id_presensi_detail");
    // }

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user");
    }

    // public function tim()
    // {
    //     return $this->hasMany(Tim::class, "nik_pelatih");
    // }
}
