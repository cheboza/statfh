<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    protected $table='shop_category';

    public static function getTreeCategories()
    {
        $cats = self::orderBy('sort')->get();
        return self::buildTree($cats);
    }

    private static function buildTree($cats, $idParent = 0)
    {
        $returnCats = [];
        foreach($cats as $cat)
        {
            if($cat["parent_id"] == $idParent)
            {
                $cat['child'] = self::buildTree($cats, $cat["id"]);
                $returnCats[] = $cat;
            }
        }

        return $returnCats;
    }
}
