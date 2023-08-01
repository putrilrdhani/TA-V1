<?php

namespace App\Controllers;


use App\Models\BookingModel;

class Booking extends BaseController
{
    /**
     * Class constructor.
     */
    protected $PageData;
    protected $Model; //Default Models Of this Controler
    protected $pager;
    public function __construct()
    {
        $this->Model = new BookingModel(); //Set Default Models Of this Controler
        $this->PageData = $this->attributePage(); //Attribute Of Page
        $pager = \Config\Services::pager();
    }

    //ATRIBUTE THIS PAGE
    private function attributePage()
    {
        return  [
            'title' => 'Booking',
            'app' => '',
        ];
    }

    //INDEX 
    public function index()
    {
        $data = [
            'AttributePage' => $this->PageData,
            'content' => 'Booking Package',
            // 'data' => $this->Model->paginate(5, 'paging'),
            'data' => $this->Model->getData(),
            'pager' => $this->Model->pager,
            // 'data1' => $this->Model->getData()
        ];
        return view('booking/index_booking', $data);
    }

    //READ

    public function confirm_booking($id_user, $booking_date, $id_package, $comment)
    {

        $db = \Config\Database::connect();
        $query   = $db->query("UPDATE `booking` SET `status` = '1', `comment` = '" . $comment . "' WHERE `date` = '" . $booking_date . "' AND `id`='" . $id_user . "' AND `id_package`='" . $id_package . "';");
        // return redirect()->to(base_url('booking'));
        // echo "UPDATE `booking` SET `status` = '1', `comment` = '" . $comment . "' WHERE `date` = '" . $booking_date . "' AND `id`='" . $id_user . "' AND `id_package`='" . $id_package . "';";
        // echo 'masuk';
    }
    public function decline_booking($id_user, $booking_date, $id_package, $comment)
    {

        $db = \Config\Database::connect();
        $query   = $db->query("UPDATE `booking` SET `status` = '2', `comment` = '" . $comment . "' WHERE `date` = '" . $booking_date . "' AND `id`='" . $id_user . "' AND `id_package`='" . $id_package . "';");
        // return redirect()->to(base_url('booking'));
        var_dump($query);
    }
    public function read($id_user, $id, $id_package)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT id_package, purchase_date,purchase_time,date,total_member,booking.status as status,comment, users.username as username, booking.id as id FROM booking JOIN users ON booking.id= users.id WHERE booking.id="' . $id . '"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                // 'geometry' => json_decode($row['geom']),
                'properties' => array(
                    // 'id_booking' => $row['id_booking'],
                    'id_package' => $row['id_package'],
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'purchase_date' => $row['purchase_date'],
                    'purchase_time' => $row['purchase_time'],
                    'date' => $row['date'],
                    'total_member' => $row['total_member'],
                    'status' => $row['status'],
                    'comment' => $row['comment'],
                )
            );
            array_push($hasil['features'], $features);
        }
        $query_user   = $db->query('SELECT id, username FROM users');
        $hasil_user = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_user->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                // 'geometry' => json_decode($row['geom']),
                'properties' => array(
                    'id' => $row['id'],
                    'username' => $row['username'],
                )
            );
            array_push($hasil_user['features'], $features);
        }

        $query_package   = $db->query('SELECT id_package, day, id_object FROM detail_package');
        $hasil_package = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_package->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                // 'geometry' => json_decode($row['geom']),
                'properties' => array(
                    'id_package' => $row['id_package'],
                    'day' => $row['day'],
                    'id_object' => $row['id_object'],
                )
            );
            array_push($hasil_package['features'], $features);
        }

        $query_day   = $db->query('SELECT day FROM package_day');
        $hasil_day = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_day->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                // 'geometry' => json_decode($row['geom']),
                'properties' => array(
                    'day' => $row['day'],
                )
            );
            array_push($hasil_day['features'], $features);
        }

        $query_service_package   = $db->query('SELECT id_package,detail_service_package.id_service_package as id_service_package, service_package.name as name FROM detail_service_package LEFT JOIN service_package ON detail_service_package.id_service_package=service_package.id_service_package WHERE id_package="' . $id_package . '" ');

        $hasil_service_package = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        foreach ($query_service_package->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'properties' => array(
                    'id_service_package' => $row['id_service_package'],
                    'id_package' => $row['id_package'],

                    'name' => $row['name']
                )
            );
            array_push($hasil_service_package['features'], $features);
        }

        $query_service_package   = $db->query('SELECT id_package,detail_service_package.id_service_package as id_service_package, service_package.name as name FROM detail_service_package LEFT JOIN service_package ON detail_service_package.id_service_package=service_package.id_service_package WHERE id_package="' . $id_package . '" ');

        $hasil_service_package = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        foreach ($query_service_package->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'properties' => array(
                    'id_service_package' => $row['id_service_package'],
                    'id_package' => $row['id_package'],

                    'name' => $row['name']
                )
            );
            array_push($hasil_service_package['features'], $features);
        }



        $data = [
            'AttributePage' => $this->PageData,
            'content' => 'Read ',
            'data' => $this->Model->getData($id, $id_user, $id_package), //find on data
            'user' => $hasil_user,
            'package' => $hasil_package,
            'day' => $hasil_day,
            'service_package' => $hasil_service_package
            // 'geometry' => $hasil
        ];
        // var_dump($data);
        return view('booking/read_booking', $data);
    }


    //UPDATE
    // public function update($id)
    // {
    //     $db = \Config\Database::connect();
    //     $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, name,id, address, contact_person, capacity, open, close, employee, owner FROM culinary WHERE id="' . $id . '"');
    //     $hasil = array(
    //         'type'    => 'FeatureCollection',
    //         'features' => array()
    //     );

    //     foreach ($query->getResultArray() as $row) {
    //         $features = array(
    //             'type' => 'Feature',
    //             'geometry' => json_decode($row['geom']),
    //             'properties' => array(
    //                 'id' => $row['id'],
    //                 'name' => $row['name'],
    //                 'x' => $row['x'],
    //                 'y' => $row['y'],
    //                 'address' => $row['address'],
    //                 'contact_person' => $row['contact_person'],
    //                 'capacity' => $row['capacity'],
    //                 'open' => $row['open'],
    //                 'close' => $row['close'],
    //                 'employee' => $row['employee'],
    //                 'owner' => $row['owner'],
    //             )
    //         );
    //         array_push($hasil['features'], $features);
    //     }

    //     // $selectData = $db->query('SELECT * FROM culinary_facility WHERE culinary_facility.name NOT IN (SELECT name FROM culinary_facility RIGHT JOIN culinary_detail_facility ON culinary_facility.id_facility=culinary_detail_facility.id_facility WHERE culinary_detail_facility.id="' . $id . '")')->getResultArray();
    //     // $dataFacility = $db->query('SELECT * FROM culinary_facility RIGHT JOIN culinary_detail_facility ON culinary_facility.id_facility=culinary_detail_facility.id_facility WHERE culinary_detail_facility.id="' . $id . '"')->getResultArray();

    //     $dataFind = $this->Model->getData($id);
    //     if ($dataFind == false) {
    //         return redirect()->to(base_url('/culinary'));
    //     }
    //     $data = [
    //         'AttributePage' => $this->PageData,
    //         'content' => 'Edit',
    //         'action' => 'culinary/update_action',
    //         'data' => $this->Model->getData($id),
    //         'status' => "Visible",
    //         'geometry' => $hasil,
    //         // 'selectData' => $selectData,
    //         // 'dataFacility' => $dataFacility,
    //     ];
    //     session()->setFlashdata('message', 'Update Record Success');
    //     return view('culinary/form_culinary', $data);
    // }
    // Copy ke semua controller yg ada delete image

    //DELETE
    public function delete($id)
    {
        $db = \Config\Database::connect();
        // $query   = $db->query("DELETE FROM culinary_detail_facility WHERE id='" . $id . "'");

        $query   = $db->query("DELETE FROM booking WHERE booking_date='" . $id . "'");
        session()->setFlashdata('message', 'Delete Record Success');
        return redirect()->to(base_url('web/detail_booking'));
    }

    //RULES
    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');
        $this->form_validation->set_rules('capacity', 'capacity', 'trim|required|numeric');
        $this->form_validation->set_rules('open', 'open', 'trim|required');
        $this->form_validation->set_rules('close', 'close', 'trim|required');
        $this->form_validation->set_rules('employee', 'employee', 'trim|required|numeric');
        $this->form_validation->set_rules('geom', 'geom', 'trim|required');
        $this->form_validation->set_rules('owner', 'owner', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
