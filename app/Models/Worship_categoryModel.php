<?php

namespace App\Models;



use CodeIgniter\Model;

class Worship_categoryModel extends Model
{
    protected $table      = 'worship_category';
    protected $primaryKey = 'id_category';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_category', 'name'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->db->where($this->primaryKey, $id)->first();
    }
}
