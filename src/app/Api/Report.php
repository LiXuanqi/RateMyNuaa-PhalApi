<?php

namespace App\Api;

use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;
use PhalApi\Api;
use App\Domain\Report as DReport;

class Report extends Api {
    public function getRules() {
        return array(
            'reportComment' => array(
                'commentId' => array('name' => 'commentId', 'source' => 'post'),
                'reportType' => array('name' => 'reportType', 'source' => 'post'),
                'reportReason' => array('name' => 'reportReason', 'source' => 'post'),
                'reporterEmail' => array('name' => 'reporterEmail', 'source' => 'post'),
            ),
            'reportCourse' => array(
                'courseId' => array('name' => 'courseId', 'source' => 'post'),
                'reportType' => array('name' => 'reportType', 'source' => 'post'),
                'reportReason' => array('name' => 'reportReason', 'source' => 'post'),
                'reporterEmail' => array('name' => 'reporterEmail', 'source' => 'post'),
            ),
        );
    }
    
    public function __construct() {
        $this->DReport = new DReport();
    }
    public function reportComment() {
        return $this->DReport->reportComment($this->commentId, $this->reportType, $this->reportReason, $this->reporterEmail);
    }
    public function reportCourse() {
        return $this->DReport->reportCourse($this->courseId, $this->reportType, $this->reportReason, $this->reporterEmail);
    }
    public function showAllReports() {
        return $this->DReport->showAllReports();
    }
}