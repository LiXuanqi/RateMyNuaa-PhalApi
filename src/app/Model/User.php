<?php
namespace App\Model;

use Phalapi\Model\NotORMModel as NotORM;

class User extends NotORM {
  public function getAccessToken() {

    // PhalApi\DI()->tracer->mark();
    if (isset($_GET['code'])) {

    //  $res = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/sso-v2/api/oauth/getAccessToken?appid=' . APPID . '&appsecret=' . APPSECRET . '&code=' . $_GET['code']);
    $res = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/sso-v2/api/?s=Oauth.GetAccessToken&appid=' . APPID . '&appsecret=' . APPSECRET . '&code=' . $_GET['code']);
    $data = json_decode($res, true)['data'];
     $_SESSION['access_token'] = $data['access_token'];
     $_SESSION['access_token_expire'] = intval(strtotime(Date('Y-m-d H:i:s')) + $data['expires_in']);
     return $data['access_token'];
    }
    //没有token，跳转到oauth获取
    if (!isset($_SESSION['access_token'])) {
      return false;
    }
    //token过期
    if ($_SESSION['access_token_expire'] <= intval(strtotime(Date('Y-m-d H:i:s')))){
      // $res = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/sso-v2/api/oauth/refresh?appid=' . APPID . '&appsecret=' . APPSECRET . '&old_token=' . $_SESSION['access_token']);
      $res = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/sso-v2/api/?s=Oauth.Refresh&appid=' . APPID . '&appsecret=' . APPSECRET . '&old_token=' . $_SESSION['access_token']);
      $data = json_decode($res, true)['data'];
      $_SESSION['access_token'] = $data['access_token'];
      $_SESSION['access_token_expire'] = intval(strtotime(Date('Y-m-d H:i:s')) + $date['expires_in']);
      return $data['access_token'];
    }
    //正常
    return $_SESSION['access_token'];
  }
  public function GetUserIdByToken($token) {
    $types = implode(',', ['id']);
    // $res = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/sso-v2/api/oauth/getUserInfo?access_token=' . $token . '&types=' . $types);
    $res = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/sso-v2/api/?s=Oauth.GetUserInfo&access_token=' . $token . '&types=' . $types);
    return json_decode($res, true)['data'];
  }
  public function getUserById($user_id) {
    return $this->getORM()
    ->select('`user_id`, `username`, `realname`, `mobile`, `user_group`')
    ->where('user_id', $user_id)
    ->fetchOne();
  }
}