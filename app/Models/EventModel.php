<?php

namespace App\Models;



use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table      = 'event';
    protected $primaryKey = 'event.id';
    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id', 'name', 'date_start', 'date_end', 'description', 'ticket_price', 'contact_person', 'url', 'id_event'];

    // GET ALL DATA
    public function getData($id = false)
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
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getResult();
        // return $this->db->where($this->primaryKey, $id)->first();
    }
}
