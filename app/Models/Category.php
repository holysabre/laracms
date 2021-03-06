<?php

namespace App\Models;

use App\Models\Traits\CategoryTreeHelper;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CategoryTreeHelper,AdminBuilder,ModelTree;

    protected $fillable = [
        'parent_id','name','order','alias','icon','image','link','seo_title','seo_keywords','seo_description','index_template','detail_template','status'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTitleColumn('name');
    }

    public function page()
    {
        return $this->hasMany(Page::class);
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getCategoriesByParentId($parent_id)
    {
        $categories = $this->query()->where('parent_id','=',$parent_id)->get();
        return $categories;
    }

}
