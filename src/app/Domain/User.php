<?php
namespace App\Domain;

use App\Model\User as MUser;

class User {
  public function __construct() {
    $this->muser = new Muser();
  }
  public function getSsoOauthInfo() {
    $token = $this->muser->getAccessToken();
    // var_dump($token);
    // PhalApi\DI()->tracer->mark();
    // $token = false;
    // 没有token
    if(!$token) {
      // return ['href' => '/sso-v2/oauth/' . APPID . '?redirect_uri=' . $_GET['redirect_uri']];
      return ['href' => '/sso-v2/api/?s=Oauth.Authorize&appid=' . APPID];
    }
    $user_id = $this->muser->getUserIdByToken($token);
    $user = $this->muser->getUserById($user_id);
    if (!$user) {
      session_destroy();
      return false;
    }
    // $user['group'] = $this->muser->getUserGroup($user_id['id']);
    $_SESSION['user'] = $user;
    return $user;
  }
}