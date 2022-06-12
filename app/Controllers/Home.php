<?php

namespace App\Controllers;
use App\Models\CandidatesModel;
class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function recruiter_application()
    {
        return view('recruiter_application');
    }

    public function restfullapi()
    {
        return view('restfullapi');
    }

    public function Candidates(){
        $limit=$this->request->getVar('limit');
        $offset=($this->request->getVar('per_page')) ? $this->request->getVar('per_page') : 0;
        $searching=trim($this->request->getVar('searching'));  
        $model = new CandidatesModel();      
        $total_rows=$model->countAll();
        if(!empty($searching)){
            $candidates=$model->orderBy('id','DESC')->like('name',$searching)->orLike('phone_number',$searching)->orLike('email',$searching)->findAll($limit,$offset);
        }
        else{
            $candidates=$model->orderBy('id','DESC')->findAll($limit,$offset);
        }
        
        $response=array(
            'candidates'=>$candidates,
            'limit'=>$limit,
            'current_records'=>count($candidates),
            'total_rows'=>$total_rows
        );
        return json_encode($response);
    }
}
