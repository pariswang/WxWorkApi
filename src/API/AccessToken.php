<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * AccessToken.php.
 *
 * Part of Overtrue\Wechat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 *
 * @link      https://github.com/overtrue
 * @link      http://overtrue.me
 */

namespace Paris\WxWorkApi\API;

use Paris\WxWorkApi\ApiURLConfig;
use Paris\WxWorkApi\WxWork;
use Paris\WxWorkApi\Utils\Http;

/**
 * 全局通用 AccessToken.
 * 本文件需要处理access_token的自动刷新
 */
class AccessToken
{
    /**
     * 应用ID.
     *
     * @var string
     */
    protected $appId;

    protected $agentId;
    /**
     * 应用secret.
     *
     * @var string
     */
    protected $appSecret;

    /**
     * 缓存类.
     *
     * @var use \Doctrine\Common\Cache\Cache
     */
    protected $cache;

    /**
     * 缓存前缀
     *
     * @var string
     */
    protected $cacheKey = 'wxwork.access_token';

    // API
    const API_TOKEN_GET = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken';

    /**
     * constructor.
     *
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct($appId, $agentId, $appSecret)
    {
        $this->appId = $appId;
        $this->agentId = $agentId;
        $this->appSecret = $appSecret;
        $this->cacheKey = $this->cacheKey.'.'.$appId.'.'.$agentId;
        $this->cache = WxWork::getCache();
    }

    public function agentId()
    {
        return $this->agentId;
    }
    /**
     * 缓存 setter.
     *
     * @param Cache $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache; // $this -> cache 是cache类
    }

    /**
     * 获取Token.
     * @param bool $forceRefresh
     *
     * @return string
     */
    public function getToken($forceRefresh = false)
    {
        $cacheKey = $this->cacheKey; // 缓存键

        $cached = $this->cache->fetch($cacheKey); // 获取缓存的值
        if ($forceRefresh || empty($cached)) { // 如果强制更新或者缓存中没有值，则重新获取access_token
            $token = $this->getTokenFromServer();
            $this->cache->save($cacheKey, $token['access_token'], $token['expires_in'] - 800); // 设置缓存过期时间
            return $token['access_token'];
        }
        return $cached;
    }

    /**
     * Get the access token from WeChat server.
     *
     * @param string $cacheKey
     *
     * @return array|bool
     */
    protected function getTokenFromServer()
    {
        $http = new Http();
        $params = array(
            'corpid' => $this->appId,
            'corpsecret' => $this->appSecret,
        );

        $token = $http->get(ApiURLConfig::GET_TOKEN, $params);

        return $token;
    }
}
