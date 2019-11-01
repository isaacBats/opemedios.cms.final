<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opmedios extends CI_Controller {

	public $preview_url;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('opmedios_model');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->database();
		$this->load->helper('string');
		$this->load->library('ftp');
		$this->load->library('image_lib');
		$this->preview_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."/magazine";
	}

	public function index()
	{
		if(isset($_SESSION['user']))
		{
			header ('Location:'.base_url('index.php/newsletters').'');
		}
		else {
			$this->load->view('login');
		}
	}

	public function validar()
	{
		echo $this->opmedios_model->validacion();
	}

	public function register_user()
	{
		$this->opmedios_model->register_user();
    }

	public function salir()
	{
		$this->session->sess_destroy();
		header ('Location:'.base_url('index.php/newsletters').'');
	}

	//NEWSLETTER

	public function newsletters()
	{
		if(!isset($_SESSION['user']))
		{
			header ('Location:'.base_url().'');
		}
		else
		{
			$data['newsletter'] = $this->opmedios_model->get_newsletters();
			$data['customer'] = $this->opmedios_model->get_customers();
			$data['preview_url'] = $this->preview_url;
			$this->load->view('header');
			$this->load->view('newsletters',$data);
			$this->load->view('form_add_newsletter');
			$this->load->view('custom_send');
			$this->load->view('footer');
		}
	}



	public function add_newsletter()
	{
        $this->opmedios_model->add_newsletter();
	}

	public function delete_newsletter()
	{
        $this->opmedios_model->delete_newsletter($_POST['id']);
	}

	public function edit_newsletter($slug)
	{
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$this->load->view('header');
        $this->load->view('edit_newsletter',$data);
        $this->load->view('footer');
	}

	public function form_edit_newsletter()
	{
		$this->opmedios_model->edit_newsletter();
	}
	
	public function temporalFile()
	{
       $data['echo']['content'] = file_get_contents($_POST['url']);
        $this->load->view('temporal_file',$data);
	}

	//NEWS

	public function news($slug)
	{	
		if(!isset($_SESSION['user']))
		{
			header ('Location:'.base_url().'');
		}
		else
		{
			$data['news'] = $this->opmedios_model->get_news_magazine($slug);
			$data['category'] = $this->opmedios_model->get_category();
			$data['sectores'] = $this->opmedios_model->get_sectores();

			$data['newsletter'] = array(
				'id' => $slug,
	    		);
			$this->load->view('header');
			$this->load->view('news',$data);
			$this->load->view('form_add_news');
			$this->load->view('footer');
		}
	}

	public function add_item()
	{
        $this->opmedios_model->add_item();
	}

	public function createDate($origin)
	{
		$date = date_create($origin);
		$day = date_format($date, 'd');
		$month = date_format($date, 'm');
		$year = date_format($date, 'Y');
		$select_month = ltrim($month, "0") - 1;
		$get_day = strtolower (jddayofweek(cal_to_jd(CAL_GREGORIAN,date($month),date($day),date($year)),1));
		$list_month = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
		switch ($get_day) {
		    case "monday":
		        $result_day = "Lunes";
		        break;
		    case "tuesday":
		        $result_day = "Martes";
		        break;
		    case "wednesday":
		        $result_day = "Miércoles";
		        break;
		    case "thursday":
		        $result_day = "Jueves";
		        break;
		    case "friday":
		        $result_day = "Viernes";
		        break;
		    case "saturday":
		        $result_day = "Sábado";
		        break;
		    case "sunday":
		        $result_day = "Domingo";
		        break;
		}
		return $data = array(
				'name'  => $result_day,
				'day'   => ltrim($day, "0"),
				'month' => $list_month[$select_month],
				'year'  => $year,
	    		);
	}
/*
    public function send()
	{
		$slug = $_POST['id'];
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$data['news'] = $this->opmedios_model->get_news($slug);
		$data['date'] = $this->createDate($data['newsletter']['date_send']);
		$data['slug'] = $_POST['id'];
		$subject = $data['newsletter']['nameCustomer'] . " – Síntesis Informativa. " . $data['date']['name'] . " " . $data['date']['day'] . " de " . $data['date']['month'];
		$bcc = explode(",", $data['newsletter']['emailBcc']);
		$config['protocol']  = 'sendmail';
		$config['smtp_user'] = 'sony.comunicacion@opemedios.mx';
		$config['smtp_pass'] = 'rUG38eku';
		$config['smtp_host'] = 'mail.opemedios.mx';
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";

		$config['wordwrap']   = false;
		$config['priority']   = '1';

        $this->email->initialize($config);  
		$this->email->from('sony.comunicacion@opemedios.mx', ''.$data['newsletter']['nameCustomer'].'');
		$this->email->to(''.$data['newsletter']['emailTo'].'');
		$this->email->bcc($bcc);
		$this->email->subject($subject);
		$this->email->message($this->load->view('template', $data, true));
		$this->email->send();
		$this->opmedios_model->update_status($slug);
    }*/

    /*

      public function custom_send()
	{
		$slug = $_POST['id'];
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$data['news'] = $this->opmedios_model->get_news($slug);
		$data['date'] = $this->createDate($data['newsletter']['date_send']);
		$data['slug'] = $_POST['id'];
		$subject = $data['newsletter']['nameCustomer']. " – Síntesis Informativa. " . $data['date']['name'] . " " . $data['date']['day'] . " de " . $data['date']['month'];
		$config['mailtype'] = 'html';
		$mails = str_replace(' ', '', $_POST['dataMails']);
		$bcc = explode(",", $mails);
		$config['protocol']  = 'sendmail';
		$config['smtp_user'] = 'sony.comunicacion@opemedios.mx';
		$config['smtp_pass'] = 'rUG38eku';
		$config['smtp_host'] = 'mail.opemedios.mx';
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";

		$config['wordwrap']   = false;
		$config['priority']   = '1';

		//$this->email->from(''.$data['newsletter']['emailFrom'].'', ''.$data['newsletter']['nameCustomer'].'');
		$this->email->initialize($config);
		$this->email->from('sony.comunicacion@opemedios.mx', ''.$data['newsletter']['nameCustomer'].'');
		$this->email->to(''.$_POST['data1'].'');
		$this->email->bcc($bcc);
		$this->email->subject($subject);
		$this->email->message($this->load->view('template', $data, true));
		$this->email->send();
    }*/

     public function send()
	{
		$slug = $_POST['id'];
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$data['link'] = $this->preview_url . "/?app=demo&id=" . $slug;
		$data['date'] = $this->createDate($data['newsletter']['date_send']);
		$subject = $data['newsletter']['nameCustomer'] . " – Síntesis Informativa. " . $data['date']['name'] . " " . $data['date']['day'] . " de " . $data['date']['month'];
		$bcc = explode(",", $data['newsletter']['emailBcc']);
		$config['protocol']  = 'sendmail';
		$config['smtp_user'] = 'creel-abogados.comunicacion@opemedios.mx';
		$config['smtp_pass'] = 'LnDSc48P{z7M';
		$config['smtp_host'] = 'mail.opemedios.mx';
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";

		$config['wordwrap']   = false;
		$config['priority']   = '1';

        $this->email->initialize($config);  
		$this->email->from('creel-abogados.comunicacion@opemedios.mx', ''.$data['newsletter']['nameCustomer'].'');
		$this->email->to(''.$data['newsletter']['emailTo'].'');
		$this->email->bcc($bcc);
		//$this->email->to('joz.gnz@gmail.com');

		$this->email->subject($subject);
		$this->email->message($this->load->view('templateEmail', $data, true));
		$this->email->send();
		$this->opmedios_model->update_status($slug);
    }

    public function custom_send()
	{
		$slug = $_POST['id'];
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$data['link'] = $this->preview_url . "/?app=demo&id=" . $slug;
		$data['date'] = $this->createDate($data['newsletter']['date_send']);
		$subject = $data['newsletter']['nameCustomer']. " – Síntesis Informativa. " . $data['date']['name'] . " " . $data['date']['day'] . " de " . $data['date']['month'];
		$config['mailtype'] = 'html';
		$mails = str_replace(' ', '', $_POST['dataMails']);
		$bcc = explode(",", $mails);
		$config['protocol']  = 'sendmail';
		$config['smtp_user'] = 'creel-abogados.comunicacion@opemedios.mx';
		$config['smtp_pass'] = 'LnDSc48P{z7M';
		$config['smtp_host'] = 'mail.opemedios.mx';
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";

		$config['wordwrap']   = false;
		$config['priority']   = '1';

		//$this->email->from(''.$data['newsletter']['emailFrom'].'', ''.$data['newsletter']['nameCustomer'].'');
		$this->email->initialize($config);
		$this->email->from('creel-abogados.comunicacion@opemedios.mx', ''.$data['newsletter']['nameCustomer'].'');
		$this->email->to(''.$_POST['data1'].'');
		$this->email->bcc($bcc);
		$this->email->subject($subject);
		$this->email->message($this->load->view('templateEmail', $data, true));
		$this->email->send();
    }

    public function preview($slug)
	{
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$data['news'] = $this->opmedios_model->get_news($slug);
		$data['date'] = $this->createDate($data['newsletter']['date_send']);
		//$data['category'] = $this->opmedios_model->get_news($slug);
		$this->load->view('template',$data); 
	}
	
	public function getMagazine($slug)
	{
		$data['newsletter'] = $this->opmedios_model->get_newsletter($slug);
		$data['news'] = $this->opmedios_model->get_news_magazine($slug);
		$data['categories'] = array("Prensa", "Sitios Web","Redes Sociales","Radio","Televisión");
		$data['sectores'] = $this->opmedios_model->get_sectores();
		$data['newsletter']['banner'] = base_url('assets/img/creel.jpg');
		$fecha = $this->createDate($data['newsletter']['date_send']);
		$data['newsletter']['fecha'] = $fecha['name'] . ' ' . $fecha['day'] . ' ' . $fecha['month'] . ' ' . $fecha['year']; 
		$aux = array('magazine' => $data);
		header('Content-type: application/json');
		echo json_encode($aux, JSON_NUMERIC_CHECK);
    }

    public function delete_item()
	{
        $this->opmedios_model->delete_item($_POST['id']);
	}

	public function edit_news($slug)
	{
		$data['news'] = $this->opmedios_model->get_item($slug);
		$data['category'] = $this->opmedios_model->get_category();
		$data['sectores'] = $this->opmedios_model->get_sectores();
		$this->load->view('header');
        $this->load->view('edit_news',$data);
        $this->load->view('footer');
	}

	public function form_edit_news()
	{
		$this->opmedios_model->edit_news();
	}

	//EDITAR EMPRESA

	public function edit_company($slug)
	{
		$data['customer'] = $this->opmedios_model->singleCustomer($slug);
		$this->load->view('header');
        $this->load->view('edit_company',$data);
        $this->load->view('footer');
	}

	public function form_edit_company()
	{
		$this->opmedios_model->update_company();
	}
	
	public function verify_mails()
	{
		$mails = str_replace(' ', '', $_POST['dataMails']);
		$double = substr_count($mails, ",,");;
		$final = substr($mails,-1);
		if(!empty($mails)) {
			if ($double > 0 ) { 
				echo "error"; 
			}
			elseif ($final == ",") {
				echo "error"; 
			}
		}
	}






	public function themes()
	{
		if(!isset($_SESSION['user']))
		{
			header ('Location:'.base_url().'');
		}
		else
		{
			$data['themes'] = $this->opmedios_model->get_themes();
			$data['customer'] = $this->opmedios_model->get_customers();
			$this->load->view('header');
			$this->load->view('themes',$data);
			$this->load->view('form_add_theme');
			$this->load->view('form_edit_theme');
			$this->load->view('footer');
		}
	}

	public function single_theme($slug)
	{
		if(!isset($_SESSION['user']))
		{
			header ('Location:'.base_url().'');
		}
		else
		{
			$data['theme'] = $this->opmedios_model->get_single_theme($slug);
			$this->load->view('header');
			$this->load->view('single_theme',$data);
			$this->load->view('footer');
		}
	}


	public function delete_theme($slug)
	{
		$this->opmedios_model->delete_theme($slug);
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}

	public function add_theme()
	{
        $this->opmedios_model->add_theme();
	}

	public function edit_theme()
	{
        $this->opmedios_model->edit_theme();
	}

	//SECTORES
	public function sectores()
	{
		if(!isset($_SESSION['user']))
		{
			header ('Location:'.base_url().'');
		}
		else
		{
			$data['sectores'] = $this->opmedios_model->get_sectores();
			$data['customer'] = $this->opmedios_model->get_customers();
			$this->load->view('header');
			$this->load->view('sectores',$data);
			$this->load->view('form_add_sector');
			//$this->load->view('single_sector');
			$this->load->view('footer');
		}
	}

	public function single_sector($slug)
	{
		if(!isset($_SESSION['user']))
		{
			header ('Location:'.base_url().'');
		}
		else
		{
			$data['sector'] = $this->opmedios_model->get_single_sector($slug);
			$this->load->view('header');
			$this->load->view('single_sector',$data);
			$this->load->view('footer');
		}
	}

	public function delete_sector($slug)
	{
		$this->opmedios_model->delete_sector($slug);
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}

	public function add_sector()
	{
        $this->opmedios_model->add_sector();
	}

	public function edit_sector()
	{
        $this->opmedios_model->edit_sector();
	}


	public function imagen()
	{
		$slug                       = "creel";
		$config['upload_path']      = './assets/img/';
		$config['allowed_types']    = 'jpg';
		$config['max_size']         = '2048';
		$config['file_name']        = $slug;
		$config['file_ext_tolower'] = TRUE;
		$config['overwrite']        = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('file'))
	        {
	        	$data = $this->upload->data();
				$config['image_library']  = 'gd2';
				$config['source_image']   = './assets/img/'.$slug.$data['file_ext'];
				$config['create_thumb']   = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width']          = 580;
				$config['height']         = 170;
				$config['overwrite']      = TRUE;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$thumb = $slug.$data['file_ext'];
	        }
			header("Location: {$_SERVER['HTTP_REFERER']}");
    }

}

