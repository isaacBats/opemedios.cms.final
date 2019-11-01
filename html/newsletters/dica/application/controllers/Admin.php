<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('workeat_model');
	}

	public function index()
	{
		$this->load->view('pages/login_administrador');
	}

	public function dashboard()
	{
		$this->load->view('pages/dashboard');
	}

	public function empresas()
	{
		$data['company'] = $this->workeat_model->get_companies();
		$this->load->view('pages/empresas', $data);
	}

	public function usuarios()
	{
		$data['user'] = $this->workeat_model->get_users();
		$this->load->view('pages/usuarios', $data);

	}

	//Menu

	public function menu()
	{
		$data['categories'] = $this->workeat_model->get_categories();
		$data['food'] = $this->workeat_model->get_all_food();
		$this->load->view('pages/menu', $data);

	}

	public function categorias()
	{
		$data['categories'] = $this->workeat_model->get_categories();
		$this->load->view('pages/categorias', $data);
	}

	//CATEGORIAS

	public function categories()
		{
			$data['categories'] = $this->workeat_model->get_categories();
			$this->load->view('admin/categories', $data);
		}

	public function add_category()
		{
			$this->load->view('admin/add_category');
		}

	public function action_add_category()
		{
			$this->workeat_model->add_category();
			redirect(base_url('index.php/panel/categories'));
		}

	public function edit_category($slug)
		{
			$data['category'] = $this->workeat_model->get_category($slug);
			$this->load->view('admin/edit_category', $data);
		}

	public function action_edit_category()
		{
			$this->workeat_model->edit_category();
			redirect(base_url('index.php/panel/categories'));
		}

	public function delete_category($slug)
		{
			$this->workeat_model->delete_category($slug);
			redirect(base_url('index.php/panel/categories'));
		}

	public function activar_platillo($slug)
		{
			$this->workeat_model->active_food($slug);
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}

	public function desactivar_platillo($slug)
		{
			$this->workeat_model->inactive_food($slug);
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}

	public function borrar_platillo($slug)
		{
			$data['food'] = $this->workeat_model->get_food($slug);
			if ($data['food']['food_thumb'] != "none.jpg")
			{
				$abspath = $_SERVER['DOCUMENT_ROOT']; 
				unlink($abspath.'/proyectos/workeat/assets/food/'.$data['food']['food_thumb']);
			}
			$this->workeat_model->delete_food($slug);
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}

	public function registrar_platillo()
		{
			$this->workeat_model->add_food();
		}

	public function registrar_categoria()
		{
			$this->workeat_model->add_category();
		}

	public function borrar_categoria($slug)
		{
			$this->workeat_model->delete_category($slug);
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}


	//Menu

	public function food()
		{
			$data['categories'] = $this->workeat_model->get_categories();
			$data['food'] = $this->workeat_model->get_all_food();
			$this->load->view('admin/food', $data);

		}

	public function add_food()
		{
			$data['categories'] = $this->workeat_model->get_categories();
			$this->load->view('admin/add_food', $data);
		}

	public function action_add_food()
		{
			$this->workeat_model->add_food();
			redirect(base_url('index.php/panel/food'));
		}

	public function edit_food($slug)
		{
			$data['categories'] = $this->workeat_model->get_categories();
			$data['food'] = $this->workeat_model->get_food($slug);
			$this->load->view('admin/edit_food', $data);
		}

	public function action_edit_food()
		{
			$this->workeat_model->edit_food();
			redirect(base_url('index.php/panel/food'));
		}

	public function delete_food($slug)
		{
			$data['food'] = $this->workeat_model->get_food($slug);
			if ($data['food']['food_thumb'] != "none.jpg")
			{
				$abspath = $_SERVER['DOCUMENT_ROOT']; 
				unlink($abspath.'/proyectos/workeat/assets/food/'.$data['food']['food_thumb']);
			}
			$this->workeat_model->delete_food($slug);
			redirect(base_url('index.php/panel/food'));
		}

	public function thumb_food($slug)
		{
			$data['food'] = $this->workeat_model->get_food($slug);
			$this->load->view('admin/thumb_food', $data);
		}

	public function upload_thumb()
		{
			$slug = $_POST['food_id'];
			$config['upload_path']      = './assets/food';
			$config['allowed_types']    = 'gif|jpg|png';
			$config['max_size']         = '2048';
			$config['file_name']        =  $slug;
			$config['file_ext_tolower'] =  TRUE;
			$config['overwrite']      = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('file'))
		        {
		        	// OBTENER INFORMACIÓN DE LA IMAGEN CARGADA
		        	$data = $this->upload->data();
					// HACER THUMBNAIL
					$config['image_library']  = 'gd2';
					$config['source_image']   = './assets/food/'.$slug.$data['file_ext'];
					$config['create_thumb']   = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']          = 50;
					$config['height']         = 50;
					$config['overwrite']      = TRUE;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					// GUARDAR NOMBRE
					$thumb = $slug."_thumb".$data['file_ext'];
					$this->workeat_model->save_thumb($thumb,$slug);
		        }
	        redirect(base_url('index.php/panel/food'));
	    }

	    public function active_food($slug)
		{
			$this->workeat_model->active_food($slug);
			redirect(base_url('index.php/panel/food'));
		}

		public function inactive_food($slug)
		{
			$this->workeat_model->inactive_food($slug);
			redirect(base_url('index.php/panel/food'));
		}

		public function food_filter($slug)
		{
			$data['categories'] = $this->workeat_model->get_categories();
			$data['food'] = $this->workeat_model->get_filter_food($slug);
			$this->load->view('admin/food_filter', $data);
		}
	
	public function administradores()
		{
			$data['user'] = $this->workeat_model->get_admins();
			$this->load->view('admin/administradores', $data);

		}

	/*public function empresas()
		{
			$data['company'] = $this->workeat_model->get_companies();
			$this->load->view('admin/empresas', $data);

		}*/

    	
}