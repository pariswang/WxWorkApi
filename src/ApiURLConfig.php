<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/25
 * Time: 9:51 AM
 */
namespace Pariswang\WxWorkApi;

class ApiURLConfig{
    const DOMAIN = "https://qyapi.weixin.qq.com";

    const GET_TOKEN = self::DOMAIN . "/cgi-bin/gettoken";

    /*
     * User
     */
    //创建成员
    const USER_CREATE = self::DOMAIN . "/cgi-bin/user/create";

    //读取成员
    const USER_GET = self::DOMAIN . "/cgi-bin/user/get";

    //更新成员
    const USER_UPDATE = self::DOMAIN . "/cgi-bin/user/update";

    //删除成员
    const USER_DELETE = self::DOMAIN . "/cgi-bin/user/delete";

    //批量删除成员
    const USER_BATCHDELETE = self::DOMAIN . "/cgi-bin/user/batchdelete";

    //获取部门成员
    const USER_SIMPLELIST = self::DOMAIN . "/cgi-bin/user/simplelist";

    //获取部门成员详情
    const USER_LIST = self::DOMAIN . "/cgi-bin/user/list";

    //userid与openid互换
    const USER_CONVERT_TO_OPENID = self::DOMAIN . "/cgi-bin/user/convert_to_openid";

    const USER_CONVERT_TO_USERID = self::DOMAIN . "/cgi-bin/user/convert_to_userid";

    //二次验证成功
    const USER_AUTH_SUCC = self::DOMAIN . "/cgi-bin/user/authsucc";

    //获取访问用户身份
    const USER_CODE = self::DOMAIN . "/cgi-bin/user/getuserinfo";

    //邀请成员
    const USER_INVITE = self::DOMAIN . "/cgi-bin/batch/invite";

    /*
     * Department
     */
    //创建部门
    const DEPARTMENT_CREATE = self::DOMAIN . "/cgi-bin/department/create";

    //更新部门
    const DEPARTMENT_UPDATE = self::DOMAIN . "/cgi-bin/department/update";

    //删除部门
    const DEPARTMENT_DELETE = self::DOMAIN . "/cgi-bin/department/delete";

    //获取部门列表
    const DEPARTMENT_LIST = self::DOMAIN . "/cgi-bin/department/list";

    /*
     * Tag
     * */
    // 创建标签
    const TAG_CREATE = self::DOMAIN . '/cgi-bin/tag/create';

    // 更新标签名字
    const TAG_UPDATE = self::DOMAIN . '/cgi-bin/tag/update';

    // 删除标签
    const TAG_DELETE = self::DOMAIN . '/cgi-bin/tag/delete';

    // 获取标签成员
    const TAG_GET = self::DOMAIN . '/cgi-bin/tag/get';

    // 增加标签成员
    const TAG_ADDTAGUSERS = self::DOMAIN . '/cgi-bin/tag/addtagusers';

    // 删除标签成员
    const TAG_DELTAGUSERS = self::DOMAIN . '/cgi-bin/tag/deltagusers';

    // 获取标签列表
    const TAG_LIST = self::DOMAIN . '/cgi-bin/tag/list';

    /*
     * Batch
     */

    //增量更新成员
    const BATCH_SYNCUSER = self::DOMAIN . "/cgi-bin/batch/syncuser";

    //全量覆盖成员
    const BATCH_USER = self::DOMAIN . "/cgi-bin/batch/replaceuser";

    //全量覆盖部门
    const BATCH_DEPARTMENT = self::DOMAIN . "/cgi-bin/batch/replaceparty";

    //获取异步任务结果
    const BATCH_GET_RESULT = self::DOMAIN . "/cgi-bin/batch/getresult";

    /*
     * Message
     */
    //发送应用消息
    const MESSAGE_SEND = self::DOMAIN . "/cgi-bin/message/send";

    /*
     * Chat
     */
    //创建群聊会话
    const CHAT_CREATE = self::DOMAIN . "/cgi-bin/appchat/create";

    //修改群聊会话
    const CHAT_UPDATE = self::DOMAIN . "/cgi-bin/appchat/update";

    //获取群聊会话
    const CHAT_GET = self::DOMAIN . "/cgi-bin/appchat/get";

    //应用推送消息
    const CHAT_SEND = self::DOMAIN . "/cgi-bin/appchat/send";

    /*
     * Media
     */
    //上传临时素材
    const MEDIA_UPLOAD = self::DOMAIN . "/cgi-bin/media/upload";

    //上传永久素材
    const MEDIA_UPLOADIMG = self::DOMAIN . "/cgi-bin/media/uploadimg";

    //获取临时素材
    const MEDIA_GET = self::DOMAIN . "/cgi-bin/media/get";

    //获取高清语音素材
    const MEDIA_JSSDK = self::DOMAIN . "/cgi-bin/media/get/jssdk";

    /*
     * Crop
     */
    //获取审批数据
    const CROP_APPROVAL = self::DOMAIN . "/cgi-bin/corp/getapprovaldata";

    const CROP_APPROVAL_LIST = self::DOMAIN . "/cgi-bin/oa/getapprovalinfo";

    const CROP_APPROVAL_DETAIL = self::DOMAIN . "/cgi-bin/oa/getapprovaldetail";
}