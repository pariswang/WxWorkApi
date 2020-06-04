<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/28
 * Time: 12:46 AM
 */

namespace Pariswang\WxWorkApi\API\Traits;

use Pariswang\WxWorkApi\ApiURLConfig;
use Pariswang\WxWorkApi\Utils\JSON;

trait Batch
{
    /*
     * 全量覆盖部门
     *
     * */
    public function batchReplaceParty($mediaId = 0)
    {
        if ($mediaId != 0) {
            return $this->http->jsonPost(ApiURLConfig::BATCH_DEPARTMENT, ['media_id' => $mediaId]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'mediaId is invalid']);
        }
    }
    /*
     * 全量覆盖成员
     *
     * */
    public function batchReplaceUser($mediaId = 0)
    {
        if ($mediaId != 0) {
            return $this -> http -> jsonPost(ApiURLConfig::BATCH_USER, ['media_id' => $mediaId]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'mediaId is invalid']);
        }
    }
    /*
     * 增量更新成员
     *
     * */
    public function batchSyncuser($mediaId = 0)
    {
        if ($mediaId == 0) {
            return $this -> http -> jsonPost(ApiURLConfig::BATCH_SYNCUSER, ['media_id' => $mediaId]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'mediaId is invalid']);
        }
    }

    /*
     * 获取异步任务结果
     *
     * */
    public function batchGetResult($jobId = 0)
    {
        if ($jobId != 0) {
            return $this -> http -> jsonGet(ApiURLConfig::BATCH_GET_RESULT, ['jobid' => $jobId]);
        } else {
            return JSON::encode(['errcode' => -1, 'errmsg' => 'jobid is invalid']);
        }
    }
}