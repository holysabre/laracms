<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseAuthController
{

    public function getLogin()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only([$this->username(), 'password','captcha']);
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($credentials, [
            'captcha'          => 'required|captcha',
            $this->username()   => 'required',
            'password'          => 'required',
        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);

        //需要删除captcha字段 不然回去查数据库 会报错
        unset($credentials['captcha']);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if ($this->guard()->attempt($credentials)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

}
