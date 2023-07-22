<?php

namespace App\Models;



use CodeIgniter\Model;

class Souvenir_facilityModel extends Model
{
    protected $table      = 'souvenir_facility';
    protected $primaryKey = 'id_facility';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_facility', 'name'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('souvenir_facility');
            $builder->select('id_facility, name', false);
            // $builder->orderBy('id_facility', 'ASC');
            // $builder->join('souvenir_gallery', 'souvenir_place.id=souvenir_gallery.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }
        $builder = $this->db->table('souvenir_facility');
        $builder->select('id_facility, name', false);
        $builder->where($this->primaryKey, $id);
        // $builder->orderBy('id_facility', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
