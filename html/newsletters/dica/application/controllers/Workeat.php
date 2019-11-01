<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workeat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('registry_model');
		$this->load->library('email');
		$this->load->helper('string');
	}

	public function index()
	{
		$this->load->view('website/home');
	}

	public function registrar_usuario()
	{
		$data['companies'] = $this->registry_model->get_companies();
		$this->load->view('forms/registry_user',$data);
	}

	public function registrar_empresa()
	{
		$this->load->view('forms/registry_company');
	}

	public function action_add_company()
	{
		$this->registry_model->add_company();
		redirect(base_url());
	}

	public function sendConfirm($email,$slug)
		{
			$subject = "Confirmacion";
			$message = base_url()."/index.php/activar/".$slug;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from('no-reply@workeat.com');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
    	}

	public function action_add_user()
	{
		$email = $_POST['user_email'];
		$slug = random_string('md5', 4);
		$this->registry_model->add_user($slug);
		$this->sendConfirm($email,$slug);
		redirect(base_url());
	}

	public function activation($slug)
	{
		$this->registry_model->activation($slug);
		echo 'usuario activado';
	}



}
