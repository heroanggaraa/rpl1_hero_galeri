<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use HasFactory, SoftDeletes;
        protected $fillable = [
            'judul',
            'deskripsi',
            'foto',
            'tanggal',
            'id_user',
    ];
}