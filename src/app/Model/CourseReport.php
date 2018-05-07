<?php
namespace App\Model;

use Phalapi\Model\NotORMModel as NotORM;

class CourseReport extends NotORM {
  protected function getTableName($id) {
    return 'course_report';
  }
  public function reportCourse($r_courseid, $r_type, $r_reason, $r_email){
    $data = array('r_courseid' => $r_courseid, 'r_type' => $r_type, 'r_reason' => $r_reason, 'r_email' => $r_email);
    return $this->getORM()
        ->insert($data);
  }
}
    