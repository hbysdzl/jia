<?php
namespace Admin\Model;
use Think\Model;
use Think\Verify;

class LoginModel extends Model{
    protected $tableName="admin";
    //自动验证
    public  $login_validate=array(
        array('username','require','用户名不能为空',1,'regex'),
        array('password','require','请输入密码',1,'regex'),
        array('code','require','请输入验证码',1,'regex'),
        array('code','che_code','验证码错误',1,'callback'),
    );
    
    //验证用户提交的验证码
    protected function che_code($code){
        $codeModel=new Verify();
        return $codeModel->check($code);
    }
    
    public function login(){
        //获取用户提交的用户名和密码
        $username=$this->username;
        $password=$this->password;
        //查核数据库
        $user=$this->where(array('username'=>array('eq',$username)))->find();
        if ($user){//判断用户是否存在
            if ($user['is_use']==1 || $user['id']==1){//超级管理员不可禁用
                    if($user['password']==md5(C('MD5_PSW').$password)){
                            //成功
                            session('admin_id',$user['id']);
                            session('adminname',$user['username']);
                            $data['lastdate']=time();
                            $data['lastip']=$_SERVER['REMOTE_ADDR'];
                            $this->where(array('username'=>array('eq',$username)))->setField($data);//更新最后登陆时间及IP
                            $this->where(array('username'=>array('eq',$username)))->setInc('count');//记录登陆次数
                            return true;
                    }else {
                        $this->error="密码错误";
                    }
            }else {
                $this->error="账号已禁用";
                return false;
            }
        }else {
            $this->error="账号不存在";
            return false;
        }
        
    }
    
    //动态验证
   public $rules = array(    
                array('username','require','用户名不能为空',1,'regex',3), 
                array('username','','该账号已注册！',0,'unique',3), 
                array('password','require','密码不能为空!',1,'regex',3),
                array('passwords','require','请再次输入密码!',1,'regex',3),
                array('passwords','password','两次输入密码不一致!',1,'confirm',3), 
     );
   
   //添加之前
   protected function _before_insert(&$data, $options){
       $data['password']=md5(C('MD5_PSW').$data['password']);
       $data['datetime']=time(); 
   }
   
   //修改之前
   /*protected function _before_update(&$data, $options){
       $data['password']=md5(C('MD5_PSW').$data['password']);
   }*/
   
}