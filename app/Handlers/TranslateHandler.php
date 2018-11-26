<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/8
 * Time: 5:06 PM
 */

namespace App\Handlers;
use GuzzleHttp\Client;
use Overtrue\Pinyin\pinyin;
use Illuminate\Support\Facades\Log;

class TranslateHandler
{

    private $api;
    private $appid;
    private $secret;
    private $from;
    private $to;

    public function __construct()
    {
        $this->api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $this->appid = config('services.baidu_translate.appid');
        $this->secret = config('services.baidu_translate.secret');
        $this->from = 'zh';
        $this->to = 'en';
    }

    //翻译入口
    function translate($query)
    {
        if(empty($this->appid) || empty($this->secret)){
            return $this->pinyin($query);
        }

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->api,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $salt = time();
        $args = array(
            'q' => $query,
            'appid' => $this->appid,
            'salt' => $salt,
            'from' => $this->from,
            'to' => $this->to,
            'sign' => md5($this->appid . $query . $salt . $this->secret),
        );
        $args = http_build_query($args);
        $response = $client->get($this->api.$args);
        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK
        $body = $response->getBody();

        logger('===TranslateLog==='.print_r(json_decode($body,true),1));

        if($code == 200 && $reason == 'OK'){
            $body_arr = json_decode($body,true);
//            dump($body_arr);
            $trans_result = reset($body_arr['trans_result']);
            return $trans_result['dst'];
        }else{
            //出错
        }
    }

    public function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}