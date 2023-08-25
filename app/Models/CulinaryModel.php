<?php

namespace App\Models;



use App\Controllers\Tourism_facility;
use CodeIgniter\Model;

class CulinaryModel extends Model
{
    protected $table      = 'culinary';
    protected $primaryKey = 'culinary.id';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id', 'name', 'address', 'contact_person', 'capacity', 'open', 'close', 'geom', 'owner', 'url',  'id_gallery'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {


            // return $this
            //     ->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT')
            //     ->select('culinary_gallery.url')
            //     ->select('culinary.*')
            //     ->findAll();
            $builder = $this->db->table('culinary');
            $builder->select('culinary.id AS id_true, culinary.name as name, address, contact_person, capacity, open, close, geom, owner', false);
            // $builder->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT');
            // $builder->join('culinary_facility', 'culinary.id=culinary_facility.id_culinary', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }

        // return $this->db
        // ->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT')
        // ->where($this->primaryKey, $id)->first();
        $builder = $this->db->table('culinary');
        $builder->select('culinary.id AS id_true, culinary.name as name, address, contact_person, capacity, open, close, geom, owner, url, id_gallery', false);
        $builder->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT');
        // $builder->join('culinary_detail_facility', 'culinary.id=culinary_detail_facility.id', 'LEFT');
        // $builder->join('culinary_facility', 'culinary_detail_facility.id_facility=culinary_facility.id_facility', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query1 = $builder->get();
        return $query1->getResult();
    }
}
