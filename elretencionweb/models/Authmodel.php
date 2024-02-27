<?php
/**
 * Copyright 2023 Angel Gonzalez Gmail:ag5193407@gmail.com , Gitlab 1:@Radioactive99
 * Copyright 2023 PICCORO Lenz McKAY mckaygerhard
 * 
 * Usted es libre de:
 * - Compartir — copiar y redistribuir el material en cualquier medio o formato
 * - Adaptar — remezclar, transformar y crear a partir del material
 * 
 * El licenciador no puede revocar estas libertades mientras cumpla con los términos de la licencia.
 * Bajo las condiciones siguientes:
 * 
 * - Reconocimiento — Debe reconocer adecuadamente la autoría, proporcionar un enlace a la licencia e indicar si se han realizado cambios<. Puede hacerlo de cualquier manera razonable, pero no de una manera que sugiera que tiene el apoyo del licenciador o lo recibe por el uso que hace.
 * - NoComercial — No puede utilizar el material para una finalidad comercial.
 * - CompartirIgual — Si remezcla, transforma o crea a partir del material, deberá difundir sus contribuciones bajo la misma licencia que el original.
 * 
 * No hay restricciones adicionales — No puede aplicar términos legales o medidas tecnológicas que legalmente restrinjan realizar aquello que la licencia permite.
 */


/**
 * Authmodel model abstraction that manages the authentication agains DB/mail/etc
 *
 * @package    CodeIgniter
 * @category   Files
 * @version    1.0.0-dev
 * @author     PICCORO Lenz McKAY
 * @link       https://gitlab.com/codeigniterpower/codeigniter-login
 */
class Authmodel extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function authtable($username, $password)
	{
		log_message('info', __METHOD__ .' begin ');
		$array_result = FALSE;

		$validu = $this->form_validation->required($username);
		$validu = $this->form_validation->alpha_dash($username);
		$validu = $this->form_validation->max_length($username,40);
		$valids = $this->form_validation->required($password);
		$valids = $this->form_validation->alpha($password);

		if($validu == FALSE AND $valids == FALSE) return FALSE;

		$this->load->database();
		$query = $this->db->get_where('reten_usuarios', array('username'=>$username, 'userkey'=>$password));
		if($query) $array_result = $query->row_array();

		log_message('info', __METHOD__ .' ended with '.print_r($array_result,TRUE));
		return $array_result;
	}

	public function authimap($username, $password)
	{
		log_message('info', __METHOD__ .' begin ');
		$valid = FALSE;

		$validu = $this->form_validation->required($username);
		$validu = $this->form_validation->alpha_dash($username);
		$validu = $this->form_validation->max_length($username,40);
		$valids = $this->form_validation->required($password);
		$valids = $this->form_validation->alpha($password);

		if($validu == FALSE AND $valids == FALSE) return FALSE;

		$config = array('plain'=> TRUE, 'username' => $username, 'password' => $password);
		$this->load->library('Imap', $config);
		$valid  = $this->imap->connect($config);

		log_message('info', __METHOD__ .' ended with '.print_r($valid,TRUE));
		return $valid;
	}

}

?>
