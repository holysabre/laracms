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

}
