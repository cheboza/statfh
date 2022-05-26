<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Следует ли обрабатывать временные метки модели.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Соединение с БД, которое должна использовать модель.
     *
     * @var string
     */
    protected $connection = 'fh';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table='shop_order';

    public function orderGoods()
    {
        return $this->hasMany(OrderGoods::class,  'order_id');
    }
}
