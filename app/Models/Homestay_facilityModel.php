<?php

namespace App\Models;

use CodeIgniter\Model;

class Homestay_facilityModel extends Model
{
    protected $table      = 'homestay_facility';
    protected $primaryKey = 'id_facility';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_facility', 'name'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {

            $builder = $this->db->table('homestay_facility');
            $builder->select('id_facility, name', false);
            // $builder->join('event_gallery', 'event.id=event_gallery.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }
        return $this->db->where($this->primaryKey, $id)->first();
    }
}
