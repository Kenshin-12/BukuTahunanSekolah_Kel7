<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Pemain
 *
 * @property int $nisn_pemain
 * @property int $id_user
 * @property string $nama_pemain
 * @property string $tanggal_lahir
 * @property string $tempat_lahir
 * @property string $email
 * @property int $no_telp
 * @property string $alamat
 * @property string $posisi
 * @property string $kategori_umur
 * @property string|null $deskripsi_pemain
 * @property int $no_punggung
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PemainFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereDeskripsiPemain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereKategoriUmur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNamaPemain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNisnPemain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNoPunggung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain wherePosisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereTempatLahir($value)
 * @mixin \Eloquent
 */
class Pemain extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $primaryKey = "nisn_siswa";
    protected $fillable = [
        "nisn_siswa",
        "nama_siswa",
        "alamat",
        "tempat_lahir",
        "tanggal_lahir",
        "deskripsi_siswa",
        "no_telp",
        "email"
    ];
    public $timestamps = false;

    /**
     * Mengembalikan pemain ke user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // public function tim(): BelongsTo
    // {
    //     return $this->belongsTo(Tim::class, 'id_tim');
    // }

    // /**
    //  * Undocumented function
    //  *
    //  * @return HasMany
    //  */
    // public function presensi(): HasMany
    // {
    //     return $this->hasMany(Presensi_detail::class, "id_presensi_detail");
    // }
}
