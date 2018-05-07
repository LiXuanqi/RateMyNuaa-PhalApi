<?php

namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;

use App\Domain\Course as DCourse;

class Course extends Api {
    public function getRules() {
        return array(
            'getCourseById' => array(
                'id' => array('name' => 'c_id'),
            ),
            'getCourseBytype' => array(
                'type' => array('name' => 'ct_type'),
            ),
            'getCourseBySchool' => array(
                'school' => array('name' => 'ct_school'),
            ),
            'getCourseByName' => array(
                'courseName' => array('name' => 'ct_name'),
            ),
        );
    }
    public function __construct() {
        $this->DCourse = new Dcourse();
    }
    public function getCourseById() {
        return $this->DCourse->getCourseById($this->id);
    }
    public function getCourseByType() {
        return $this->DCourse->getCourseByType($this->type);
    }
    public function getCourseBySchool() {
        return $this->DCourse->getCourseBySchool($this->school);
    }
    public function getCourseByName() {
        return $this->DCourse->getCourseByName($this->courseName);
    }
}