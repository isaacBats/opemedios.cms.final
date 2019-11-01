<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opmedios_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}

	//LOGIN

	public function register_user()
	{
		$data = array(
			'password' => password_hash($_POST['logpassword'], PASSWORD_DEFAULT),
			'name'    => $_POST['logpassword'],
		);
		$this->db->insert('users',$data);
	}

	public function validacion()
	{
		$query = $this->db->get_where('users', array('name' => $_POST['logemail']));
		$row = $query->row_array();

		if ($_POST['logpassword'] == $row['password'])
			{
				$setuser = array(
					'user' => $_POST['logemail'],
					'type' => $row['type'],
					);
				$this->session->set_userdata($setuser);
				session_write_close();
			} 
		else 
			{
			    return 'error';
			}
	}
	
	//NEWSLETTER

	public function get_newsletters()
	{
		$query = $this->db->query("SELECT * FROM newsletters, customers WHERE newsletters.company = customers.idCustomer ORDER BY newsletters.id DESC");
        return $query->result_array();
	}

	public function get_themes()
	{
		$query = $this->db->query("SELECT * FROM category");
        return $query->result_array();
	}

	public function get_customers()
	{
		$query = $this->db->query('SELECT * FROM customers');
        return $query->result_array();
	}

	public function singleCustomer($id)
	{
		$query = $this->db->get_where('customers', array('idCustomer' => $id));
		return $query->row_array();
	}

	public function add_newsletter()
	{
		$data = array(
			'company'   => $_POST['company'],
			'horary'   => $_POST['horary'],
			'link1'     => $_POST['link1'],
			'link2'     => $_POST['link2'],
			'link3'     => $_POST['link3'],
			'link4'     => $_POST['link4'],
			'link5'     => $_POST['link5'],
			'link6'     => $_POST['link6'],
			'status'    => "Retenido",
			'date_send' => $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'],
			);
		$this->db->insert('newsletters',$data);
	}

	public function get_newsletter($slug)
	{
		$query = $this->db->query("SELECT * FROM newsletters, customers WHERE newsletters.id = $slug  AND newsletters.company = customers.idCustomer");
        return $query->row_array(); 
	}

	public function edit_newsletter()
    {
    	$data = array(
    		'horary' => $_POST['horary'],
			'link1' => $_POST['link1'],
			'link2' => $_POST['link2'],
			'link3' => $_POST['link3'],
			'link4' => $_POST['link4'],
			'link5' => $_POST['link5'],
			'link6' => $_POST['link6'],
			);
		$this->db->where('id', $_POST['id']);
		$this->db->update('newsletters', $data);
    }

    public function delete_newsletter($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('newsletters');
	}

    //CATEGORIES

	public function get_category()
	{
		$query = $this->db->query('SELECT * FROM category ORDER BY secuence ASC');
        return $query->result_array();
	}

	public function get_sectores() {
		$query = $this->db->query("SELECT * FROM sectores ORDER BY id ASC");
		return $query->result_array();
	}

    //NEWS

    public function get_item($slug)
	{
		$query = $this->db->query("SELECT * FROM news, category WHERE news.id = $slug ");
        return $query->row_array(); 
	}

	public function get_news($slug)
	{
		//$query = $this->db->query("SELECT * FROM news, category WHERE news.newsletter = $slug  AND news.id_category = category.idCategory ORDER BY category.nameCategory, news.type ASC");
		$query = $this->db->query("SELECT * FROM news, category WHERE news.newsletter = $slug ORDER BY category.nameCategory, news.type ASC");
        return $query->result_array();
	}

	public function get_news_magazine($slug)
	{
		$query = $this->db->query("SELECT news.*  FROM news INNER JOIN sectores as s ON news.id_sector = s.id AND news.newsletter = $slug ORDER BY news.type ASC");
        return $query->result_array();
	}

	public function get_news_type($slug,$type)
	{
		$query = $this->db->query("SELECT * FROM news, category WHERE news.newsletter = $slug  AND  news.type = $type AND news.id_category = category.idCategory ORDER BY category.nameCategory ASC");
        return $query->result_array();
	}

	public function add_item()
	{
		$data = array(
			'newsletter'  => $_POST['data0'],
			'id_category' => NULL,//$_POST['data1'],
			'link'        => $_POST['data2'],
			'title'       => strip_tags($_POST['data3'],'<b><strong><i><u>'),
			'text'        => strip_tags($_POST['data4'],'<b><strong><i><u>'),
			'source'      => strip_tags($_POST['data5'],'<b><strong><i><u>'),
			'type'      => $_POST['data6'],
			'id_sector'      => $_POST['data7'],
			);
		$this->db->insert('news',$data);
	}

	public function delete_item($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('news');
	}

	public function edit_news()
    {
    	$data = array(
			//'id_category'   => $_POST['data1'],
			'link'   => $_POST['data2'],
			'title'  => strip_tags($_POST['data3'],'<b><strong><i><u>'),
			'text'   => strip_tags($_POST['data4'],'<b><strong><i><u>'),
			'source' => strip_tags($_POST['data5'],'<b><strong><i><u>'),
			'type'   => $_POST['data6'],
			'id_sector'   => $_POST['data7'],
			);

		$this->db->where('id', $_POST['id']);
		$this->db->update('news', $data);
    }

    //NEWS

    public function update_status($id)
    {
		$status = "Enviado";
        $this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('newsletters');
    }

    //EDITAR EMPRESA

    public function update_company()
	{
		$mails = str_replace(' ', '', $_POST['dataMails']);
		$data = array(
			'nameCustomer' => $_POST['data1'],
			'emailFrom'    => $_POST['data2'],
			'emailTo'      => $_POST['data3'],
			'emailBcc'     => $mails,
			);
		$this->db->where('idCustomer', $_POST['id']);
		$this->db->update('customers', $data);
	}


	public function delete_theme($slug)
	{
		$this->db->where('idCategory', $slug);
		$this->db->delete('category');
	}

	public function add_theme()
	{
		$data = array(
			'nameCategory'  => $_POST['theme'],
			'secuence'  => "0",
			);
		$this->db->insert('category',$data);
	}

		public function edit_theme()
    {
    	$data = array(
			'nameCategory'  => $_POST['theme'],
			'secuence'  => "0",
			);
		$this->db->where('idCategory', $_POST['id']);
		$this->db->update('category', $data);
    }

     public function get_single_theme($slug)
	{
		$query = $this->db->query("SELECT * FROM category WHERE idCategory = $slug ");
        return $query->row_array(); 
	}
	//SECTORES
	public function get_single_sector($slug)
	{
		$query = $this->db->query("SELECT * FROM sectores WHERE id = $slug ");
        return $query->row_array(); 
	}
	public function delete_sector($slug)
	{
		$this->db->where('id', $slug);
		$this->db->delete('sectores');
	}

	public function add_sector()
	{
		$data = array('name'  => $_POST['sector']);
		$this->db->insert('sectores',$data);
	}

		public function edit_sector()
    {
    	$data = array('name'  => $_POST['sector']);
		$this->db->where('id', $_POST['id']);
		$this->db->update('sectores', $data);
    }

}