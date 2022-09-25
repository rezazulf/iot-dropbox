<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengosongansampah extends Model
{
    use HasFactory;
    protected $table = 'pengosongan_sampah';
    protected $primaryKey = 'id_pengosongan';

    protected $fillable = [
        'id_tempat_sampah',
        'id_user',
        'nama_user',
    ];
}