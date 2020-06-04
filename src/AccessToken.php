<?php
namespace Paris\WxWorkApi;

require_once "helper.php";

class AccessToken {
    private $corpId;     
    private $secret;     
    private $agentId;    
    private $appConfigs; 

    private $wxwork;

    /**
     * AccessToken构造器
     * @param [Number] $agentId 两种情况：1是传入字符串“txl”表示获取通讯录应用的Secret；2是传入应用的agentId
     */
    public function __construct($agentId) {
//        $this->appConfigs = WxWork::getConfig();
        $this -> wxwork = new WxWork(config('wxwork'));
        $this -> appConfigs = $this -> wxwork -> getConfigInfo();

//        $this->corpId = $this->appConfigs['CorpId'];
        $this->corpId = config('wxwork.CorpId');

//        $this->secret = $secret;
        $this->agentId = $agentId;

        //由于通讯录是特殊的应用，需要单独处理
        if($agentId == "txl"){
//            $this->secret = $this->appConfigs['TxlSecret'];
            $this->secret = config('wxwork.module.addressBook.Secret');
        }else{
            $config = $this->getConfigByAgentId($agentId);

            if($config){
                $this->secret = $config['Secret'];
            } else {
                die('未找到该应用的配置');
            }
        }        
    }

    protected function getConfigByAgentId($agentId)
    {
        foreach ($this->appConfigs['AppsConfig'] as $key => $value) {
            if ($value['AgentId'] == $agentId) {
                return $value;
            }
        }
    }

    public function getAccessToken() {
//        $wxwork = new WxWork(config('wxwork'));
        $cache = $this -> wxwork -> getCacheInfo();
//        $cache = WxWork::getCache(); // 此处需要在捋一捋，调用静态方法，不会调用构造方法，先将cache关了
        if($cache) {
            $data = $cache->fetch($this->agentId);
            $data = $data ?: ['expire_time'=>0];
        } else {
            $data = ['expire_time' => 0];
        }


        if($data['expire_time'] < time()) {

            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->corpId&corpsecret=$this->secret";                      
            $res = json_decode(http_get($url)["content"]);

            $access_token = $res->access_token;
            
            if($access_token) {
                $data['expire_time'] = time() + 7000;
                $data['access_token'] = $access_token;

                $cache->save($this->agentId, $data); // 关了这里，记得打开
            }
        } else {
            $access_token = $data['access_token'];
        }
        return $access_token;    
    }

    public function getToken()
    {
        return $this->getAccessToken();
    }
}

