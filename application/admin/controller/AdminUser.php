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
// 用户控制器
//-------------------------

namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Exception;
use think\Loader;
use think\Db;


// use think\Loader;
use think\Session;
// use think\Db;
use think\Config;
// use think\Exception;
use think\View;
use think\Request;
class AdminUser extends Controller
{
    use \app\admin\traits\controller\Controller;

//    protected static $blacklist = ['delete', 'clear', 'deleteforever', 'recyclebin', 'recycle'];

    // protected function filter(&$map)
    // {
    //     //不查询管理员
    //     $map['id'] = ["gt", 1];

    //     if ($this->request->param('realname')) {
    //         $map['realname'] = ["like", "%" . $this->request->param('realname') . "%"];
    //     }
    //     if ($this->request->param('account')) {
    //         $map['account'] = ["like", "%" . $this->request->param('account') . "%"];
    //     }
    //     if ($this->request->param('email')) {
    //         $map['email'] = ["like", "%" . $this->request->param('email') . "%"];
    //     }
    //     if ($this->request->param('mobile')) {
    //         $map['mobile'] = ["like", "%" . $this->request->param('mobile') . "%"];
    //     }
    // }

    /**
    
     * 修改密码
     */
    // public function password()
    // {
    //     $id = $this->request->param('id/d');
    //     if ($this->request->isPost()) {
    //         //禁止修改管理员的密码，管理员id为1
    //         if ($id < 2) {
    //             return ajax_return_adv_error("缺少必要参数");
    //         }

    //         $password = $this->request->post('password');
    //         if (!$password) {
    //             return ajax_return_adv_error("密码不能为空");
    //         }
    //         if (false === Loader::model('AdminUser')->updatePassword($id, $password)) {
    //             return ajax_return_adv_error("密码修改失败");
    //         }
    //         return ajax_return_adv("密码已修改为{$password}", '');
    //     } else {
    //         // 禁止修改管理员的密码，管理员 id 为 1
    //         if ($id < 2) {
    //             throw new Exception("缺少必要参数");
    //         }

    //         return $this->view->fetch();
    //     }
    // }

    /**
     * 禁用限制
     */
    // protected function beforeForbid()
    // {
    //     // 禁止禁用 Admin 模块,权限设置节点
    //     $this->filterId(1, '该用户不能被禁用', '=');
    // }

      /**
     * 本页面的导航
     * @return mixed
     */
    public function nav()
    {
        // print_r(12131);exit();
        // $nav =array();
        // $nav[]=array(
        //     'name'=>'考核',
        //     'href'=>url("index/welcome"),
        // );

         return ajax_return_adv($nav);
      }
      //新增成员
      public function newmembera()
      {
         // $this->redirect('Admin_user/newmembera');
         return $this->view->fetch();
      }
      //添加部门
      public function insertment()
      {
        $this->checkUser();
        // print_r(12131);exit;
        if($this->request->post() && !empty($this->request->post('ment'))){
            $ment = $this->request->post('ment');
            $parent_id = $this->request->post('parent_id');
             // Db::name("department")->insert(["name"     => $ment , ]);
             Loader::model('department')->insertment($ment,$parent_id);
            return  ajax_return_adv("添加成功");
        }else{
            return  ajax_return_adv_error("不能为空");
        }
        
      }
      //展示部门
       public function showment()
      {
        $this->checkUser();
      $res=  Db::name("department")->select();
        if($res){
              foreach ($res as $value) {
                  $id=$value['id'];
                  $resq=  Db::name("department")
                    ->alias('d')
                    ->Join('tp_admin_user w','w.department_id = d.id')
                    ->where('tp_admin_user.department_id',$id)
                    ->count('w.id');
                  $data['resment'][]=array(
                        'id'=>$value['id'],
                        'name'=>$value['name'].'('.$resq.')'
                        );
              }
            $result=  Db::name("department")->where('parent_id=0')->select();
            if($result){
            foreach ($result as $values) {
                        $data['parentclass'][]=array(
                            'id'=>$values['id'],
                            'name'=>$values['name']
                            );
                     } 
                  }
                  
               return  ajax_return_adv(array('success'=>'success','list'=>$data['resment'],'parentlist'=>$data['parentclass'])); 
        }else{

             return  ajax_return_adv("没有数据");
          }
      }
        //删除部门
      public function delment()
      {
        $this->checkUser();
        // print_r($this->request->post());exit;
        if($this->request->post() && !empty($this->request->post('id'))){
            $id=$this->request->post('id');

             Loader::model('department')->deldment($id);
             
            return  ajax_return_adv("删除成功");
        }else{

            return  ajax_return_adv_error("删除失败");
        }
        
      }
      //展示成员
       public function showdepartment()
      {
        $this->checkUser();
      
      if($this->request->post('department_id')){
        $department_id=$this->request->post('department_id');
        $res=  Db::name("AdminUser")->where('department_id',$department_id)->select();
      }else{
        $res=  Db::name("AdminUser")->select();
      }
        if($res){
              foreach ($res as $value) {
                  // print_r($res);exit;
                    $department_id=$value['department_id'];
                    $position=$value['position'];
                    $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                    $department=$departm['name'];
                    $positioner=Db::name("position")->field('position')->where('id',$position)->find();
                     $posit=$positioner['position'];
                    $data['departresment'][]=array(
                        'id'            =>$value['id'],
                        'name'          =>$value['realname'],
                        'gender'        =>$value['gender'],
                        'position'      =>$posit,
                        'department_id' =>$department,
                        'image' =>$value['image'],
                        'time'=>date("Y/m/d H:i:s",$value['update_time']),
                        'status'=>$value['status'] > 0 ? "激活" : "未激活"
                        );
              }
              print_r($data['departresment']);exit;
              
           return  ajax_return_adv(array('success'=>'success','departlist'=>$data['departresment'])); 
        }else{

             return  ajax_return_adv("没有数据");
          }
      }
       //新增成员
      public function addmember()
      {
        $this->checkUser();
        // print_r( request()->file('file'));exit;
         $file=request()->file('file');
         if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            if ($info) {
                $img = $info->getSaveName();//获取名称
                $imgpath = DS.'uploads'.DS.$img;
                $path = str_replace(DS,"/",$imgpath);//数据库存储路径
                // print_r($path);exit;
                $data['image']=$path;
            }
        }else{
          $data['image']='';
        }

        if($this->request->post()){
            $data['name']       = $this->request->post('name');
            $data['gender']     = $this->request->post('gender');
            $data['department'] = $this->request->post('department');
            $data['position']   = $this->request->post('position');
            $data['dxx']        = $this->request->post('dxx');
            $data['account']    = $this->request->post('username');
            $data['password']   = $this->request->post('password');
             Loader::model('AdminUser')->insertdepart($data);

            return  ajax_return_adv("添加成功");
        }else{

            return  ajax_return_adv_error("不能为空");
        }
        
      }
      //删除成员
      public function delmember()
      {
        $this->checkUser();
        // print_r($this->request->post());exit;
        if($this->request->post() && !empty($this->request->post('id'))){
            $id=$this->request->post('id');

             Loader::model('AdminUser')->deldmember($id);

            return  ajax_return_adv("删除成功");
        }else{

            return  ajax_return_adv_error("删除失败");
        }
        
      }
      //冻结成员
      public function frozenmember()
      {
        $this->checkUser();
        // print_r($this->request->post());exit;
        if($this->request->post() && !empty($this->request->post('id'))){
            $id=$this->request->post('id');

             Loader::model('AdminUser')->frozenmember($id);
             $departm=Db::name("AdminUser")->field('status')->where('id',$id)->find();
             if($departm['status']==1){
              $department='激活';
             }else{
              $department='未激活';
             }
            return  ajax_return_adv(array('success'=>'冻结成功','result'=>$department));
        }else{

            return  ajax_return_adv_error("冻结失败");
        }
        
      }
      //修改成员资料
      public function editmembera()
      {
        $this->checkUser();
        $id = $_GET['id'];
        $res=Db::name('AdminUser')->where('id',$id)->find();
       
        // $data['persinformation']=array(
        //        'id'            =>$res['id'],
        //        'realname'      =>$res['realname'],
        //        'gender'        =>$res['gender'],
        //        'position'      =>$res['position'],
        //        'department_id' =>$res['department_id'],
        //        'account'       =>$res['account'],
        //        'password'      =>$res['password'],
        //        'jurisdiction'  =>$res['jurisdiction']
        //    );
// print_r(  $data['persinformation']);exit;
       // $this->assign("re",$res);
       $this->view->assign("re",$res);

         return $this->view->fetch();
      }
      public function editmember()
      {
        $this->checkUser();
        // print_r($this->request->post());exit;
        if($this->request->post()){

            $id                 = $this->request->post('id');
            $data['name']       = $this->request->post('name');
            $data['gender']     = $this->request->post('gender');
            $data['department'] = $this->request->post('department');
            $data['position']   = $this->request->post('position');
            $data['dxx']        = $this->request->post('dxx');
            $data['account']    = $this->request->post('username');
            $data['password']   = $this->request->post('password');
             Loader::model('AdminUser')->updatepart($id,$data);

            return  ajax_return_adv("修改成功");
        }else{

            return  ajax_return_adv_error("失败");
        }
        
      }
      //重置密码
      public function  resetpassword()
      {
        $this->checkUser();
        // print_r($this->request->post());exit;
        if($this->request->post() && !empty($this->request->post('id'))){
            $id=$this->request->post('id');

             Loader::model('AdminUser')->resetpassword($id);

            return  ajax_return_adv("重置成功");
        }else{

            return  ajax_return_adv_error("重置失败");
        }
        
      }
      //成员导出
      public function  memberexport()
      {

         // print_r($this->request->post());exit;
        if($this->request->post() && !empty($this->request->post('department_id'))){
            $department_id=$this->request->post('department_id');

            // $department_id=0;
            $header = ['成员ID', '姓名', '部门', '职位', '更新时间', '状态'];
            if($department_id==0){

                $result = Db::name("AdminUser")->field('id,realname,department_id,position,update_time,status')->order("id asc")->select();
               }else{

                $result = Db::name("AdminUser")->field('id,realname,department_id,position,update_time,status')->where("department_id",$department_id)->order("id asc")->select();
            }
            // print_r($result);exit;
            foreach ($result as $value) {
                   $department_id=$value['department_id'];
                   $position=$value['position'];
                    $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                    $department=$departm['name'];

                    $positioner=Db::name("position")->field('position')->where('id',$position)->find();
                     $posit=$positioner['position'];
                    $data['departresment'][]=array(
                        'id'            =>$value['id'],
                        'realname'      =>$value['realname'],
                        'department_id' =>$department,
                        'position'      =>$posit,
                        'time'          =>date("Y/m/d H:i:s",$value['update_time']),
                        'status'        =>$value['status'] > 0 ? "激活" : "未激活"
                        );
            }
            if ($error = \Excel::export($header, $data['departresment'], "成员列表".date('Y-m-d'), '2007')) {
                throw new Exception($error);
            }
        }
      }
      /**
     * 检查用户是否登录
     */
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