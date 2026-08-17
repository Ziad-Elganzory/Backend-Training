<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $order_id
 * @property string $email
 * @property float $total
 */
class Order extends Model
{
    protected $fillable = [
        "order_id",
        "email",
        "total"
    ];

    protected $casts = [
        "total" => "decimal:2"
    ];
}
