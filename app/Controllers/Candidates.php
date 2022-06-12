<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CandidatesModel;

class Candidates extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index(){
      $model = new CandidatesModel();
      $data['candidates'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }
    // create
    public function create() {
        $model = new CandidatesModel();
        if (!$this->validate([
            'name' => 'required|alpha_space',
            'phone_number' => 'required|integer|max_length[10]|min_length[10]|is_unique[tbl_candidates.phone_number]',
            'email' => 'required|valid_email|is_unique[tbl_candidates.email]',
            'address' => 'required',            
        ])) return $this->fail($this->validator->getErrors());

        $data = [
            'name' => $this->request->getVar('name'),
            'phone_number' => $this->request->getVar('phone_number'),
            'email'  => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
              'success' => 'Candidate created successfully'
            ]
      ];
      return $this->respondCreated($response);
    }
    // single user
    public function show($id = null){
        $model = new CandidatesModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Candidate found');
        }
    }
    // update
    public function update($id = null){
        if (in_array($this->request->getMethod(), ['put', 'patch'])) {    
            $this->data = $this->request->getRawInput();
        } 
        else if ($this->request->isAJAX()) {    
            $this->data = $this->request->getJSON(true);    
        } 
        else {
            $this->data = $this->request->getVar() ?? [];
        }
        $model = new CandidatesModel();
        if (!$this->validate([
            'name' => 'required|alpha_space',
            'phone_number' => 'required|integer|max_length[10]|min_length[10]',
            'email' => 'required|valid_email',
            'address' => 'required',            
        ])) return $this->fail($this->validator->getErrors());
        $data=[
            'name' => $this->data['name'],
            'phone_number' => $this->data['phone_number'],
            'email'  => $this->data['email'],
            'address' => $this->data['address'],
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Candidate updated successfully'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null){
        $model = new CandidatesModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Candidate successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Candidate found');
        }
    }
}