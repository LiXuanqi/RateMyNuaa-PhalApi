<?php

namespace App\Model;

use Phalapi\Model\NotORMModel as NotORM;

class Course extends NotORM {
    public function getCourseById($c_id = NULL) {
        if ($c_id === NULL) {
            $sql = "SELECT `c_id`, `c_teacher`, `c_nameid`, `ct_id`, `ct_name`, `ct_type`, `ct_school`, `c_mean_overallquality`, `c_mean_attendance`, `c_mean_grade`, `c_mean_difficulty`, `ct_number` FROM `course` LEFT JOIN `course_type` ON `c_nameid` = `ct_id`";
            return $this->getORM()->queryAll($sql);
            // return $this->getORM()
            //     ->select('*');
        } else {
            // return $this->getORM()
            //     ->where('c_id', $c_id)
            $sql = "SELECT `c_id`, `c_teacher`, `c_nameid`, `ct_id`, `ct_name`, `ct_type`, `ct_school`, `c_mean_overallquality`, `c_mean_attendance`, `c_mean_grade`, `c_mean_difficulty`, `ct_number` FROM `course` LEFT JOIN `course_type` ON `c_nameid` = `ct_id` WHERE `c_id` = $c_id";
            return $this->getORM()->queryAll($sql);
        }

    }
    public function getCourseByType($ct_type) {
        $sql = "SELECT `c_id`, `c_teacher`, `c_nameid`, `ct_id`, `ct_name`, `ct_type`, `ct_school`, `c_mean_overallquality`, `c_mean_attendance`, `c_mean_grade`, `c_mean_difficulty`, `ct_number` FROM `course` LEFT JOIN `course_type` ON `c_nameid` = `ct_id` WHERE `ct_type` = $ct_type";
        return $this->getORM()->queryAll($sql);
    }
    public function getCourseBySchool($ct_school) {
        $sql = "SELECT `c_id`, `c_teacher`, `c_nameid`, `ct_id`, `ct_name`, `ct_type`, `ct_school`, `c_mean_overallquality`, `c_mean_attendance`, `c_mean_grade`, `c_mean_difficulty`, `ct_number` FROM `course` LEFT JOIN `course_type` ON `c_nameid` = `ct_id` WHERE `ct_school` = $ct_school";
        return $this->getORM()->queryAll($sql);
    }
    public function getCourseByName($ct_name) {
        $sql = "SELECT `c_id`, `c_teacher`, `c_nameid`, `ct_id`, `ct_name`, `ct_type`, `ct_school`, `c_mean_overallquality`, `c_mean_attendance`, `c_mean_grade`, `c_mean_difficulty`, `ct_number` FROM `course` LEFT JOIN `course_type` ON `c_nameid` = `ct_id` WHERE `ct_name` = $ct_name";
        return $this->getORM()->queryAll($sql);
    }
    public function updateCourseMean($cc_belongtocourseid, $data){
        $rs = $this->getORM()->where('c_id', $cc_belongtocourseid)->update($data);
    }
}