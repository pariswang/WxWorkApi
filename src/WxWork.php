<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/13
 * Time: 3:05 PM
 */

namespace Paris\WxWorkApi;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\Cache as CacheInterface;
use Exception;
use function foo\func;
use Paris\WxWorkApi\API\AddressBook;
use Paris\WxWorkApi\API\Crop;
use Paris\WxWorkApi\API\Media;
use Paris\WxWorkApi\API\Message;

class WxWork
{

    protected static $instance;
    /**
     * @var CacheInterface
     */
    protected static $cache;

    protected static $config;

    protected $apis = [
        'addressBook' => null,
        'media' => null,
        'crop' => null,
        'message' => null,
    ];

    public function __construct($config)
    {
        $this->initCache($config);
        $this->initConfig($config);
    }

    /*
     * 通过魔术方法__get($name)来调用
     * 与直接设置public属性区别在于：__get($name)可以控制访问行为，比如不同权限等，这是public控制不了的
     *
     * */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->apis)) {
            throw new Exception("未找到该方法");
        }

        if (isset($this->apis[$name])) {
            return $this->apis[$name];
        }
        return $this->apis[$name] = $this->$name();
    }

    /*
     * 通讯录
     * */
    public function addressBook()
    {
        return new AddressBook(
            config('wxwork.CorpId'),
            'addressBook',
            config('wxwork.module.addressBook.Secret'));
    }

    /*
     * 素材
     * */
    protected function media()
    {
        return new Media(
            config('wxwork.CorpId'),
            config('wxwork.module.default.AgentId'),
            config('wxwork.module.default.Secret'));
    }

    /*
     * 审批
     * */
    protected function crop()
    {
        return new Crop(
            config('wxwork.CorpId'),
            config('wxwork.module.approval.AgentId'),
            config('wxwork.module.approval.Secret'));
    }

    /*
     * 消息收发
     */
    protected function message()
    {
        return new Message(
            config('wxwork.CorpId'),
            config('wxwork.module.default.AgentId'),
            config('wxwork.module.default.Secret'));
    }

    protected function initCache($config)
    {
        if (!self::$cache) {
            $cache = $config['cache'] ?: '';
            switch ($cache) {
                case 'laravel':
                    self::$cache = new CacheBridge();
                    break;
                case 'file':
                default:
                    self::$cache = new FilesystemCache(sys_get_temp_dir());
            }
        }
    }

    protected function initConfig($config)
    {
        if (!self::$config) {
            self::$config = $config;
        }
    }

    /**
     * @return CacheInterface
     */
    public static function getCache()
    {
        return self::$cache;
    }

    public static function getConfig()
    {
        return self::$config;
    }
    /**
     * @return CacheInterface
     */
    public function getCacheInfo()
    {
        return self::$cache;
    }

    public function getConfigInfo()
    {
        return self::$config;
    }
}