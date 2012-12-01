<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author sky labs
 */
class User extends MX_Controller {
    //put your code here
    public $data;
    public function __construct() {
        parent::__construct();
        
        if(!$this->session->userdata('userID')){
            redirect(base_url().'admin');
        }
        if($this->session->userdata('user_type') != 0){
            redirect(base_url().'admin/adminuser');
        }
        
        $this->layout->setLayout('user');
        $this->load->model('AdminModel');
    }
    
    public function index(){
        $this->data['username'] = $this->session->userdata('username');
        $this->layout->view('user',$this->data);
    }
    
    public function review(){
        if($this->AdminModel->getQuestions()){
            $this->data['questionList'] = $this->AdminModel->getQuestions();
            
        }
        if($this->AdminModel->getQuestions(1)){
            $this->data['userMeetingId'] = $this->AdminModel->getQuestions(1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            foreach($_POST as $key=>$value){
            $this->form_validation->set_rules($key,'Question','required|xss_clean');    
            }
            
            if($this->form_validation->run()){
                
                for($i=1;$i<6;$i++){
                    $string="select * from review where MeetingAgendaId=? and UserMeetingId=?";
                    $query=$this->db->query($string,array($this->input->post('meetingAgendaId_'.$i),$this->input->post('userMeetingId')));
                    if($query->num_rows() > 0){
                        $this->data['ErrorMessage'] = "You have already reviewed the agenda";
                        
                        redirect(base_url().'admin/user/errorMessage');
                    }
                            
                    $arrayData = array(
                        'MeetingAgendaId'=>$this->input->post('meetingAgendaId_'.$i),
                        'UserMeetingId'=>$this->input->post('userMeetingId'),
                        'Review'=>$this->input->post('question_'.$i),
                    );
                    $this->db->insert('Review',$arrayData);
                }
                redirect(base_url());
            }
            else{
                $this->data['ErrorMessage'] = "Please give all the answers";
            }
        }
        $this->layout->view('review',$this->data);
    }
    
    public function errorMessage(){
        $this->layout->view('errorMessage',$this->data);
    }
}

?>
