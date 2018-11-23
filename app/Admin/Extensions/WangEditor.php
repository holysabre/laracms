<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/23
 * Time: 9:46 AM
 */
namespace App\Admin\Extensions;
use Encore\Admin\Form\Field;
class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';
    protected static $css = [
        '/vendor/wangEditor-3.1.1/release/wangEditor.min.css',
    ];
    protected static $js = [
        '/vendor/wangEditor-3.1.1/release/wangEditor.min.js',
    ];
    public function render()
    {
        $name = $this->formatName($this->column);
        $this->script = <<<EOT
var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.uploadFileName = 'upload_file[]';
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('input[name="_token"]').val()
}
editor.customConfig.zIndex = 0;
editor.customConfig.uploadImgServer = '/upload/editor';
editor.customConfig.onchange = function (html) {
    $('input[name=$name]').val(html);
}
editor.customConfig.uploadImgHooks = {
    customInsert: function (insertImg, result, editor) {
        if (typeof(result.length) != "undefined") {
            for (var i = 0; i <= result.length - 1; i++) {
                var j = i;
                var url = result[i].url;
                insertImg(url);
            }
            toastr.success(result[j]['info']);
        }
        if(result['status'] == 0){
            toastr.error(result['msg']);
        }
    }
}
editor.create();
// var editor = new wangEditor('{$this->id}');
//     editor.create();
EOT;
        return parent::render();
    }
}