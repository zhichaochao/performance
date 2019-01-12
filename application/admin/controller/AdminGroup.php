<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author    yuan1994 <tianpian0805@gmail.com>
 * @link      http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

//------------------------
// 分组管理
//-------------------------

namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);

use app\admin\Controller;

use think\Db;

class AdminGroup extends Controller
{
    use \app\admin\traits\controller\Controller;

    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param('name')) {
            $map['name'] = ["like", "%" . $this->request->param('name') . "%"];
        }
    }

    /**
     * 禁用限制
     */
    protected function beforeForbid()
    {
        //禁止禁用Admin模块,权限设置节点
        $this->filterId([1, 2], '该分组不能被禁用');
    }

    /**
     * 删除限制
     */
    protected function beforeDelete()
    {
        //禁止删除Admin模块,权限设置节点
        $this->filterId([1, 2], '该分组不能被删除');
    }

    /**
     * 永久删除限制
     */
    protected function beforeForeverDelete()
    {
        //禁止删除Admin模块,权限设置节点
        $this->filterId([1, 2], '该分组不能被删除');
    }

    //展示部门
       public function showment()
      {
        $this->checkUser();
      $result=  Db::name("department")->where('parent_id=1')->order('id', 'sac')->select();
        if($result){
              foreach ($result as $value) {
                  $data['resment'][]=array(
                        'id'=>$value['id'],
                        'name'=>$value['name']
                        );
              }
           // print_r($data['resment']);exit;       
               return  ajax_return_adv(array('success'=>'success','list'=>$data['resment'])); 
        }else{

             return  ajax_return_adv("没有数据");
          }
      }
      //展示团队目标
       public function teamgoals()
      {
        $this->checkUser();
        if(!empty($this->request->post('department_id'))){
            $deparment_id=$this->request->post('department_id');
            $result=  Db::name("TeamGoals")->where('deparment_id',$deparment_id)->order('month', 'desc')->select();
            // print_r($result);exit;
         }else{
            $deparment_id=  Db::name("department")->where('parent_id=1')->min('id');
            $result=  Db::name("TeamGoals")->where('deparment_id',$deparment_id)->order('month', 'desc')->select();
         }
        if($result){
              foreach ($result as $value) {
                  $team_id=  $value['team_id'];

                  $respoint=  Db::name("TeamGoalsPoint")->where('team_id',$team_id)->select();
                  if($respoint){
                     $data['respoint'][]=array(
                        'point_content'=>$respoint['point_content']
                        );
                 }
                  $data['teamgoals'][]=array(
                        'team_id'=>$value['team_id'],
                        'target'=>$value['target'],     //目标
                        'actualtarget'=>$value['actualtarget'], //实际完成
                        'month'=>$value['month'],   
                        'completionrate'=>round(($value['actualtarget']/$value['target'])*100 )       //完成率
                        );
              }  
              print_r( $data['respoint']);exit; 
               return  ajax_return_adv(array('success'=>'success','listteam'=>$data['teamgoals'])); 
        }else{

             return  ajax_return_adv("没有数据");
          }
    
      }
      //展示团队个人目标
      public function teamIndividual()
      {
        $this->checkUser();

        if(!empty($this->request->post('department_id'))){

            $deparment_id=$this->request->post('department_id');
            $month=$this->request->post('month');
             $where =  "deparment_id='$deparment_id' AND sales_month='$month' ";
            $result=  Db::name("SalesData")->where($where)->select();
         }else{

            $deparment_id=  Db::name("department")->where('parent_id=1')->min('id');
            $month=  Db::name("TeamGoals")->where('deparment_id',$deparment_id)->max('month');
            $where =  "deparment_id='$deparment_id' AND sales_month='$month' ";
            $result=  Db::name("SalesData")->where($where)->select();

         }
        if($result){
              foreach ($result as $value) {
                    $id=$value['user_id'];  
                    $resuser=Db::name('AdminUser')->where('id',$id)->find();
                    $position=$resuser['position']; 
                    $positioner=Db::name("position")->field('position')->where('id',$position)->find();
                    $posit=$positioner['position'];
                    $data['personalteamgoal'][]=array(
                        'image'             =>$resuser['image'],         
                        'realname'          =>$resuser['realname'],
                        'position'          =>$posit,           //职位
                        'sales_target'      =>$value['sales_target'],     //目标
                        'sales_actual'      =>$value['sales_actual'], //实际完成
                        'sales_month'       =>$value['sales_month'],   //月份 
                        'completionrate'    =>round(($value['sales_actual']/$value['sales_target'])*100 )       //完成率
                        );
              }
              print_r($data['personalteamgoal']);exit;   
               return  ajax_return_adv(array('success'=>'success','perslistteam'=>$data['personalteamgoal'])); 
        }else{

             return  ajax_return_adv("没有数据");
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
