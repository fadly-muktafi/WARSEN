<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;
     
     protected $fillable = [
          'customer_id',
          'restaurant_table_id',
          'user_id',
          'status',
          'total_amount',
          'bayar',
          'kembalian',
     ];
     
     public function restaurantTable()
     {
          return $this->belongsTo(RestaurantTable::class);
     }

     public function customer()
     {
          return $this->belongsTo(Customer::class);
     }
     
     public function user()
     {
          return $this->belongsTo(User::class);
     }
     
     public function orderDetails()
     {
          return $this->hasMany(OrderDetail::class);
     }
}
