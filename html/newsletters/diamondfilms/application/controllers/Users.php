<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('registry_model');
		$this->load->library('email');
		$this->load->helper('string');
	}

	public function registro()
	{
		$data['companies'] = $this->registry_model->get_companies();
		$this->load->view('pages/registrar_usuario',$data);
	}

	public function enviar_confirmacion($email,$slug)
	{
		$subject = "Confirmacion";
		$message = base_url()."/index.php/confirmacion/".$slug;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('no-reply@workeat.com');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function registrar_usuario()
	{
		$email = $_POST['user_email'];
		$slug = random_string('md5');
		$this->registry_model->add_user($slug);
		$this->enviar_confirmacion($email,$slug);
	}

	public function confirmar_email($slug)
	{
		$data['activation']['status'] = true;
		$this->registry_model->activation($slug);
		$this->load->view('pages/login', $data);
	}

	public function registro_empresas()
	{
		$this->load->view('pages/registro_empresas');
	}

	public function registrar_empresa()
	{
		$this->registry_model->add_company();
	}

	public function login()
	{
		$data['activation']['status'] = false;
		$this->load->view('pages/login', $data);
	}

	public function recuperar_password()
	{
		$this->load->view('pages/recuperar_password');
	}

	public function enviar_password()
	{
		$data['user'] = $this->registry_model->recover_password();
		$email =  $_POST['user_email'];
		$subject = "Recuperar Password";
		$message = $data['user']['user_password'];
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('no-reply@workeat.com');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}


}
