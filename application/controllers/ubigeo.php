<?php 

/**
* 
*/
class Ubigeo extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ubigeo_modelo');
	}
	
	function index()
	{
		$data['titulo'] = "Listas Desplegables con CI y jQuery";
		$data['dpto_js'] = $this->ubigeo_modelo->devolverDistritos();
		$data['dptos'] = $this->ubigeo_modelo->devolverDepartamentos();
		$this->load->view('ubigeo_vista', $data);
	}

	function prov()
	{
		$this->ubigeo_modelo->devolverProvincias($this->input->get('id'));
	}
}
