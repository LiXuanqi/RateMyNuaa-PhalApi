<?php
namespace App\Domain;

use App\Model\CommentReport as MCommentReport;
use App\Model\CourseReport as MCourseReport;

class Report {
  public function __construct() {
      $this->MCommentReport = new MCommentReport();
      $this->MCourseReport = new MCourseReport();
  }
  public function reportComment($r_commentid, $r_type, $r_reason, $r_email) {
    return $this->MCommentReport->reportComment($r_commentid, $r_type, $r_reason, $r_email);
  }
  public function reportCourse($r_courseid, $r_type, $r_reason, $r_email) {
    return $this->MCourseReport->reportCourse($r_courseid, $r_type, $r_reason, $r_email);
  }
  public function showAllReports() {
    return $this->MCommentReport->showAllReports();
  }
}
