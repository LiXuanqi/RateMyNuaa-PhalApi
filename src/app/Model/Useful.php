<?php
namespace App\Model;

use Phalapi\Model\NotORMModel as NotORM;

class Useful extends NotORM {
    protected function getTableName($id) {
        return 'comment_useful';
  }

    public function addOne($type,$userId,$belongToCommentId){
        $data = array('cu_type' => $type, 'cu_userid' => $userId, 'cu_belongtocommentid' => $belongToCommentId);
        return $this->getORM()
            ->insert($data);
    }
    public function minusOne($type,$userId,$belongToCommentId){
        return $this->getORM()
            ->where(array('cu_type' => $type, 'cu_userid' => $userId, 'cu_belongtocommentid' => $belongToCommentId))
            ->delete(1);
    }
    public function getUseful($type, $belongToCommentId){
        $result = $this->getORM()
        ->where(array('cu_type' => $type, 'cu_belongtocommentid' => $belongToCommentId));
        return $result;
    }
}