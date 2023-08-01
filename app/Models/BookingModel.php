<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'booking';
    protected $primaryKey = 'booking.date';
    protected $allowedFields = ['date', 'id', 'id_package', 'purchase_date', 'purchase_time', 'total_member', 'status', 'comment'];

    // GET ALL DATA
    public function getData($id = false, $id_user = false, $id_package = false)
    {
        if ($id == false) {

            $builder = $this->db->table('booking');
            $builder->select('booking.date as booking_date, booking.id as id_user, users.username, booking.id_package, purchase_date, purchase_time, total_member, booking.status, comment', false);
            $builder->join('users', 'booking.id = users.id', 'LEFT');
            $query = $builder->get();
            return $query->getResult();
        }

        $builder = $this->db->table('booking');
        $builder->select('booking.date as booking_date, booking.id as id_user, booking.id_package, purchase_date, purchase_time, total_member, booking.status, comment,username', false);
        $builder->join('package', 'booking.id_package = package.id_package', 'LEFT');
        $builder->join('users', 'booking.id = users.id', 'LEFT');
        $builder->where('booking.date', $id);
        $builder->where('booking.id_package', $id_package);

        $query1 = $builder->get();
        return $query1->getResult();
    }
}
