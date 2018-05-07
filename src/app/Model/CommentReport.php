<?php
namespace App\Model;

use Phalapi\Model\NotORMModel as NotORM;

class CommentReport extends NotORM {
  protected function getTableName($id) {
    return 'comment_report';
  }
  public function reportComment($r_commentid, $r_type, $r_reason, $r_email){
    $data = array('r_commentid' => $r_commentid, 'r_type' => $r_type, 'r_reason' => $r_reason, 'r_email' => $r_email);
    return $this->getORM()
        ->insert($data);
  }
  public function showAllReports(){
    $sql = "SELECT `r_id`, `r_visible`, `cc_id`, `cc_content` FROM `report` LEFT JOIN `course_comment` ON `r_commentid` = `cc_id`";
    return $this->getORM()->queryAll($sql);
  }
}
    