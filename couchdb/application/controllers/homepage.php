<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		$fruits = $this->model_homepage->getAll();

		$data['fruits'] = $fruits;

		$this->load->view('homepage', $data);
	}

	public function addFruits(){
		$this->model_homepage->add_fruit($this->input->post());
		redirect(base_url(), 'refresh');
	}

	public function editFruits(){
		$this->model_homepage->edit_fruit($this->input->post());
		redirect(base_url(), 'refresh');
	}

	public function deleteFruits(){
		$this->model_homepage->delete_fruit($this->input->post());
		redirect(base_url(), 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */