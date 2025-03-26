<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'category_id', 'name', 'slug', 'product_price', 'sale_price', 'tags', 'product_weight',
        'new_arrivals', 'featured', 'short_description', 'long_description',
        'image_1', 'image_2', 'image_3', 'image_4', 'status', 'meta_title',
        'meta_description', 'focus_keywords'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
