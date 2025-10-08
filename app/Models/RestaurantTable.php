<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
     use HasFactory;
     
     protected $fillable = [
          'nomor_meja',
          'status',
     ];
     
     public function customers()
     {
          return $this->hasMany(Customer::class);
     }
}
