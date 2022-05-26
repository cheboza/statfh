<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DiafanModel extends Model
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
    protected $connection;

    /**
     * For testing aim, take out connection variable to construct
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->connection = env('DB_FH_CONNECTION');
        parent::__construct($attributes);
    }
}
