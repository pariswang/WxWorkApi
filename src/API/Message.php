<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2019/10/10
 * Time: 3:55 PM
 */

namespace Paris\WxWorkApi\API;

use Paris\WxWorkApi\ApiURLConfig;
use Paris\WxWorkApi\Utils\MsgCrypt;
use Paris\WxWorkApi\Utils\XMLParse;

class Message extends BaseAPI
{
    const Token = "HqvequnLW";
    const EncodingAESKey = "ObywRcMPNGAA4zeLxjgxaVBoJDwfAPZIQMjK5XUtegG";

    protected $crypt;

    public function __construct($appId, $agentId, $appSecret)
    {
        parent::__construct($appId, $agentId, $appSecret);
        $this->crypt = new MsgCrypt(self::Token, self::EncodingAESKey, $appId);
    }
    /**
     * 主动发送消息
     */
    protected function send($msgtype, $arguments)
    {
        $to = $arguments[0];
        array_shift($arguments);

        if(empty($to))
        {
            $to = ['touser' => '@all'];
        }

        $agentid = $this->http->getToken()->agentId();
        $safe = 1;
        $content = [$msgtype => $arguments[0]];

        $body = array_merge($to, compact('msgtype', 'agentid', 'safe'), $content);

        return $this -> http -> jsonPost(ApiURLConfig::MESSAGE_SEND, $body);
    }

    public function __call($name, $arguments)
    {
        if (substr($name, 0, 4) != 'send')
        {
            throw new \Exception('No Method!');
        }

        $msgtype = strtolower(substr($name, 4));

        return $this->send($msgtype, $arguments);
    }

    public function verifyURL($sMsgSignature, $sTimeStamp, $sNonce, $sEchoStr, &$sReplyEchoStr)
    {
        return $this->crypt->VerifyURL($sMsgSignature, $sTimeStamp, $sNonce, $sEchoStr, $sReplyEchoStr);
    }

    public function decryptMsg($sMsgSignature, $sTimeStamp = null, $sNonce, $sPostData)
    {
        $sMsg = '';
        $ret = $this->crypt->DecryptMsg($sMsgSignature, $sTimeStamp, $sNonce, $sPostData, $sMsg);
        if ( 0 == $ret ) {
            return xmlToArray($sMsg);
        }
        return false;
    }

    public function encryptMsg($sReplyMsg)
    {
        $sNonce = $this->getRandomStr();
        $sTimeStamp = time();
        $sEncryptMsg = '';
        $ret = $this->crypt->EncryptMsg($sReplyMsg, $sTimeStamp, $sNonce, $sEncryptMsg);
        if ( 0 == $ret ) {
            return $sEncryptMsg;
        }
        return false;
    }

    function getRandomStr()
    {

        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }
}