<?php
namespace App\Domain;

use App\Model\Comment as MComment;
use App\Model\Course as MCourse;
use App\Model\Useful as MUseful;

class Comment {
    public function __construct() {
        $this->MComment = new MComment();
        $this->MCourse = new MCourse();
        $this->MUseful = new MUseful();
    }

    public function getComment($c_id) {
        return $this->MComment->getComment($c_id);
    }
    public function submitComment($cc_content, $cc_overallquality, $cc_attendance, $cc_difficulty, $cc_grade, $cc_belongtocourseid, $cc_date, $cc_testtype, $cc_userid, $cc_visible) {
        $cc_date = date("Y-m-d");
        // 获得所有评论数据
        $allComment = $this->MComment->getComment($cc_belongtocourseid)->fetchAll();
        $averageOverallQuality = $this->average($allComment,'cc_overallquality',$cc_overallquality);
        $averageAttendance = $this->average($allComment,'cc_attendance',$cc_attendance);
        $averageDifficulty = $this->average($allComment,'cc_difficulty',$cc_difficulty);

        $averageGrade = $this->average($allComment,'cc_grade',$cc_grade);

        $updateData = array('c_mean_overallquality' => $averageOverallQuality,
                            'c_mean_attendance' => $averageAttendance,
                            'c_mean_difficulty' => $averageOverallQuality,
                            'c_mean_grade' => $averageGrade,
                            );
        $update = $this->MCourse->updateCourseMean($cc_belongtocourseid, $updateData);
        // 获取提交者IP
        $ip = $_SERVER["REMOTE_ADDR"];
        $userIp = $ip;
        return $this->MComment->submitComment($cc_content, $cc_overallquality, $cc_attendance, $cc_difficulty, $cc_grade, $cc_belongtocourseid, $cc_date, $cc_testtype, $cc_userid, $userIp, $cc_visible);
    }
    public function deleteComment($cc_id,$cc_userid){
        return $this->MComment->deleteComment($cc_id,$cc_userid);
    }
    public function average($allComment,$type,$thisTimeData){
        $sum = 0;
        $count = 0;
        foreach ($allComment as $row){
            $sum = $sum + intval($row[$type]);
            $count = $count + 1;
        }
        $sum = $sum + $thisTimeData;
        return $average = $sum/($count+1);
    }
    public function addOne($type,$userId,$belongToCommentId){       
        return $this->MUseful->addOne($type,$userId,$belongToCommentId);  
    }
    public function minusOne($type,$userId,$belongToCommentId){
        return $this->MUseful->minusOne($type,$userId,$belongToCommentId);
    }
    public function getUseful($type, $belongToCommentId){
        return $this->MUseful->getUseful($type, $belongToCommentId);
    }
}