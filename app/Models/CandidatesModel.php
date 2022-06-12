<?php 
namespace App\Models;
use CodeIgniter\Model;
class CandidatesModel extends Model
{
    protected $table = 'tbl_candidates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','phone_number','email','address'];
}