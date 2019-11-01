<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workeat_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}

	//Categorias

	public function add_category()
		{
			$data = array(
				'category_name'   => $_POST['category_name'],
				);
			$this->db->insert('category',$data);
		}

	public function get_categories()
		{
			$query = $this->db->query("SELECT * FROM category");
	        return $query->result_array();
		}

	public function get_category($slug)
		{
			$query = $this->db->get_where('category', array('category_id' => $slug));
			return $query->row_array();
		}

	public function edit_category()
		{
			$data = array(
				'category_name' => $_POST['category_name']
				);
			$this->db->where('category_id', $_POST['category_id']);
			$this->db->update('category', $data);
		}

	public function delete_category($slug)
		{
			$this->db->delete('category', array('category_id' => $slug));
		}

	//Menu

	public function add_food()
		{
			$data = array(
				'food_category'    => $_POST['food_category'],
				'food_name'        => $_POST['food_name'],
				'food_description' => $_POST['food_description'],
				);
			$this->db->insert('food',$data);
		}

	public function get_all_food()
		{
			$this->db->select('*');
			$this->db->from('food');
			//$this->db->where('food_category', '1');
			$this->db->join('category', 'food.food_category = category.category_id', 'left');
			$query = $this->db->get();
	        return $query->result_array();
		}

	public function get_food($slug)
		{
			$this->db->select('*');
			$this->db->where('food_id', $slug);
			$this->db->from('food');
			$this->db->join('category', 'food.food_category = category.category_id', 'left');
			$query = $this->db->get();
	        return $query->row_array();
		}

	public function edit_food()
		{
			$data = array(
				'food_category'    => $_POST['food_category'],
				'food_name'        => $_POST['food_name'],
				'food_description' => $_POST['food_description'],
				);
			$this->db->where('food_id', $_POST['food_id']);
			$this->db->update('food', $data);
		}

	public function delete_food($slug)
		{
			$this->db->delete('food', array('food_id' => $slug));
		}

	public function save_thumb($thumb,$slug)
		{
			$data = array('food_thumb' => $thumb);
			$this->db->where('food_id', $slug);
			$this->db->update('food', $data);
		}

	public function active_food($slug)
		{
			$data = array(
				'food_status'    => "1",
				);
			$this->db->where('food_id', $slug);
			$this->db->update('food', $data);
		}

	public function inactive_food($slug)
		{
			$data = array(
				'food_status'    => "0",
				);
			$this->db->where('food_id', $slug);
			$this->db->update('food', $data);
		}

	public function get_filter_food($slug)
		{
			$this->db->select('*');
			$this->db->from('food');
			$this->db->where('food_category', $slug);
			$this->db->join('category', 'food.food_category = category.category_id', 'left');
			$query = $this->db->get();
	        return $query->result_array();
		}
		

	public function get_users()
		{
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('user_type', '1');
			$this->db->join('company', 'user.user_company = company.company_id', 'left');
			$query = $this->db->get();
	        return $query->result_array();
		}

	public function get_admins()
		{
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('user_type', '0');
			$query = $this->db->get();
	        return $query->result_array();
		}


	public function get_companies()
		{
			$this->db->select('*');
			$this->db->from('company');
			$query = $this->db->get();
	        return $query->result_array();
		}
}