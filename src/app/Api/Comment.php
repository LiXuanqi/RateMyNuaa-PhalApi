<?php

namespace App\Api;

use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;
use PhalApi\Api;
use App\Domain\Comment as DComment;

class Comment extends Api {
    public function getRules() {
        return array(
            'getComment' => array(
                'id' => array('name' => 'c_id'),
            ),
            'submitComment' =>array(
                'content' => array('name' => 'content','source' => 'post'),
                'overallquality' => array('name' => 'overallquality','source' => 'post'),
                'attendance' => array('name' => 'attendance', 'source' => 'post'),
                'difficulty' => array('name' => 'difficulty','source' => 'post'),
                'grade' => array('name' => 'grade','source' => 'post'),
                'belongtocourseid' => array('name' => 'belongtocourseid','source' => 'post'),
                'date' => array('name' => 'date','source' => 'post'),
                'testType' => array('name' => 'testType','source'=>'post'),
                'userId' => array('name' => 'userId', 'source' => 'post'),
                'visible' => array('name' => 'visible', 'source' => 'post'),
            ),
            'deleteComment' => array(
                'commentId' => array('name' => 'commentId', 'source' => 'post'),
                'userId' => array('name' => 'userId', 'source' => 'post'),
            ),
            'addOne' => array(
                'type' => array('name' => 'type', 'source' => 'post'),
                'userId' => array('name' => 'userId', 'source' => 'post'),
                'belongToCommentId' => array('name' => 'belongToCommentId', 'source' => 'post'),
            ),
            'minusOne' => array(
                'type' => array('name' => 'type', 'source' => 'post'),
                'userId' => array('name' => 'userId', 'source' => 'post'),
                'belongToCommentId' => array('name' => 'belongToCommentId', 'source' => 'post'),
            ),
            'getUseful' => array(
                'type' => array('name' => 'type'),
                'belongToCommentId' => array('name' => 'belongToCommentId'),
            ),
        );
    }
    
    public function __construct() {
        $this->DComment = new DComment();
    }
    public function getComment() {
        return $this->DComment->getComment($this->id);
        
    }
    public function submitComment() { 
        // if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        //     throw new BadRequestException('user_not_login',1);
        // }
        return $this->DComment->submitComment($this->content, $this->overallquality, $this->attendance, $this->difficulty, $this->grade, $this->belongtocourseid, $this->date, $this->testType, $this->userId, $this->visible);    
    }
    public function deleteComment() {
        // if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        //     throw new BadRequestException('user_not_login',1);
        // }
        return $this->DComment->deleteComment($this->commentId, $this->userId);
    }
    public function addOne() {
        // if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        //     throw new BadRequestException('user_not_login',1);
        // }
        return $this->DComment->addOne($this->type, $this->userId, $this->belongToCommentId);
    }
    public function minusOne() {
        // if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        //     throw new BadRequestException('user_not_login',1);
        // }
        return $this->DComment->minusOne($this->type, $this->userId, $this->belongToCommentId);
    }
    public function getUseful() {
        return $this->DComment->getUseful($this->type, $this->belongToCommentId);
    }
}
