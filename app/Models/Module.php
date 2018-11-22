<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name','description','status','type'
    ];

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
