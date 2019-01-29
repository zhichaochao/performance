<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author yuan1994 <tianpian0805@gmail.com>
 * @link http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

//------------------------
// 角色控制器
//-------------------------

namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Exception;
use think\Db;
use think\Loader;
use think\Session;
use think\Config;

class AdminRole extends Controller
{
    use \app\admin\traits\controller\Controller;

//    protected static $blacklist = ['recyclebin', 'delete', 'recycle', 'deleteforever', 'clear'];

    // protected function filter(&$map)
    // {
    //     if ($this->request->param('name')) {
    //         $map['name'] = ["like", "%" . $this->request->param('name') . "%"];
    //     }
    // }

    /**
     * 用户列表
     */
    // public function user()
    // {
    //     $role_id = $this->request->param('id/d');
    //     if ($this->request->isPost()) {
    //         // 提交
    //         if (!$role_id) {
    //             return ajax_return_adv_error("缺少必要参数");
    //         }

    //         $db_role_user = Db::name("AdminRoleUser");
    //         //删除之前的角色绑定
    //         $db_role_user->where("role_id", $role_id)->delete();
    //         //写入新的角色绑定
    //         $data = $this->request->post();
    //         if (isset($data['user_id']) && !empty($data['user_id']) && is_array($data['user_id'])) {
    //             $insert_all = [];
    //             foreach ($data['user_id'] as $v) {
    //                 $insert_all[] = [
    //                     "role_id" => $role_id,
    //                     "user_id" => intval($v),
    //                 ];
    //             }
    //             $db_role_user->insertAll($insert_all);
    //         }
    //         return ajax_return_adv("分配角色成功", '');
    //     } else {
    //         // 编辑页
    //         if (!$role_id) {
    //             throw new Exception("缺少必要参数");
    //         }
    //         // 读取系统的用户列表
    //         $list_user = Db::name("AdminUser")->field('id,account,realname')->where('status=1 AND id > 1')->select();

    //         // 已授权权限
    //         $list_role_user = Db::name("AdminRoleUser")->where("role_id", $role_id)->select();
    //         $checks = filter_value($list_role_user, "user_id", true);

    //         $this->view->assign('list', $list_user);
    //         $this->view->assign('checks', $checks);

    //         return $this->view->fetch();
    //     }
    // }

    /**
     * 授权
     * @return mixed
     */
    // public function access()
    // {
    //     $role_id = $this->request->param('id/d');
    //     if ($this->request->isPost()) {
    //         if (!$role_id) {
    //             return ajax_return_adv_error("缺少必要参数");
    //         }

    //         if (true !== $error = Loader::model('AdminAccess', 'logic')->insertAccess($role_id, $this->request->post())) {
    //             return ajax_return_adv_error($error);
    //         }
    //         return ajax_return_adv("权限分配成功", '');
    //     } else {
    //         if (!$role_id) {
    //             throw new Exception("缺少必要参数");
    //         }

    //         $tree = Loader::model('AdminRole', 'logic')->getAccessTree($role_id);
    //         $this->view->assign("tree", json_encode($tree));

    //         return $this->view->fetch();
    //     }
    // }
     //团队绩效页面
      public function teamperformance()
      {
         return $this->view->fetch();
      }
      //所有成员绩效页面
      public function ownerperformance()
      {
         return $this->view->fetch();
      }
      // 个人绩效
      public function personalper()
      {
             $this->checkUser();
            // 用户ID
            defined('UID') or define('UID', Session::get(Config::get('rbac.user_auth_key')));
            $user_id=UID; 
            $where =  "user_id='$user_id' AND score!='' ";
            $result=Db::name('PersonalPerform')->where($where)->order('per_id', 'asc')->select();
            if($result){
                foreach ($result as $value) {
                    $user_id=$value['user_id'];
                    $res=Db::name('AdminUser')->where('id',$user_id)->find();
                    $data['personalper'][]=array(
                        'per_id'        =>$value['per_id'],      //序号
                        'image'         =>$res['image'],           //头像
                        'realname'      =>$res['realname'],     //姓名
                        'month'         =>$value['month'],     //月份
                        'score'         =>$value['score'],    //平均分
                        'assess_time'   =>date("Y/m/d H:i:s",$value['assess_time'])  //考核日期
                        );
                }
                return  ajax_return_adv(array('success'=>'success','listpersonalper'=> $data['personalper']));
            }else{

                return  ajax_return_adv_error("没有数据");
            }
      }
       //个人绩效导出
      public function  personalperexport()
      {
            $this->checkUser();
             // 用户ID
            defined('UID') or define('UID', Session::get(Config::get('rbac.user_auth_key')));
            $user_id=UID; 
            $where =  "user_id='$user_id' AND score!='' ";

            $result=Db::name('PersonalPerform')->where($where)->order('per_id', 'asc')->select();
            $header = ['序号', '姓名', '月份', '平均分', '考核日期'];
            foreach ($result as $value) {
                    $user_id=$value['user_id'];
                    $res=Db::name('AdminUser')->where('id',$user_id)->find();
                    $data['personalper'][]=array(
                        'per_id'        =>$value['per_id'],      //序号
                        'realname'      =>$res['realname'],     //姓名
                        'month'         =>$value['month'],     //月份
                        'score'         =>$value['score'],    //平均分
                        'assess_time'   =>date("Y/m/d H:i:s",$value['assess_time'])  //考核日期
                        );
                }
            if ($error = \Excel::export($header, $data['personalper'], $res['realname'].date('Y-m-d'), '2007')) {
                throw new Exception($error);
            }
      }

      //团队绩效
      public function teamper()
      {
            $this->checkUser();
            if(!empty($this->request->post('month'))){
            $month= $this->request->post('month');
            $result=Db::name("TeamPerform")->where('month',$month)->order('score', 'desc')->select();
            }else{

            $month=  Db::name("TeamPerform")->where("score!=''")->max('month');
            $result=Db::name("TeamPerform")->where('month',$month)->order('score', 'desc')->select();
            }
            if($result){
                foreach ($result as $value) {
                    $department_id=$value['department_id'];
                    $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                    $department=$departm['name'];
                    $data['teamper'][]=array(
                        'tm_id'         =>$value['tm_id'],    
                        'department'    =>$department,
                        'department_id' =>$value['department_id'], 
                        'month'         =>$value['month'],        
                        'score'         =>$value['score']
                        );
                }
                // print_r( $data['teamper']);exit;
                return  ajax_return_adv(array('success'=>'success','listteamper'=> $data['teamper']));
            }else{
                return  ajax_return_adv_error("没有数据");
            }
      }

       //团队绩效导出
      public function  teamperexport()
      {
        $this->checkUser();

        if(!empty($this->request->post('month'))){

            $month= $this->request->post('month');
            $result=Db::name("TeamPerform")->where('month',$month)->order('score', 'desc')->select();
            }else{

            $month=  Db::name("TeamPerform")->where("score!=''")->max('month');
            $result=Db::name("TeamPerform")->where('month',$month)->order('score', 'desc')->select();
            }
            if($result){
                $header = ['序号', '团队', '考核日期', '平均分'];
                foreach ($result as $value) {
                    $department_id=$value['department_id'];
                    $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                    $department=$departm['name'];
                    $data['teamperexport'][]=array(
                        'tm_id'         =>$value['tm_id'],    
                        'department'    =>$department,
                        'month'         =>$value['month'],        
                        'score'         =>$value['score']
                        );
                }
                if ($error = \Excel::export($header, $data['teamperexport'], $value['month']."团队绩效", '2007')) {
                throw new Exception($error);
                }
            }

      }
      //团队查看详情
      public function teamviewdetails()
        {
                $this->checkUser();
              // if(!empty($this->request->post('month')) && !empty($this->request->post('department_id') )){
              //   $month          =$this->request->post('month');
              //   $department_id  =$this->request->post('department_id');
                $month          ='2018-09';
                $department_id  =3;

                $where =  "month='$month' AND department_id='$department_id' ";

                $result=Db::name('PersonalPerform')->where($where)->select(); 
                // print_r( $result);exit;
                if ($result) {
                    foreach ($result as $value) {
                         
                         // print_r( $resteam);exit;
                        $department_id=$value['department_id'];
                        $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                        $department=$departm['name'];

                        $user_id=$value['user_id'];
                        $res=Db::name('AdminUser')->where('id',$user_id)->find();

                        $data['details'][]=array(  
                        'image'         =>$res['image'], 
                        'realname'      =>$res['realname'], 
                        'department'    =>$department,
                        'per_id'        =>$value['per_id'],
                        'department_id' =>$value['department_id'], 
                        'month'         =>$value['month'],        
                        'score'         =>$value['score']
                        );
                    }

                    $resteam=Db::name("TeamPerform")->where($where)->select();
                     $data['teamresult'][]=array(  
                        'department'        =>$department,
                        'teammonth'         =>$resteam[0]['month'],        
                        'teamscore'         =>$resteam[0]['score']
                        );
                     // print_r( $data['teamresult']);exit;
                        return  ajax_return_adv(array('success'=>'success','listdetails'=> $data['details'],'listteamres'=> $data['teamresult']));
                    
                    }else{

                        return  ajax_return_adv_error("没有数据");
                    }

                // }else{
                //         return  ajax_return_adv_error("传参错误");
                // }
        }
        //所有成员绩效
      public function allownerperfo()
      {
             $this->checkUser();
            if(!empty($this->request->post('month'))){

            $month= $this->request->post('month');
            $result=Db::name("PersonalPerform")->where('month',$month)->order('score', 'desc')->select();

            }else{

            $month=  Db::name("PersonalPerform")->where("score!=''")->max('month');
            // print_r($month);exit;
            $result=Db::name("PersonalPerform")->where('month',$month)->order('score', 'desc')->select();

            }
            // print_r($result);exit;
            if($result){
                foreach ($result as $value) {

                    $user_id=$value['user_id'];
                    $res=Db::name('AdminUser')->where('id',$user_id)->find();

                    $department_id=$res['department_id'];
                    $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                    $department=$departm['name'];

                    $position=$res['position'];
                    $positioner=Db::name("position")->field('position')->where('id',$position)->find();
                    $posit=$positioner['position'];

                    $data['allownerperfo'][]=array(
                        'user_id'       =>$value['user_id'],
                        'image'         =>$res['image'], 
                        'realname'      =>$res['realname'],
                        'position'      =>$posit,    
                        'department'    =>$department,
                        // 'department_id' =>$value['department_id'], 
                        'per_id'        =>$value['per_id'],
                        'month'         =>$value['month'],        
                        'score'         =>$value['score']
                        );

                }
                // print_r( $data['allownerperfo']);exit;
                return  ajax_return_adv(array('success'=>'success','listallowner'=> $data['allownerperfo']));
            }else{
                return  ajax_return_adv_error("没有数据");
            }
          
      }

      protected function checkUser()
    {
        if (null === UID) {
            if ($this->request->isAjax()) {
                ajax_return_adv_error("登录超时，请先登陆", "", "", "current", url("loginFrame"))->send();
            } else {
                $this->error("登录超时，请先登录", Config::get('rbac.user_auth_gateway'));
            }
        }


        return true;
    }
    public function loginFrame()
    {
          $this->redirect('Index/index');
        // return $this->view->fetch();
    }


}
