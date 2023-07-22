<?php

namespace App\Models;



use CodeIgniter\Model;

class HomestayModel extends Model
{
    protected $table      = 'homestay';
    protected $primaryKey = 'id';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['homestay.id', 'name', 'address', 'contact_person', 'capacity', 'open', 'close', 'price', 'geom', 'owner'];

    // GET ALL DATA
    public function getData($id = false)
    {
        if ($id == false) {


            // return $this
            //     ->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT')
            //     ->select('culinary_gallery.url')
            //     ->select('culinary.*')
            //     ->findAll();
            $builder = $this->db->table('homestay');
            $builder->select('homestay.id AS id_true, homestay.name as name, address, contact_person, capacity, open, close, price, geom, owner', false);
            // $builder->join('homestay_gallery', 'culinary.id=culinary_gallery.id', 'LEFT');
            // $builder->join('culinary_facility', 'culinary.id=culinary_facility.id_culinary', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }

        // return $this->db
        // ->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT')
        // ->where($this->primaryKey, $id)->first();
        $builder = $this->db->table('homestay');
        $builder->select('homestay.id AS id_true, homestay.name as name, address, contact_person, capacity, open, close, price, geom, owner, url, homestay_facility.name as namex,id_gallery', false);
        $builder->join('homestay_gallery', 'homestay.id=homestay_gallery.id', 'LEFT');
        $builder->join('homestay_detail_facility', 'homestay.id=homestay_detail_facility.id', 'LEFT');
        $builder->join('homestay_facility', 'homestay_detail_facility.id_facility=homestay_facility.id_facility', 'LEFT');
        $builder->where("homestay.id", $id);
        $query1 = $builder->get();
        return $query1->getResult();
    }
}
