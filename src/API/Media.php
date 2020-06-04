<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/28
 * Time: 12:06 AM
 */

namespace Paris\WxWorkApi\API;

use Paris\WxWorkApi\ApiURLConfig;

class Media extends BaseAPI
{
    public function upload($file)
    {
        return $this->http->post(ApiURLConfig::MEDIA_UPLOAD, ['type'=>'file'], [
            'files' => [
                $file
            ]
        ]);
    }

    public function get($mediaId)
    {
        return $this->http->get(ApiURLConfig::MEDIA_GET, ['media_id' => $mediaId]);
    }
}