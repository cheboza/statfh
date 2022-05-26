<?php

namespace App\Model;

class Goods extends DiafanModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table='shop';

    public function images()
    {
        return $this->hasMany(Image::class,  'element_id')->where([
            ['trash', '=', '0'],
            ['module_name', '=', 'shop'],
            ['element_type', '=', 'element'],
        ])->orderBy('sort', 'ASC');
    }
}
