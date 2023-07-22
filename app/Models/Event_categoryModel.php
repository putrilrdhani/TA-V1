<?php

namespace App\Models;


use CodeIgniter\Model;

class Event_categoryModel extends Model
{
    protected $table      = 'event_category';
    protected $primaryKey = 'id_category';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_category', 'name'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('event_category');
            $builder->select('id_category, name', false);
            // $builder->join('event_gallery', 'event.id=event_gallery.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }
        $builder = $this->db->table('event_category');
        $builder->select('id_category, name', false);
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->getResult();
    }
}
