<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;
    protected $casts = [
    'worked_at' => 'date',
    ];
    protected $fillable = [
        'category_id' ,
        'user_id' ,
        'content' ,
        'worked_at' ,
        'image_path' ,
        'keywords' ,
        'work_type'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
