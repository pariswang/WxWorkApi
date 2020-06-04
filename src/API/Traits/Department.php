<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/27
 * Time: 10:31 PM
 */

namespace Paris\WxWorkApi\API\Traits;

use Paris\WxWorkApi\ApiURLConfig;

trait Department
{
    /*
     * 获取部门列表
     * @param [int] $id 部门id，如果不传$id，获取全量组织架构
     *
     * */
    public function departmentList($id = 0)
    {
        if ($id>0)
        {
            return $this->http->jsonGet(ApiURLConfig::DEPARTMENT_LIST, ['id' => $id]);
        }
        return $this->http->jsonGet(ApiURLConfig::DEPARTMENT_LIST);
    }

    /*
     * 创建部门
     * @param [String] $name  部门名称
     * @param [int] $parentid  上级部门id
     * @param [int] $order  在上级部门的次序
     * @param [int] $id  部门id，如果不传，将自动生成该id
     *
     * */
    public function createDepartment($name, $parentid = 1, $order = -1, $id = 0)
    {
        $params = array(
            'name' => $name,
            'parentid' => $parentid,
        );

        if ($order>-1)
        {
            $params['order'] = $order;
        }

        if ($id>0)
        {
            $params['id'] = $id;
        }

        return $this->http->jsonPost(ApiURLConfig::DEPARTMENT_CREATE, $params);
    }

    /**
     * <pre>
     * $data
     * [
     *   'name' => '',
     *   'parentid' => 1,
     *   'order' => 1,
     * ]
     * </pre>
     * @param $id
     * @param $data
     * @return true/false
     */
    public function updateDepartment($id, $data)
    {
        return $this->http->jsonPost(ApiURLConfig::DEPARTMENT_UPDATE, array_merge(['id' => $id], $data));
    }

    /*
     * 删除部门
     * @param [int] $id 部门id，不能是根部门，不能是含有子部门、成员的部门
     *
     * */
    public function deleteDepartment($id)
    {
        return $this->http->jsonGet(ApiURLConfig::DEPARTMENT_DELETE, ['id' => $id]);
    }
}