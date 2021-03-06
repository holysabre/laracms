<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'category_id','title','content','excerpt','picture','picture_set','author','source',
        'click_count','slug','order','status','attribute','seo_title','seo_keywords','seo_description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setPictureSetAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['picture_set'] = json_encode($pictures);
        }
    }

    public function getPictureSetAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    public function setAttributeAttribute($attribute)
    {
        if(is_array($attribute)){
            $this->attributes['attribute'] = implode(',',$attribute);
        }
    }

    public function getAttributeAttribute($attribute)
    {
        return explode(',',$attribute);
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order)
        {
            default:
                //最新
                $query->recent();
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('category');
    }

    public function scopeRecent($query)
    {
        return $query->orderby('created_at','desc');
    }
}
