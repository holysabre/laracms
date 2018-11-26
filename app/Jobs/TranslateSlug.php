<?php

namespace App\Jobs;

use App\Handlers\TranslateHandler;
//use App\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $query,$id,$tableName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($className,$id,$tableName)
    {
        $this->id = $id;
        $this->tableName = $tableName;
        $className = 'App\\Models\\'.$className;
        $obj = $className::find($this->id);
        $this->query = $obj->title;
        logger('===TranslateLog==='.print_r($this->query,1));

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $slug = app(TranslateHandler::class)->translate($this->query);
        DB::table($this->tableName)->where('id',$this->id)->update(['slug'=>$slug]);
    }
}