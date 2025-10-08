<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model{
     use HasFactory;
          protected $fillable = [
               'nama_pelanggan',
               'jumlah_pelanggan',
               'restaurant_table_id',
          ];
                                       
          public function orders()
          {
               return $this->hasMany(Order::class);
          }
                                                      
          public function restaurantTable()
          {
          return $this->belongsTo(RestaurantTable::class);
          }
}
