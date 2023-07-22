<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Village extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Village_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'village/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'village/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'village/index.html';
            $config['first_url'] = base_url() . 'village/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Village_model->total_rows($q);
        $village = $this->Village_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'village_data' => $village,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('village/village_list', $data);
    }

    public function read($id)
    {
        $row = $this->Village_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'district' => $row->district,
                'geom' => $row->geom,
            );
            $this->load->view('village/village_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('village'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('village/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'district' => set_value('district'),
            'geom' => set_value('geom'),
        );
        $this->load->view('village/village_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'district' => $this->input->post('district', TRUE),
                'geom' => $this->input->post('geom', TRUE),
            );

            $this->Village_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('village'));
        }
    }

    public function update($id)
    {
        $row = $this->Village_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('village/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'district' => set_value('district', $row->district),
                'geom' => set_value('geom', $row->geom),
            );
            $this->load->view('village/village_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('village'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'district' => $this->input->post('district', TRUE),
                'geom' => $this->input->post('geom', TRUE),
            );

            $this->Village_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('village'));
        }
    }

    public function delete($id)
    {
        $row = $this->Village_model->get_by_id($id);

        if ($row) {
            $this->Village_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('village'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('village'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('district', 'district', 'trim|required');
        $this->form_validation->set_rules('geom', 'geom', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
