<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registry_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}

	public function add_company()
	{
		$data = array(
			'company_name'         => $_POST['company_name'],
			'company_email'        => $_POST['company_email'],
			'company_phone'        => $_POST['company_phone'],
			'company_ext'          => $_POST['company_ext'],
			'company_del'          => $_POST['company_del'],
			'company_address'      => $_POST['company_address'],
			'company_employees'    => $_POST['company_employees'],
			'company_nameUser'     => $_POST['company_nameUser'],
			'company_lastNameUser' => $_POST['company_lastNameUser'],
			'company_comments'     => $_POST['company_comments'],
			'company_status'       => '0',
			);
		$this->db->insert('company',$data);
	}

	public function get_companies()
	{
		$query = $this->db->query("SELECT * FROM company");
        return $query->result_array();
	}

	public function add_user($slug)
	{
		$data = array(
			'user_name'       => $_POST['user_name'],
			'user_lastName'   => $_POST['user_lastName'],
			'user_email'      => $_POST['user_email'],
			'user_phone'      => $_POST['user_phone'],
			'user_company'    => $_POST['user_company'],
			'user_password'   => $_POST['user_password'],
			'user_activation' => $slug,
			'user_type'       => '1',
			);
		$this->db->insert('user',$data);
	}

	public function activation($slug)
	{
		$data = array('user_status' => "1");
		$this->db->where('user_activation', $slug);
		$this->db->update('user', $data);
	}


	public function recover_password()
	{
		$this->db->select('user_password');
		$this->db->from('user');
		$this->db->where('user_email', $_POST['user_email']);
		$query = $this->db->get();
        return $query->row_array();
	}
		
}