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
		// measure start
		$fruits = $this->model_homepage->getAll();
		// measure end

		$data['fruits'] = $fruits;

		$this->load->view('homepage', $data);
	}

	public function addFruits(){
		// measure start
		$this->model_homepage->add_fruit($this->input->post());
		// measure end

		redirect(base_url(), 'refresh');
	}

	public function getPrices() {

		$id = $this->input->post('id');

		// measure start
		$data =	$this->model_homepage->get_prices_of_fruit($id);
		// measure end

		echo json_encode($data);
	}

	public function editFruits(){
		// measure start
		$this->model_homepage->edit_fruit($this->input->post());
		// measure end

		redirect(base_url(), 'refresh');
	}

	public function deleteFruits($fruit_id){
		// measure start
		$this->model_homepage->delete_fruit($fruit_id);
		// measure end

		redirect(base_url(), 'refresh');
	}
}

/* End of file welcome.php */