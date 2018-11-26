<?php

namespace App\Models;

/**
 * App\Models\Page
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $fillable = [
        'category_id','title','content','excerpt','slug','order','status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    public function link($params = [])
//    {
//        $params = array_merge([$this->id], $params);
//        return route('pages.show', $params);
//    }
}
