<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * clase principal de carga de archivos, inicial
 * 
 * @author      PICCORO Lenz McKAY
 * @copyright Copyright (c) 2023 Angel Gonzalez Gmail:ag5193407@gmail.com  , Gitlab 1:@Radioactive99
 * @version ab - 1.0
 */
class Convertirtxtxml extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	/**
	 * name: desconocido
	 * @param
	 * @return
	 */
	function __construct()
	{
		parent::__construct();
		$this->checksession();
		$this->load->helper(array('form', 'url','html'));
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('convertidores');
		$this->data = $data;

	}

	/**
	 * index que muestra vista con instrucciones, las instrucciones estan en la vista indexinput
	 * 
	 * @name: index
	 * @param void
	 * @return void
	 */
	public function index()
	{
		$data = $this->data;
		$this->load->view('header',$data);
		$this->load->view('xmls_index',$data);
		$this->load->view('footer',$data);
	}

	/**
	 * muestra vista para la carga del archivo a convertir, el formato del archivo es el mismo del xls del convertidor
	 * 
	 * @name: convcargartxt
	 * @param void
	 * @return void
	 */
	public function convcargartxt()
	{
		$data = $this->data;
		$this->load->view('header',$data);
		$this->load->view('xmls_convert1form',$data);
		$this->load->view('footer',$data);
	}

	/**
	 * convporcargatxtaxml recibe el archivo y datos relacionados y lo convierte, el formato es el mismo del xls que lo convierte
	 * 
	 * @name: convporcargatxtaxml
	 * @param void (data es enviado por GET/POST)
	 * @return void
	 */
	public function convporcargatxtaxml()
	{

		$config['upload_path'] = './eltxtfiles/uploads/';
		$config['allowed_types'] = "*";

		$this->load->library('upload', $config);

		$xmlsfilename = $this->upload->do_upload('xmlsfilename');

		$data = $this->upload->data();
		$fullpathuploaded = $data['full_path'];

		$this->load->library('Convertxml');
		$result = $this->convertxml->convertCsvToXmlString();

		$data['error'] = $this->upload->display_errors();
		$data['result'] = $result;

		$data['menu'] = $this->genmenu();
		$data['menu'] = $this->genmenu('convertidores');
		$this->load->view('header',$data);
		$this->load->view('xmls_convert2file', $data);
		$this->load->view('footer',$data);

	}


		/**
	 * convporcargatxtaxml recibe el archivo y datos relacionados y lo convierte, el formato es el mismo del xls que lo convierte
	 * 
	 * @name: convporcargatxtaxml
	 * @param void (data es enviado por GET/POST)
	 * @return void
	 */
	public function saveData()
	{



	}

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */
