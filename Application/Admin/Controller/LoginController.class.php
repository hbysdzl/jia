<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
    
    public function login(){
       
       $this->display();
    }
   
    //管理员登陆
    public function ajaxLogin(){
       
        if(IS_POST){
            $adminModel=D('Login');
            if($adminModel->field('username,password,code')->validate($adminModel->login_validate)->create(I('post'),3)){
                if(true===$adminModel->login()){
                    echo json_encode(array('ok'=>1));
                    die();
                 }
            }
            echo json_encode(array('ok'=>0,'error'=>$adminModel->getError()));
        }
        
    }
    //生成验证码
    public function code(){
        $config =	array( 
            'fontSize'  =>  28,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  55,               // 验证码图片高度
            'imageW'    =>  280,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        );
        $codeModel=new \Think\Verify($config);
        return $codeModel->entry();
    }
}