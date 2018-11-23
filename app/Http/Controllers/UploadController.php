<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;

class UploadController extends Controller
{
    /**
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     * 公共的图片上传
     */
    public function editorUpload(Request $request, ImageUploadHandler $uploader)
    {
        $folder = $request->folder ? : 'default';
        $prefix = $request->prefix ? : 'default';
        $max_width = $request->max_width ? : false;
        $return = [];
        $files = $request->file('upload_file');
        if(!empty($files)){
            if (count($files) > 25) {
                return response()->json(['ResultData' => 6, 'info' => '最多可以上传25张图片']);
            }
            foreach ($files as $key=>$file){
                $result = $uploader->save($file, $folder, $prefix, $max_width);
                $number = '第'.($key+1).'张图片';
                if($result['status']){
                    $return[] = ['status'=>1,'msg'=>$number.$result['msg'],'url'=>$result['url']];
                }else{
                    $return[] = ['status'=>0,'msg'=>$number.$result['msg']];
                }
            }
        }else{
            return response()->json([
                'status' => 0,
                'msg' => '请选择文件'
            ]);
        }
        return $return;
    }
    
}
