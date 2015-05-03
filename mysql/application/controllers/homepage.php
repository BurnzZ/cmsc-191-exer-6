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


	function __construct(){
		parent::__construct();
		$this->load->model('model_homepage');
	}

	public function index()
	{
		$data['fruits']=$this->model_homepage->get_fruits();
		$this->load->view('homepage', $data);
	}

	public function edit_fruit(){
		$this->model_homepage->edit_fruit($this->input->post());
		redirect(base_url(), 'refresh');
	}

	public function add_fruit(){
		$this->model_homepage->add_fruit($this->input->post());
		redirect(base_url(), 'refresh');
	}

	public function delete_fruit($fruit_id){
		$this->model_homepage->delete_fruit($fruit_id);
		redirect(base_url(), 'refresh');
	}

	public function get_price($fruit_id){		//prices for the last 7 days
		$array['prices']=array();
		$price_date=$this->model_homepage->get_price_date($fruit_id);			
		$date=date("Y-m-d", strtotime("-6 days"));
		if(empty($price_date)){
			$latest_price=intval($this->model_homepage->get_latest_price($fruit_id, $date));
			for($i=0; $i<7; $i++) $array['prices'][]=$latest_price;
		}
		else{
			if(count($price_date) != 7){	// pad values
				$last_price=0;
				if($date < $price_date[0]->date){
					$latest_price=intval($this->model_homepage->get_latest_price($fruit_id, $date));
				}
				for($i=0; $i<count($price_date); $i++){
					while($price_date[$i]->date != $date && count($array['prices'])<7){
						$array['prices'][]=$last_price;
						$date=date("Y-m-d", strtotime($date . "+1 day"));
					}
					if($price_date[$i]->date == $date){
						$last_price=intval($price_date[$i]->price);
						$array['prices'][]=$last_price;
					}
					$date=date("Y-m-d", strtotime($date . "+1 day"));
				}
				while(count($array['prices'])<7){	// haven't been changed for the last few days
					$array['prices'][]=$last_price;
				}
			}
		}
		echo json_encode($array);		// final prices for the last 7 days
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */