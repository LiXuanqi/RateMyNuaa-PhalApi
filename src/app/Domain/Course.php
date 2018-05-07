<?php
namespace App\Domain;

use App\Model\Course as MCourse; 

class Course {
    public function __construct() {
        $this->MCourse  = new MCourse();
    }
    public function getCourseById($c_id) {
        return $this->MCourse->getCourseById($c_id);
    }
    public function getCourseByType($ct_type) {
        return $this->MCourse->getCourseByType($ct_type);
    }
    public function getCourseBySchool($ct_school) {
        return $this->MCourse->getCourseBySchool($ct_school);
    }
    public function getCourseByName($ct_name) {
        return $this->MCourse->getCourseByName($ct_name);
    }
}