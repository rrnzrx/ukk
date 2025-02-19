<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students'; // Explicitly define the table name (optional if table name follows Laravel conventions)

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Explicitly define the primary key (optional if primary key is 'id')

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nis',       // NIS (Nomor Induk Siswa)
        'nama',      // Nama Lengkap
        'kelas',     // Kelas
        'jenis_kelamin', // Jenis Kelamin
        'alamat',    // Alamat
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Set to false if your table doesn't have `created_at` and `updated_at` columns
}