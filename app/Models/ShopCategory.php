<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;

    public function getId(): int
    {
        return intval($this->id);
    }

    /**
     * get category name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * set category name
     *
     * @param  string  $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }



    /**
     * get shop id
     *
     * @return int
     */
    public function getShopId(): int
    {
        return $this->shop_id;
    }

    /**
     * set  user shop id
     *
     * @param  string  $shop_id
     * @return self
     */
    public function setShopId(string $shop_id): self
    {
        $this->shop_id = $shop_id;

        return $this;
    }
    /**
     * get shopCategory id
     *
     * @return int
     */
    public function getShopCategoryId(): int
    {
        return $this->shop_category_id;
    }

    /**
     * set shop category id
     *
     * @param  string  $shop_id
     * @return self
     */
    public function setShopCategoryId($shop_category_id): self
    {
        $this->shop_category_id = $shop_category_id;

        return $this;
    }


    public function parent()
    {
        return $this->belongsTo(static::class, 'shop_category_id');
    }
    public function children()
    {
        return $this->hasMany(static::class, 'shop_category_id');
    }
    public function subs()
    {
        return $this->children()->with(['subs']);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function scopeParentOnly($query){
        return $query->where('shop_category_id', null);
    }


}
