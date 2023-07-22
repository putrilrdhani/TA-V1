<?php namespace App\Controllers;
/**
* THIS CONTROLER CODEIGNITER 4
* Codeigniter Version 4.x
* Generated by LigatCode
**/
use App\Models\ExamplePutriModel;

class ExamplePutri extends BaseController
{
    /**
	 * Class constructor.
     */	
    protected $PageData;
    protected $Model; //Default Models Of this Controler
    protected $pager;
	public function __construct()
	{
		$this->Model = new ExamplePutriModel(); //Set Default Models Of this Controler
        $this->PageData = $this->attributePage(); //Attribute Of Page
        $pager = \Config\Services::pager();
    }
    
    //ATRIBUTE THIS PAGE
    private function attributePage()
	{
		return  [
			'title' => 'LigatCode | ExamplePutri',
			'app' => 'LigatCode',
		];
    }

    //INDEX 
    public function index()
	{
		$data = [
			'AttributePage' =>$this->PageData,
			'content' => 'Create Pages',
            'data' => $this->Model->paginate(5, 'paging'),
            'pager' => $this->Model->pager
		];
		return view('exampleputri/index_service_package', $data);
    }

    //READ
    public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read Pages',
			'data' => $this->Model->find($id) //find on data
		];
		return view('exampleputri/read_service_package', $data);
    }

    //CREATE
    public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create Pages',
			'action' => site_url('ExamplePutri/create_action'),
			'data' =>   [
					     'id_service_package' => set_value('id_service_package'),
					     'name' => set_value('name'),
					    ]
		];
		return view('exampleputri/form_service_package', $data);
    }
    
    //ACTION CREATE
	public function create_action()
	{
		$data =[
				     'id_service_package' => $this->request->getVar('id_service_package'),
				     'name' => $this->request->getVar('name'),
        
				];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/ExamplePutri'));
    }
    
    //UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if($dataFind == false){
			return redirect()->to(base_url('/ExamplePutri'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edite Pages',
			'action' => 'exampleputri/update_action',
			'data' => $this->Model->find($id),
        ];
		session()->setFlashdata('message', 'Update Record Success');
		return view('exampleputri/form_service_package', $data);
    }
    
    //ACTION UPDATE
   	public function update_action()
	{
		$id = $this->request->getVar('id_service_package');
		$row = $this->Model->find(['id_service_package' => $id]);

			$data =[
				    'id_service_package' => $this->request->getVar('id_service_package'),
				    'name' => $this->request->getVar('name'),
                    ];
            $this->Model->save($data);
			session()->setFlashdata('message', 'Update Record Success');
			
			return redirect()->to(base_url('exampleputri'));
		
	}

    //DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id_service_package' => $id]);
		if ($row) {
            $this->Model->delete($id);
            session()->setFlashdata('message', 'Delete Record Success');
            return redirect()->to(base_url('/exampleputri'));
        } else {
            session()->setFlashdata('message', 'Record Not Found');
            return redirect()->to(base_url('/exampleputri'));
        }

    }

    //RULES
    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');

	$this->form_validation->set_rules('id_service_package', 'id_service_package', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file ExamplePutri.php */
 /* Location: ./app/controllers/ExamplePutri.php */
 /* Please DO NOT modify this information : */
 /* Generated by Ligatcode Codeigniter 4 CRUD Generator 2023-07-07 09:50:26 */