<?php

namespace App\Models;



use CodeIgniter\Model;

class Worship_placeModel extends Model
{
    protected $table      = 'worship_place';
    protected $primaryKey = 'worship_place.id';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id', 'name', 'address', 'capacity', 'geom', 'url', 'id_gallery'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('worship_place');
            $builder->select('worship_place.id AS id_true, name, address, capacity, geom', false);
            // $builder->join('worship_gallery', 'worship_place.id=worship_gallery.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }

        $builder = $this->db->table('worship_place');
        $builder->select('worship_place.id AS id_true, name, address, capacity, geom, url,id_gallery', false);
        $builder->join('worship_gallery', 'worship_place.id=worship_gallery.id', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
}
