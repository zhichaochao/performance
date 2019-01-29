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

    // protected static $blacklist = [];

    // protected function filter(&$map)
    // {
    //     if ($this->request->param('name')) {
    //         $map['name'] = ["like", "%" . $this->request->param('name') . "%"];
    //     }
    // }

    // /**
    //  * 禁用限制
    //  */
    // protected function beforeForbid()
    // {
    //     //禁止禁用Admin模块,权限设置节点
    //     $this->filterId([1, 2], '该分组不能被禁用');
    // }

    // /**
    //  * 删除限制
    //  */
    // protected function beforeDelete()
    // {
    //     //禁止删除Admin模块,权限设置节点
    //     $this->filterId([1, 2], '该分组不能被删除');
    // }

    // /**
    //  * 永久删除限制
    //  */
    // protected function beforeForeverDelete()
    // {
    //     //禁止删除Admin模块,权限设置节点
    //     $this->filterId([1, 2], '该分组不能被删除');
    // }
        //同步销售数据页面
      public function synchronousdata()
      {
         return $this->view->fetch();
      }
      //设置目标页面
       public function setgoals()
      {
         return $this->view->fetch();
      }

     
    //展示团队部门
       public function showment()
      {
         // $data['thispage']=$_SERVER['REQUEST_URI'];
         // print_r($data['thispage']);exit;
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
            $department_id=$this->request->post('department_id');
            $result=  Db::name("TeamGoals")->where('department_id',$department_id)->order('month', 'desc')->select();
            // print_r($result);exit;
         }else{
            $department_id=  Db::name("department")->where('parent_id=1')->min('id');
            $result=  Db::name("TeamGoals")->where('department_id',$department_id)->order('month', 'desc')->select();
         }
        if($result){
              foreach ($result as $value) {
                  $data['teamgoals'][]=array(
                        'team_id'=>$value['team_id'],
                        'target'=>$value['target'],     //目标
                        'actualtarget'=>$value['actualtarget'], //实际完成
                        'month'=>$value['month'],   
                        'completionrate'=>round(($value['actualtarget']/$value['target'])*100 )       //完成率
                        );
              }  
               
               return  ajax_return_adv(array('success'=>'success','listteam'=>$data['teamgoals'])); 
        }else{

             return  ajax_return_adv_error("没有数据");
          }
    
      }
      //展示团队个人目标
      public function teamIndividual()
      {
        $this->checkUser();

        if(!empty($this->request->post('department_id'))){

            $department_id=$this->request->post('department_id');
            $month=$this->request->post('month');
             $where =  "department_id='$department_id' AND sales_month='$month' ";
            $result=  Db::name("SalesData")->where($where)->select();
         }else{

            $department_id=  Db::name("department")->where('parent_id=1')->min('id');
            $month=  Db::name("TeamGoals")->where('department_id',$department_id)->max('month');
            $where =  "department_id='$department_id' AND sales_month='$month' ";
            $result=  Db::name("SalesData")->where($where)->select();

         }
          $where =  "department_id='$department_id' AND month='$month' ";
         $respoint=  Db::name("TeamGoalsPoint")->where($where)->select();
         // print_r( $respoint);exit;
         if(!empty($respoint)){
               foreach ($respoint as $respo) {
                    $data['respoint'][]=array(
                        'point_content'=>$respo['point_content'],
                        'month'        =>$respo['month']
                         );
                       }
            }else{
                   $data['respoint']="";
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
              // print_r($data['personalteamgoal']);exit;   
               return  ajax_return_adv(array('success'=>'success','perslistteam'=>$data['personalteamgoal'],'listrespoint'=>$data['respoint'])); 
        }else{

             return  ajax_return_adv("没有数据");
          }

      }
      //同步销售展示
      public function synchronous()
      {
        $this->checkUser();
        if(!empty($this->request->post('department_id'))){

            $department_id=$this->request->post('department_id');
            // $department_id=4;

            // $result=  Db::name("SalesData")->where('department_id',$department_id)->select();
            $result=  Db::name("SalesData")->where('department_id',$department_id)->select();
       
         
            if($result){
                foreach ($result as $value) {

                $id=$value['user_id']; 
                // $id=$value['user_id'];  
                $resuser=Db::name('AdminUser')->where('id',$id)->find();

                $departm=Db::name("department")->field('name')->where('id',$department_id)->find();
                $department=$departm['name'];

                $position=$resuser['position']; 
                $positioner=Db::name("position")->field('position')->where('id',$position)->find();
                $posit=$positioner['position'];

                $data['synchronous'][]=array(
                        'sales_id'          =>$value['sales_id'], 
                        'image'             =>$resuser['image'],         
                        'realname'          =>$resuser['realname'],
                        'position'          =>$posit,           //职位
                        'department'        =>$department,      //部门     
                        'sales_target'      =>$value['sales_target'],     //目标
                        'sales_actual'      =>$value['sales_actual'], //实际完成
                        'sales_month'       =>$value['sales_month'],   //月份 
                        'completionrate'    =>round(($value['sales_actual']/$value['sales_target'])*100 )       //完成率
                        );
                }
                 // print_r($data['synchronous']);exit;   
                 return  ajax_return_adv(array('success'=>'success','listsynchronous'=>$data['synchronous'])); 
             }else{

                 return  ajax_return_adv("没有数据");
              }
            }
      }

      //销售数据导出
      public function  teamexport()
      {

         // print_r($this->request->post());exit;
        if($this->request->post() && !empty($this->request->post('department_id'))){
            $department_id=$this->request->post('department_id');
            // $department_id=4;
            $header = ['序号', '姓名', '部门', '职位', '日期', '目标', '实际完成', '目标完成率'];
            $result = Db::name("SalesData")->where("department_id",$department_id)->order("sales_id asc")->select();
            // }
            // print_r($result);exit;
            foreach ($result as $value) {

                $id=$value['user_id'];  
                $resuser=Db::name('AdminUser')->where('id',$id)->find();
                $departments_id=$resuser['department_id'];
                $position=$resuser['position'];
                $departm=Db::name("department")->field('name')->where('id',$departments_id)->find();
                $department=$departm['name'];

                $positioner=Db::name("position")->field('position')->where('id',$position)->find();
                $posit=$positioner['position'];
                $data['teamtresment'][]=array(
                        'sales_id'          =>$value['sales_id'],          
                        'realname'          =>$resuser['realname'],
                        'department'        =>$department,      //部门  
                        'position'          =>$posit,           //职位
                        'sales_month'       =>$value['sales_month'],   //月份    
                        'sales_target'      =>$value['sales_target'],     //目标
                        'sales_actual'      =>$value['sales_actual'], //实际完成
                        'completionrate'    =>round(($value['sales_actual']/$value['sales_target'])*100 ).'%'       //完成率
                        );
            }
            // print_r($data['teamtresment']);exit;
            if ($error = \Excel::export($header, $data['teamtresment'], "团队目标".date('Y-m-d'), '2007')) {
                throw new Exception($error);
            }
        }
      }


      public function addsetgoals()
      {
        print_r($this->request->post());exit;
        
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
