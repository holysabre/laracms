<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name','description','status','type','index_template','detail_template'
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function getOptions(){
        $modules = $this->query()->select('id','name')
            ->where('status','=','1')
            ->get();
        $options = [];
        foreach ($modules as $module){
            $options[$module->id] = $module->name;
        }
        return $options;
    }
}
