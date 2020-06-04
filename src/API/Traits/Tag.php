<?php


namespace Paris\WxWorkApi\API\Traits;

use Paris\WxWorkApi\ApiURLConfig;
use Paris\WxWorkApi\Utils\JSON;

trait Tag
{
    /*
     * 创建标签
     * */
    public function createTag($data)
    {
        if (isset($data['tagname'])) {
            return $this -> http -> jsonPost(ApiURLConfig::TAG_CREATE, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'params is invalid']);
        }
    }

    /*
     * 更新标签名字
     * */
    public function updateTag($data)
    {
        if (isset($data['tagid']) && isset($data['tagname'])) {
            return $this -> http -> jsonPost(ApiURLConfig::TAG_UPDATE, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'params is invalid']);
        }
    }

    /*
     * 删除标签
     * */
    public function deleteTag($id)
    {
        if (isset($id)) {
            return $this -> http -> jsonGet(ApiURLConfig::TAG_DELETE, ['tagid' => $id]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'tagid is invalid']);
        }
    }

    /*
     * 获取标签成员
     * */
    public function getTag($id)
    {
        if (isset($id)) {
            return $this -> http -> jsonGet(ApiURLConfig::TAG_GET, ['tagid' => $id]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'tagid is invalid']);
        }
    }

    /*
     * 增加标签成员
     * userlist和partylist不能同时为空，如果有部分不合法，会返回invalildlist和invalidparty，此时errcode=0
     *
     * */
    public function addTagUsers($data)
    {
        if (isset($data['tagid'])) {
            return $this -> http -> jsonPost(ApiURLConfig::TAG_ADDTAGUSERS, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'params is invalid']);
        }
    }

    /*
     * 删除标签成员
     * */
    public function delTagUsers($data)
    {
        if (isset($data['tagid'])) {
            return $this -> http -> jsonPost(ApiURLConfig::TAG_DELTAGUSERS, $data);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'params is invalid']);
        }
    }

    /*
     * 获取标签列表
     * */
    public function tagList()
    {
        return $this -> http -> jsonGet(ApiURLConfig::TAG_LIST);
    }
}