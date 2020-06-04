<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/25
 * Time: 11:37 AM
 */

namespace Paris\WxWorkApi\API;

use Paris\WxWorkApi\Utils\Http;

class BaseAPI
{
    protected $accessToken;
    public $http;

    public function __construct($appId, $agentId, $appSecret)
    {
        $this->http = new Http(new AccessToken($appId, $agentId, $appSecret));
    }

    public function setModule($name)
    {
        $token = new AccessToken(config('wxwork.CorpId'),
            config('wxwork.module.'.$name.'.AgentId'),
            config('wxwork.module.default.Secret'));

        $this->http->setToken($token);

        return $this;
    }
}