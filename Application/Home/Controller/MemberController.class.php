<?php

/*
***前台会员管理注册，登录控制器
***
*/
namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class MemberController extends Controller{

		//会员登录
		public function login(){

			if (IS_POST) {
				# code...
			}else{
				$this->display();
			}
		}

		//会员注册
		public function registr(){

			if(IS_POST){
				//先验证验证码
				$data=I('post.');
				$MemberMdoel=M('reguser');
				if(!$this->checkCode($data['verify'])){
					$this->ajaxReturn(array('status'=>'0','error'=>'验证码错误'));
					die();
				}
				
				$telModel=M('regtel');
				$result=$telModel->field('tel,cap,sendtime,limt')->where('tel='.$data['mobile'])->find();
				if ($data['cap']!=$result['cap'] || $data['mobile']!=$result['tel']) {
					$this->ajaxReturn(array('status'=>'1','error'=>'短信验证码错误'));
					die();
				}

				$time=$result['sendtime']+$result['limt'];
				if ($time<time()) {
					$this->ajaxReturn(array('status'=>'2','error'=>'验证码已过期，请重新发送！'));
					die();
				}

				$data['password']=md5(C('MD5_PSW').$data['password']);
				$data['time']=time();
				$data['regip']=get_client_ip();

				if($MemberMdoel->add($data)) {
					$this->ajaxReturn(array('status'=>'-1','ok'=>'恭喜您注册成功！'));
					die();
				}
				
				$this->ajaxReturn(array('status'=>'3','error'=>$MemberMdoel->getError()));
				die();
			}else{
				$this->display();
			}
		}

	//ajax验证手机号
	public function checkTel(){
		$phone=I('post.mobile');
		$MemberMdoel=M('reguser');
		$tel=$MemberMdoel->where('mobile='.$phone)->find();
		if ($tel) {
			$this->ajaxReturn(array('status'=>'0','error'=>'该手机已注册，请更换手机号码'));
			die();
		}
	}

	//短信发送调用
	public  function send(){
		$tel=I('post.mobile');
		$tep='4284';
		$ranCode=rand(111111,999999);
		$res=$this->send_sms($tep,$tel,$ranCode);
		
		if(!$res["result"]){
			//发送失败
			$this->ajaxReturn(array('status'=>'0','error'=>'发送失败，请稍后重试！'));
			die();
		}

		//发送成功，先判断是否已存在 再保存到数据库中并指定有效期
		$telModel=M('regtel');
		$result=$telModel->where('tel='.$tel)->find();
		if(!$result){
			$data['tel']=$tel;
			$data['cap']=$ranCode;
			$data['sendtime']=time();
			$data['ip']=get_client_ip();
			$data['limt']=60;
			$telModel->add($data);
		}else{
			//存在则更新
			$data['cap']=$ranCode;
			$data['sendtime']=time();
			$data['ip']=get_client_ip();
			$data['id']=$result['id'];
			$telModel->save($data);
			$telModel->where('id='.$result['id'])->setInc('count');
		}
		
		
		$this->ajaxReturn(array('status'=>'1','error'=>'发送成功,请注意查收'));		
    }

		
	//获取验证码
	public function verify(){
		$code=new Verify(C('CODE_ON'));
		$result=$code->entry();
		return $result;
	}

	//验证码的验证
	protected function checkCode($value){
		$code=new Verify();
		return $code->check($value);
	}

		
	//短信发送接口封装
	protected function send_sms($temp,$phone,$cap) {
        $url = 'http://www.sendcloud.net/smsapi/send';

        $param = array(
            'smsUser' => 'jiajoo_jiazw', //调用接口发信的账号，同时有对应的key
            'templateId' => "$temp",
            'msgType' => '0',
            'phone' => "$phone",
            'vars' => "{'%cap%':'$cap'}"
        );
		
        //循环数组参数转换为url格式字符串
        $sParamStr = "";
        ksort($param);
        foreach ($param as $sKey => $sValue) {
            $sParamStr .= $sKey . '=' . $sValue . '&';
        }

        //去除最后一个&并加密
        $sParamStr = trim($sParamStr, '&');     
        $smskey = 'MH4kyjGl3Gjj7uCJjJNpWmAyVZIPVzin';
        $sSignature = md5($smskey."&".$sParamStr."&".$smskey);


        $param = array(
            'smsUser' => 'jiajoo_jiazw', 
            'templateId' => "$temp",
            'msgType' => '0',
            'phone' => "$phone",
            'vars' => "{'%cap%':'$cap'}",
            'signature' => $sSignature
        );

        $data = http_build_query($param);   //将数组参数生成url格式字符串
        //echo $data;

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type:application/x-www-form-urlencoded',
                'content' => $data

        ));
        $context  = stream_context_create($options);
        $result = file_get_contents($url, FILE_TEXT, $context);
		
		
        return json_decode($result,true);
	}

	
}