<?php 


class Exams extends MX_Controller {


    public function __construct()
    {
        $this->load->model('Exam');
    }

    public function index()
    {
        $this->dashboard();
    }


    public function dashboard($action="dashboard")
    {

        $data = $this->Exam->dashboard($action);
        $data['modules'] = $this->Exam->modules();
        $data["active"] = "dashboard";
        serve('dashboard', $data);
    }


    public function config($active = 'subjects')
    {   

        
        $data['allSubjects'] = $this->Exam->allSubjects();
        $data['subjects'] = $this->Exam->subjects();
        $data["modules"] = ['subjects','grading'];
        $data['active'] = $active;
         serve("config/$active", $data) ;
    
    }


    public function configSubject($code)
    {
    
         /* check if subject in broadsheet */
        $codes = array_column($this->Exam->subjects(),'code');

        // $action = in_array($code, $odes)? 
        if(in_array($code, $odes)){
             $this->Exam->deregisterSubject($code);
        }else{
            $this->Exam->registerSubject($code);
        }
    
    }

    public function rebuildPointsRemarks()
    {

    }


    public function saveMarkEntry($id, $subj, $mark)
    {

        $this->db->query("update broadsheet set `$subj` = '$mark' where id = '$id'");
        
    }
}