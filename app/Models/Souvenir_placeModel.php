<?php

namespace App\Models;


use CodeIgniter\Model;

class Souvenir_placeModel extends Model
{
    protected $table      = 'souvenir_place';
    protected $primaryKey = 'souvenir_place.id';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id', 'name', 'address', 'contact_person', 'owner', 'geom', 'open', 'close', 'url', 'id_gallery'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('souvenir_place');
            $builder->select('souvenir_place.id AS id_true, name, address, contact_person, owner, geom, open, close', false);
            // $builder->join('souvenir_gallery', 'souvenir_place.id=souvenir_gallery.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('souvenir_place');
        $builder->select('souvenir_place.id AS id_true, name, address, contact_person, owner, geom, open, close, url, id_gallery', false);
        $builder->join('souvenir_gallery', 'souvenir_place.id=souvenir_gallery.id', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
}
