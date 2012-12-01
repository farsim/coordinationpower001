<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminmodel
 *
 * @author sky labs
 */
class AdminModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function logins($username, $password) {
        $string = "SELECT u.*, uu.UnionId, un.UnionName from 
                   user u inner join userunion uu
                   ON u.UserId = uu.UserId 
                   inner join unions un
                   ON uu.UnionId = un.UnionId 
                   WHERE
                   u.username = ?
                   AND u.password = ?
                   AND u.Status = ?
                   AND uu.Status = ?";
        $query = $this->db->query($string, array($username, md5($password), 1, 1));
        $status = $query->num_rows();

        if ($status == 1) {
            $userData = $query->row();
            $sessionData = array(
                'userID' => $userData->UserId,
                'username' => $userData->UserName,
                'email' => $userData->Email,
                'user_type' => $userData->Type,
                'union_name' => $userData->UnionName,
                'union_id' => $userData->UnionId,
            );

            $this->session->set_userData($sessionData);
            return $sessionData;
        } else {
            return FALSE;
        }
    }

    public function getMeetingList($unionId) {
        $string = "SELECT * FROM meeting where UnionId=? and Status=?";
        $query = $this->db->query($string,array($unionId, 1));
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function getAgendaList() {
        $string = "SELECT * FROM agenda where Status = 1";
        $query = $this->db->query($string);
        if ($query->num_rows() > 0) {
            $agendaList = $query->result();
            /* $meetingAgendaDataArray[] = array();
              for($i=0;$i<count($agendaList);$i++){
              $meetingAgendaDataArray[] = array(
              'AgendaId'=>$agendaList[$i]->AgendaId,
              'MeetingId'=>1,
              );
              }
              echo '<pre>';
              print_r($meetingAgendaDataArray);exit; */
            return $agendaList;
        } else {
            return FALSE;
        }
    }

    public function getUnionWiseUserList() {
        $string = "SELECT u.* from 
                   user u inner join userunion uu
                   ON u.UserId = uu.UserId 
                   WHERE
                   u.Type = ?
                   AND uu.UnionId=?
                   AND u.Status = ?
                   AND uu.Status = ?";
        $query = $this->db->query($string, array(0, $this->session->userdata('union_id'), 1, 1));
        if ($query->num_rows() > 0) {
            $unionWiseUserList = $query->result();
            return $unionWiseUserList;
        } else {
            return FALSE;
        }
    }

    public function insertMeeting($userList, $unionId, $createMeetingTime) {
        $this->db->trans_start();
        $meetingDataArray = array(
            'MeetingDate' => time($createMeetingTime),
            'UnionId' => $unionId,
            'Status' => 1
        );
        $this->db->insert('meeting', $meetingDataArray);
        $insertedMeetingId = $this->db->insert_id();

        if ($this->getAgendaList()) {
            $agendaList = $this->getAgendaList();
            $meetingAgendaDataArray = array();
            for ($i = 0; $i < count($agendaList); $i++) {

                $meetingAgendaDataArray = array(
                    'AgendaId' => $agendaList[$i]->AgendaId,
                    'MeetingId' => $insertedMeetingId,
                );
                $this->db->insert('meetingagenda', $meetingAgendaDataArray);
                #$meetingAgendaDataArray['AgendaId'] = $agendaList[$i]->AgendaId;
                #$meetingAgendaDataArray['MeetingId'] = $insertedMeetingId;
            }

            //$this->db->insert_batch('meetingagenda',$meetingAgendaDataArray);
        }

        if (is_array($userList)) {
            $userMeetingDataArray = array();
            for ($i = 0; $i < count($userList); $i++) {
                $userMeetingDataArray = array(
                    'UserId' => $userList[$i],
                    'MeetingId' => $insertedMeetingId,
                );
                $this->db->insert('usermeeting', $userMeetingDataArray);
                #$userMeetingDataArray['UserId'] = $userList[$i];
                #$userMeetingDataArray['MeetingId'] = $insertedMeetingId;
            }
            //$this->db->insert_batch('usermeeting',$userMeetingDataArray);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function date_check($str) {
        
        $string = "SELECT max(MeetingId),MeetingDate FROM meeting";
        $query = $this->db->query($string);
        
        if ($query->num_rows() == 1) {
            $dateArray = $query->result();
            $date = getdate($dateArray[0]->MeetingDate);
            
            $dbDate = $date['mday'] . ' ' . $date['month'] . ', ' . $date['year'];
            //echo $dbDate;exit;
            if($dbDate == $str){
                return FALSE;
            }
            else{
                return TRUE;
            }
            
        }
        return true;
    }
    
    /*public function meetingWiseAgendaList($MeetingId){
        $string = "SELECT * FROM agenda where Status = 1";
        $query = $this->db->query($string);
        if ($query->num_rows() > 0) {
            $agendaList = $query->result();
            
            return $agendaList;
        } else {
            return FALSE;
        }
    }*/
    
    public function getQuestions($flag=0){
        $string = "SELECT MAX(MeetingId) MeetingId from meeting";
        $query = $this->db->query($string);
        if($query->num_rows() == 1)
        {
            $result = $query->result();
            $maxMeetingId = $result[0]->MeetingId;
            if($maxMeetingId){
                $stringAttendanceCheck = "Select UserMeetingId from UserMeeting where UserId = ? AND MeetingId= ?";
                
                $queryAttendanceCheck = $this->db->query($stringAttendanceCheck,array($this->session->userdata('userID'),$maxMeetingId));
                
                if($queryAttendanceCheck->num_rows() == 1){
                    $resultAttendanceCheck = $queryAttendanceCheck->result();
                    $userMeetingId = $resultAttendanceCheck[0]->UserMeetingId;
                    if($flag == 1)
                        return $userMeetingId;
                    $strAgendaList = "SELECT A.*, MA.MeetingAgendaId
                        FROM Agenda A inner join MeetingAgenda MA 
                        on A.AgendaId = MA.AgendaId
                        WHERE MA.MeetingId = ?";
                    $queryAgendaList = $this->db->query($strAgendaList,array($maxMeetingId));
                    if($queryAgendaList->num_rows() > 0){
                        return $queryAgendaList->result();
                    }else{
                        return FALSE;
                    }
                }else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

}

