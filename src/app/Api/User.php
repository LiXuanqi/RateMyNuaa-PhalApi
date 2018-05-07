<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;

use App\Domain\User as DUser;

class User extends Api {
  public function __construct() {
    $this->duser = new DUser();
  }

  // public function getRules() {
  //   return [
  //     'getSsoOauthInfo' => [
  //         'code' => ['name' => 'code', 'source' => 'get', 'require' => true],
  //     ],
  //   ];
  // }

  public function current() {
    // if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    //   throw new BadRequestException('user_not_login',1);
    // }
    return $_SESSION['user'];
  }

  public function getSsoOauthInfo() {
    return $this->duser->getSsoOauthInfo();
  }

  public static function logout() {
    session_destroy();
    return;
  }
}
