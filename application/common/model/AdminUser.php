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
// 用户模型
//-------------------------

namespace app\common\model;

use think\Model;

class AdminUser extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    //自动完成
    protected $auto = ['password'];

    protected function setPasswordAttr($value)
    {
        return password_hash_tp($value);
    }

    /**
     * 修改密码
     */
    public function updatePassword($uid, $password)
    {
        return $this->where("id", $uid)->update(['password' => password_hash_tp($password)]);
    }
    //添加
    public function insertdepart($data)
    {

        return $this->insert(
            [
                "realname"     => $data['name'],
                "gender"     => $data['gender'],
                "department_id"     => $data['department'],
                "position"     => $data['position'],
                "jurisdiction"     => $data['dxx'],
                "account"     => $data['account'],
                "image"     => $data['image'],
                "password"     => password_hash_tp($data['password']),
                "create_time"     =>  time(),
                "update_time"     =>  time(),
            ]
        );

    }
    //删除
    public function deldmember($id)
    {
        return $this->where("id", $id)->update(
            [
                "isdelete"     => 1,
            ]
            );
    }
     //冻结成员
    public function frozenmember($id)
    {
        return $this->where("id", $id)->update(
            [
                "status"     => 0,
            ]
            );
    }
    //重置密码
    public function resetpassword($id)
    {
        return $this->where("id", $id)->update(
            [
                "password"     => password_hash_tp("88888888"),
            ]
            );
    }
      //修改资料
    public function updatepart($id,$data)
    {
        return $this->where("id",$id)->update(
            [
                "realname"     => $data['name'],
                "gender"     => $data['gender'],
                "department_id"     => $data['department'],
                "position"     => $data['position'],
                "jurisdiction"     => $data['dxx'],
                "account"     => $data['account'],
                // "password"     => password_hash_tp($data['password']),
                "update_time"     =>  time(),
            ]
        );
    }
}