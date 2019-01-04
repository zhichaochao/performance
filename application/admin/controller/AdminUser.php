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
        // print_r(12131);exit;
        if($this->request->post() && !empty($this->request->post('ment'))){
            $ment = $this->request->post('ment');
             // Db::name("department")->insert(["name"     => $ment , ]);
             Loader::model('department')->insertment($ment);
            return  ajax_return_adv("添加成功");
        }else{
            return  ajax_return_adv_error("不能为空");
        }
        
      }
      //展示部门
       public function showment()
      {
      $res=  Db::name("department")->select();
        if($res){
              foreach ($res as $value) {
                    $data['resment'][]=array(
                        'id'=>$value['id'],
                        'name'=>$value['name']
                        );
              }
           return  ajax_return_adv(array('success'=>'success','list'=>$data['resment'])); 
             // return   ajax_return_adv("success",$data['resment']);
        }else{

             return  ajax_return_adv("没有数据");
          }
      }
       //新增成员
      public function addmember()
      {
        // print_r($this->request->post());exit;
        if($this->request->post()){
            $data['name']       = $this->request->post('name');
            $data['gender']     = $this->request->post('gender');
            $data['department'] = $this->request->post('department');
            $data['position']   = $this->request->post('position');
            $data['dxx']        = $this->request->post('dxx');
            $data['username']   = $this->request->post('username');
            $data['password']   = md5($this->request->post('password'));
             // Db::name("department")->insert(["name"     => $ment , ]);
             Loader::model('departmembers')->insertdepart($data);
            return  ajax_return_adv("添加成功");
        }else{
            return  ajax_return_adv_error("不能为空");
        }
        
      }
}