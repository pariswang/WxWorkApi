<?php
namespace Pariswang\WxWorkApi;

require_once "helper.php"; 

class TxlApi {
  
  private $access_token;

  public function __construct() {
      $this->access_token = new AccessToken("txl");
  }

  /**
   * 在请求的企业微信接口后面自动附加token信息   
   */
  private function appendToken($url){
      $token = $this->access_token->getAccessToken();

      if(strrpos($url,"?",0) > -1){
        return $url."&access_token=".$token;
      }else{
        return $url."?access_token=".$token;
      }      
  }
  
  /**
   * 根据部门ID来查询下属的所有子部门
   * 如果不传id，获取全量组织结构
   * @param  [Number] $id 部门ID
   */
  public function getDepartmentsById($id = 0){
      if($id > 0){
        return http_get($this->appendToken(ApiURLConfig::DEPARTMENT_LIST . "?id=$id"))["content"];
      }else{
        return http_get($this->appendToken(ApiURLConfig::DEPARTMENT_LIST))["content"];
//        return '{"errcode":-1,"errmsg":"departmentId is invalid"}';
      }       
  }

  /**
   * 创建新的部门  
   * @param  [Array like Object] $data 部门信息
   */
  public function createDepartment($data){

      if($data["name"] && $data["parentid"]){
        return http_post($this->appendToken(ApiURLConfig::DEPARTMENT_CREATE),$data)["content"];
      }else{
        return '{"errcode":-2,"errmsg":"params is missing"}';      
      }
  }

  /**
   * 更新部门信息  
   * @param  [Array like Object] $data 更新的部门目标信息
   * 必传参数为id，如果其他字段没传，不更新该字段
   */
  public function updateDepartment($data){
//      if($data["name"] && $data["parentid"]){
      if($data["id"]){
        return http_post($this->appendToken(ApiURLConfig::DEPARTMENT_UPDATE),$data)["content"];
      }else{
        return '{"errcode":-2,"errmsg":"params is missing"}';      
      }
  }

  /**
   * 根据ID删除指定的部门
   * @param  [Number] $id 被删除部门的ID   
   */
  public function deleteDepartmentById($id){

      if($id > 0){        
        return http_get($this->appendToken(ApiURLConfig::DEPARTMENT_DELETE . "?id=$id"))["content"];
      }else{
        return '{"errcode":-1,"errmsg":"departmentId is invalid"}';
      } 
  }

  /**
   * 创建一个新用户
   * @param  [Array like Object] $data 用户信息   
   */
  public function createUser($data){
      if($data["name"] && $data["userid"] && $data["userid"] && $data["mobile"] && $data["department"]){

        $token = $this->access_token->getAccessToken();
        $url = ApiURLConfig::USER_CREATE . "?access_token=$token";
    
        return http_post($url,$data)["content"];        
      }else{
        return '{"errcode":-2,"errmsg":"params is missing"}';      
      }
  }

  //更新用户信息
  //必传参数userid，其他参数如果不传，不会更新
  public function updateUser($data){
//      if($data["name"] && $data["userid"] && $data["userid"] && $data["mobile"] && $data["department"]){
      if($data["userid"]){
        return http_post($this->appendToken(ApiURLConfig::USER_UPDATE),$data)["content"];
      }else{
        return '{"errcode":-2,"errmsg":"params is missing"}';      
      }
  }

  //根据用户ID删除用户信息
  public function deleteUserById($id = ""){
      if($id){        
        return http_get($this->appendToken(ApiURLConfig::USER_DELETE . "?userid=$id"))["content"];
      }else{
        return '{"errcode":-1,"errmsg":"userId is invalid"}';
      } 
  }

  /**
   * [batchDeleteUser description]
   * @param  [Array like Object] $data 批量删除的用户useridlist
   */
  public function batchDeleteUser($data){
      if($data["useridlist"]){          
          return http_post($this->appendToken(ApiURLConfig::USER_BATCHDELETE),$data)["content"];
      }else{
          return '{"errcode":-2,"errmsg":"params is missing"}';      
      }
  }

  /**
   * 根据用户查询用户信息
   * @param  [Number] $id 查询的目标用户ID
   */
  public function queryUserById($id = ""){
      if($id){
        return http_get($this->appendToken(ApiURLConfig::USER_GET . "?userid=$id"))["content"];
      }else{
        return '{"errcode":-1,"errmsg":"userId is invalid"}'; 
      }
  }

  /**
   * 根据部门ID查询用户信息
   * @param  [Number]  $depId    查询的部门ID
   * @param  [integer] $fetchChild 是否遍历子部门
   * @param  [boolean] $simple   是否只查询用户的基本信息
   */
  public function queryUsersByDepartmentId($depId,$fetchChild = 1,$simple = 1){
      if($depId > 0){
//        $interface = $simple == 1 ? "simplelist" : "list";

        $interface = $simple == 1 ? ApiURLConfig::USER_SIMPLELIST : ApiURLConfig::USER_LIST;
        return http_get($this->appendToken($interface . "?department_id=$depId&fetch_child=$fetchChild"))["content"];
      }else{
        return '{"errcode":-1,"errmsg":"departmentId is invalid"}';  
      }
  }

  /*
   * 通过code值获取访问用户身份
   * @param [String] $code  用户授权获取到的code
   * */
  public function getUserInfo($code = '')
  {
        if($code) {
            return http_get($this -> appendToken(ApiURLConfig::USER_CODE . "?code={$code}"));
        } else {
            return '{"errcode": -1, "errmsg": "code is invalid"}';
        }
  }
  /*
   * 二次验证
   * */
  public function authSucc($userid)
  {
      if($userid) {
          return http_get($this -> appendToken(ApiURLConfig::USER_AUTH_SUCC . "?userid={$userid}"));
      } else {
          return '{"errcode": -1, "errmsg": "userid is invalid"}';
      }
  }
}

