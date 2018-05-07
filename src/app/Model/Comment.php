<?php
namespace App\Model;

use Phalapi\Model\NotORMModel as NotORM;

class Comment extends NotORM {
    protected function getTableName($id) {
        return 'course_comment';
    }
    public function getComment($c_id) {
        $result = $this->getORM()
                    ->where(array('cc_belongtocourseid' => $c_id, 'cc_visible' => 1));
        // var_dump($result->fetchAll());
        // PhalApi\DI()->tracer->mark('DO_SOMETHING');
        // $result = $result->fetchAll()[1]['cc_date'];

        return $result;
    }
    public function submitComment($cc_content, $cc_overallquality, $cc_attendance, $cc_difficulty, $cc_grade, $cc_belongtocourseid, $cc_date, $cc_testtype, $cc_userid, $cc_userip, $cc_visible) {
        $data = array('cc_content' => $cc_content, 'cc_overallquality' => $cc_overallquality, 'cc_attendance' => $cc_attendance, 'cc_difficulty' => $cc_difficulty, 'cc_grade' => $cc_grade, 'cc_belongtocourseid' => $cc_belongtocourseid, 'cc_date' => $cc_date, 'cc_testtype' => $cc_testtype, 'cc_userid' => $cc_userid, 'cc_userip' => $cc_userip, 'cc_visible' => $cc_visible);
        return $this->getORM()
            ->insert($data);
    }
    public function deleteComment($cc_id, $cc_userid){
        $data = array('cc_visible' => 0);
        return $this->getORM()
                    ->where(array('cc_id' => $cc_id, 'cc_userid' => $cc_userid))
                    ->update($data);
    }
}
