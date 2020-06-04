<?php


namespace Paris\WxWorkApi\API;


use Paris\WxWorkApi\ApiURLConfig;
use Paris\WxWorkApi\Utils\JSON;

class Crop extends BaseAPI
{
    /*
     * 获取审批数据
     *
     * 获取审批记录请求参数endtime需要大于startime， 同时起始时间跨度不要超过一个月；
     * 一次请求返回的审批记录上限是100条，超过100条记录请使用next_spnum进行分页拉取。
     * */
    public function getApprovalData($starttime, $endtime)
    {
        return $this -> http -> jsonPost(ApiURLConfig::CROP_APPROVAL, [
            'starttime' => $starttime,
            'endtime' => $endtime,
        ]);
    }

    public function getApprovalList($starttime, $endtime, $status = 0)
    {
        $cursor = 0;
        $sp_no_list = [];
        do{
            $result = $this->_getApprovalList($starttime, $endtime, $status, $cursor);
            $sp_no_list = array_merge($sp_no_list, $result['sp_no_list']);
            if(!isset($result['next_cursor']) || count($result['sp_no_list'])<100){
                break;
            }
            $cursor = $result['next_cursor'];
        }while(true);
        return [
            'errcode' => 0,
            'errmsg' => 'ok',
            'sp_no_list' => $sp_no_list,
        ];
    }

    private function _getApprovalList($starttime, $endtime, $status = 0, $cursor)
    {
        $params = [
            'starttime' => $starttime,
            'endtime' => $endtime,
            'cursor' => $cursor,
            'size' => 100,
        ];

        $filter = [];
        if($status > 0){
            $filter[] = [
                'key' => 'sp_status',
                'value' => $status,
            ];
            $params['filters'] = $filter;
        }

        return $this->http->jsonPost(ApiURLConfig::CROP_APPROVAL_LIST, $params);
    }

    public function getApprovalDetail($id)
    {
        return $this->http->jsonPost(ApiURLConfig::CROP_APPROVAL_DETAIL, ['sp_no' => $id]);
    }
}