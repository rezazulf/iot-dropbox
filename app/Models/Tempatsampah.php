<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempatsampah extends Model
{
     use HasFactory;
     public $incrementing = false;
     protected $table = 'tempat_sampah';
    protected $primaryKey = 'id_tempat_sampah';

    protected $fillable = [
        'id_user',
        'alamat',
        'kota',
        'keterangan',
        'latitude',
        'longitude',
        'foto_tempatsampah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}