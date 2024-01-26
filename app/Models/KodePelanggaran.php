<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodePelanggaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jenis_pelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }
}
