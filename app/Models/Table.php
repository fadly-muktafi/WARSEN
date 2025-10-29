<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_meja',
        'status',
    ];

    // Jika Anda ingin mendefinisikan relasi ke model Order, Anda bisa menambahkannya di sini
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}