<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminuser
 *
 * @author sky labs
 */
class AdminUser extends MX_Controller {

    public $data;

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userID')) {
            redirect(base_url() . 'admin');
        }

        if ($this->session->userdata('user_type') != 1) {
            redirect(base_url() . 'admin/user');
        }

        $this->layout->setLayout('adminuser');
        $this->load->model('AdminModel');
    }

    public function index() {
        $this->data['username'] = $this->session->userdata('username');
        $this->data['unionname'] = $this->session->userdata('union_name');
        $this->layout->view('adminuser', $this->data);
    }

    public function UserMgt() {
        $this->layout->view('adminuser', $this->data);
    }

    public function MeetingMgt() {
        if($this->AdminModel->getMeetingList($this->session->userdata('union_id'))){
            $this->data['meetingList'] = $this->AdminModel->getMeetingList($this->session->userdata('union_id'));
        }
        
        $this->layout->view('meetingmgt', $this->data);
    }

    public function CreateMeeting() {
        $time = getdate(time());
        $this->data['date'] = $time['mday'] . ' ' . $time['month'] . ', ' . $time['year'];
        if ($this->AdminModel->getAgendaList()) {
            $this->data['agendaList'] = $this->AdminModel->getAgendaList();
        }
        if ($this->AdminModel->getUnionWiseUserList()) {
            $this->data['unionWiseUserList'] = $this->AdminModel->getUnionWiseUserList();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('createMeetingTime', 'Date', 'required|xss_clean');

            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            if ($this->form_validation->run()) {
                $createMeetingTime = trim($this->input->post('createMeetingTime', true));
                if (!$this->AdminModel->date_check($createMeetingTime)) {
                    $this->data['errorMessage'] = 'Sorry! Meeting setup for today is completed!';
                } else {
                    
                    if ($this->AdminModel->insertMeeting($_POST['userList'], $this->session->userdata('union_id'), $createMeetingTime)) {
                        redirect(base_url() . 'admin/adminuser/meetingmgt');
                    } else {
                        $this->data['errorMessage'] = 'there is happening error';
                    }
                }
            }
        }
        $this->layout->view('createmeeting', $this->data);
    }
    
    public function MeetingHistory($meetingId){
        
    }

}

?>
