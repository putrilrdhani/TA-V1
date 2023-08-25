<?php

namespace App\Models;


use CodeIgniter\Model;

class Tourism_objectModel extends Model
{
    protected $table      = 'tourism_object';
    protected $primaryKey = 'tourism_object.id';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id', 'name', 'address', 'open', 'close', 'ticket_price', 'geom', 'contact_person', 'url', 'id_gallery'];

    // GET ALL DATA

    public function getFacility($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_facility');
            $builder->select('id_facility,name as f_name', false);

            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }

        // return $this->db->where($this->primaryKey, $id)->first();
    }

    public function getWorshipId($id = false)
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
        $builder->select('worship_place.id AS id_true, name, address, capacity, geom, url, id_gallery', false);
        $builder->join('worship_gallery', 'worship_place.id=worship_gallery.id', 'LEFT');
        $builder->where("worship_place.id", $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSouvenirId($id = false)
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
        $builder->where("souvenir_place.id", $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getEventId($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('event');
            $builder->select('ST_AsGeoJson(geom) as geom, event.id AS id_true, name, date_start, date_end, description, ticket_price, contact_person', false);
            // $builder->join('event_gallery', 'event.id=event_gallery.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }

        $builder = $this->db->table('event');
        $builder->select('ST_AsGeoJson(geom) as geom,event.id AS id_true, name, date_start, date_end, description, ticket_price, contact_person,  event_gallery.url as url,event_video.url as url_video, id_gallery,id_video', false);
        $builder->join('event_gallery', 'event.id=event_gallery.id', 'LEFT');
        $builder->join('event_video', 'event.id=event_video.id', 'LEFT');
        $builder->where("event.id", $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getCulinaryId($id = false)
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
        $builder->where("culinary.id", $id);
        $query1 = $builder->get();
        return $query1->getResult();
    }

    public function getHomestayId($id = false)
    {
        if ($id == false) {


            // return $this
            //     ->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT')
            //     ->select('culinary_gallery.url')
            //     ->select('culinary.*')
            //     ->findAll();
            $builder = $this->db->table('homestay');
            $builder->select('homestay.id AS id_true, homestay.name as name, address, contact_person, capacity, price, geom, owner', false);
            // $builder->join('homestay_gallery', 'culinary.id=culinary_gallery.id', 'LEFT');
            // $builder->join('culinary_facility', 'culinary.id=culinary_facility.id_culinary', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }

        // return $this->db
        // ->join('culinary_gallery', 'culinary.id=culinary_gallery.id', 'LEFT')
        // ->where($this->primaryKey, $id)->first();
        $builder = $this->db->table('homestay');
        $builder->select('homestay.id AS id_true, homestay.name as name, address, contact_person, capacity, price, geom, owner, url, homestay_facility.name as namex,id_gallery', false);
        $builder->join('homestay_gallery', 'homestay.id=homestay_gallery.id', 'LEFT');
        $builder->join('homestay_detail_facility', 'homestay.id=homestay_detail_facility.id', 'LEFT');
        $builder->join('homestay_facility', 'homestay_detail_facility.id_facility=homestay_facility.id_facility', 'LEFT');
        $builder->where("homestay.id", $id);
        $query1 = $builder->get();
        return $query1->getResult();
    }

    public function getWorship($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('worship_category');
            $builder->select('id_category,name', false);

            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }

        // return $this->db->where($this->primaryKey, $id)->first();
    }
    public function getDataAll($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person', false);
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');

            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_object');
        $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person, url, id_gallery', false);
        $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
    public function getData($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_object.id AS id_true,tourism_object.name as name, address, open, close, ticket_price, geom, contact_person', false);
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
            $builder->where('id_category', 1);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_object');
        $builder->select('tourism_object.id AS id_true,tourism_object.name as name, address, open, close, ticket_price, geom, contact_person, tourism_gallery.url as url,tourism_video.url as url_video, id_gallery,id_video, tourism_facility.name as f_name, tourism_object.id_category AS id_category, tourism_category.name as c_name', false);
        $builder->join('tourism_category', 'tourism_object.id_category=tourism_category.id_category', 'LEFT');
        $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->join('tourism_video', 'tourism_object.id=tourism_video.id', 'LEFT');
        $builder->join('tourism_detail_facility', 'tourism_object.id=tourism_detail_facility.id', 'LEFT');
        $builder->join('tourism_facility', 'tourism_detail_facility.id_facility=tourism_facility.id_facility', 'LEFT');

        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
    public function getDataData($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_object.id AS id_true,tourism_video.url as url_video,tourism_object.name as name, address, open, close, ticket_price, geom, contact_person, tourism_category.name as c_name', false);
            $builder->join('tourism_category', 'tourism_object.id_category=tourism_category.id_category', 'LEFT');
            $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
            $builder->join('tourism_video', 'tourism_object.id=tourism_video.id', 'LEFT');
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
            $builder->where('tourism_object.id_category', 1);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_object');
        $builder->select('tourism_object.id AS id_true,tourism_object.name as name, address, open, close, ticket_price, geom, contact_person, tourism_gallery.url as url,tourism_video.url as url_video, id_gallery,id_video', false);
        $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->join('tourism_video', 'tourism_object.id=tourism_video.id', 'LEFT');

        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
    public function getDataFacility($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_facility.name as name', false);
            $builder->join('tourism_detail_facility', 'tourism_object.id=tourism_detail_facility.id', 'LEFT');
            $builder->join('tourism_facility', 'tourism_detail_facility.id_facility=tourism_facility.id_facility', 'LEFT');
            $builder->where('id_category', 1);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_detail_facility');
        $builder->select('name', false);
        $builder->join('tourism_facility', 'tourism_detail_facility.id_facility=tourism_facility.id_facility', 'LEFT');
        $builder->where("tourism_detail_facility.id", $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }

    public function getDataTourism($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person', false);
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
            $builder->where('id_category', 2);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_object');
        $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person, url, id_gallery', false);
        $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }

    public function getDataPackage($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('package');
            $builder->select('id_package, name, min_capaity,contact_person,description,brosur_url,price', false);
            $builder->where('custom', "0");
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
            // $builder->where('id_category', 2);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('package');
        $builder->select('id_package, name, min_capaity,contact_person,description,brosur_url,price', false);
        // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->where("id_package", $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }

    public function getDataBooking($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('booking');
            $builder->select('date, id, id_package, purchase_date, purchase_time, total_member, status, comment', false);
            // $builder->join('tourism_gallery, tourism_object.id=tourism_gallery.id, LEFT');
            // $builder->where('id_category', 2);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('booking');
        $builder->select('date, id, id_package, purchase_date, purchase_time, date, total_member, status, comment', false);
        // $builder->join('tourism_gallery, tourism_object.id=tourism_gallery.id, LEFT');
        $builder->where("id", $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }



    public function getDataTourismAll($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person', false);
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');

            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_object');
        $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person, url, id_gallery', false);
        $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }

    public function getDataTourismAgro($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('tourism_object');
            $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person', false);
            // $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
            $builder->where('id_category', 1);
            $query = $builder->get();
            return $query->getResult();
            // return $this->findAll();
        }
        $builder = $this->db->table('tourism_object');
        $builder->select('tourism_object.id AS id_true,name, address, open, close, ticket_price, geom, contact_person, url, id_gallery', false);
        $builder->join('tourism_gallery', 'tourism_object.id=tourism_gallery.id', 'LEFT');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
}
