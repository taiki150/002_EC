<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'admin_id',
        'name',
        'stock',
        'price',
        'img_path',
        'comment',
    ];

    // 商品は複数のカートアイテムに入る可能性がある
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // 商品はカテゴリに属する
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 商品は管理者によって登録される
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
