<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/27
 * Time: 10:31 PM
 */

namespace Pariswang\WxWorkApi\API\Traits;

use Pariswang\WxWorkApi\ApiURLConfig;
use Pariswang\WxWorkApi\Utils\JSON;

Trait User
{
    /*
     * 获取部门成员详情
     *
     * */
    public function userList($departmentId = 0, $fetchChild = 0)
    {
        if ($departmentId != 0) {
            return $this->http->jsonGet(ApiURLConfig::USER_LIST, [
                'department_id' => $departmentId,
                'fetch_child' => $fetchChild,
            ]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'departmentId is invalid']);
        }
    }

    /*
     * 获取部门成员
     *
     * */
    public function userSimpleList($departmentId = 0, $fetchChild = 0)
    {
        if ($departmentId != 0) {
            return $this->http->jsonGet(ApiURLConfig::USER_SIMPLELIST, [
                'department_id' => $departmentId,
                'fetch_child' => $fetchChild,
            ]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'departmentId is invalid']);
        }
    }

    /*
     * 创建用户
     * @param [array] $data 创建用户的各种信息
     * $data
     * ['userid' => '', 'name' => '', 'mobile' => '', 'department' => [1, 2], 'email' => '']
     *
     * */
    public function createUser($data)
    {
        if (isset($data['userid']) && isset($data['name']) && isset($data['department']) && (isset($data['mobile']) || isset($data['email']))) {
            return $this->http->jsonPost(ApiURLConfig::USER_CREATE, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'params is invalid']);
        }
    }

    /*
     * 读取成员信息
     * @param [String] $id 企业微信用户userid
     * */
    public function getUser($id = null)
    {
        if (null != $id) {
            return $this->http->jsonGet(ApiURLConfig::USER_GET, ['userid' => $id]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'userid is invalid']);
        }
    }

    /*
     * 更新成员信息
     * @param [array] $data 更新成员的各种信息
     *
     * */
    public function updateUser($data)
    {
        if (isset($data['userid'])) {
            return $this->http->jsonPost(ApiURLConfig::USER_UPDATE, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'userid is invalid']);
        }
    }

    /*
     * 删除成员
     * @param [String] $id 企业微信用户userid
     *
     * */
    public function deleteUser($id = null)
    {
        if (null != $id) {
            return $this->http->jsonGet(ApiURLConfig::USER_DELETE, ['userid' => $id]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'userid is invalid']);
        }
    }

    /*
     * 批量删除成员
     * @param [array] $data 企业微信用户userid列表
     *
     * */
    public function batchDeleteUser($data)
    {
        if (isset($data['useridlist'])) {
            return $this->http->jsonPost(ApiURLConfig::USER_BATCHDELETE, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'useridlist is invalid']);
        }
    }

    /*
     * 二次验证
     * @param [String] $id 企业微信用户userid
     *
     * */
    public function authSucc($id = null)
    {
        if (null != $id) {
            return $this->http->jsonGet(ApiURLConfig::USER_AUTH_SUCC, ['userid' => $id]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'userid is invalid']);
        }
    }

    /*
     * 邀请成员
     * @param [array] $data 被邀请成员列表
     *
     * */
    public function batchInvite($data)
    {
        if (isset($data['user']) || isset($data['party']) || isset($data['tag'])) {
            return $this->http->jsonPost(ApiURLConfig::USER_INVITE, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'params is invalid']);
        }
    }

    /*
     * 获取访问用户身份
     *
     * */
    public function getUserInfo($code = '')
    {
        if ($code) {
            return $this -> http -> jsonGet(ApiURLConfig::USER_CODE, ['code' => $code]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'code is invalid']);
        }
    }
}