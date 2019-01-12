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
// 分组模型
//-------------------------

namespace app\common\model;

use think\Model;

class Departmembers extends Model
{
    // // 开启自动写入时间戳字段
    // protected $autoWriteTimestamp = 'int';

    // /**
    //  * 列表
    //  */
    public function insertdepart($data)
    {
        return $this->insert(
            [
                "name"     => $data['name'],
                "gender"     => $data['gender'],
                "department_id"     => $data['department'],
                "position"     => $data['position'],
                "jurisdiction"     => $data['dxx'],
                "username"     => $data['username'],
                "password"     => $data['password'],
                "time"     =>  time(),
            ]
        );
    }
    
    public function deldmember($id)
    {
        return $this->where("id", $id)->delete();
    }
}