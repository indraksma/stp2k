<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kelass';

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
