<?php
namespace Admin\Model;
use Think\Model;

class RoleModel extends Model{
        //分配权限入库   
    public function addAuth($role_id,$auth_ids_arr){
        
        $auth_ids=implode(',',$auth_ids_arr);//将数组转换为字符串
        
        //获取对应的权限控制器和方法
        $auth_name=M('auth')->select($auth_ids);
        $role_ac=array();
        foreach ($auth_name as $v){
            if($v['auth_c']=='' || $v['auth_a']==''){
                continue;
            }
            $role_ac[]=$v['auth_c'].'-'.$v['auth_a'];
        }

        //将获得的数组转为字符串
        $role_ac_str=join(',',$role_ac);
        
        $data['role_id']=$role_id;
        $data['role_auth_ids']=$auth_ids;
        $data['role_auth_ac']=$role_ac_str;
        $this->save($data);
        return true;
    }
}