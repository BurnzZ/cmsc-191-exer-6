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
	public function index()
	{

		$this->load->model('fruit_model');
		if(isset($_POST['new-fruit-name'])){

		    $document = array( 
		       "name" => $_POST['new-fruit-name'], 
		       "qty" => (int)$_POST['new-fruit-quantity'], 
		       "dist" => $_POST['new-fruit-distributor'],
		       "price" => (int)$_POST['new-fruit-price']
		    );
		    $this->fruit_model->insert_fruit($document);
		}

		elseif (isset($_POST['edit-fruit-name'])) {

			$document = array(
		       "name" => $_POST['edit-fruit-name'], 
		       "qty" => (int)$_POST['edit-fruit-quantity'], 
		       "dist" => $_POST['edit-fruit-distributor'],
		       "price" => (int)$_POST['edit-fruit-price']
		    );
			$this->fruit_model->edit_fruit($_POST['edit-fruit-id'], $document);
		}


		$data['fruits'] = $this->fruit_model->get_all_fruits();
		$this->load->view('homepage',$data);
	}

	public function delete()
	{

		$m = new MongoClient();
	    $db = $m->test;
	    $collection = $db->fruits;

        $data['id'] = $this->input->post('id');
	    $collection->remove(array("_id" =>new MongoId($data['id'])));

	    echo json_encode($data);

	}

	public function getPrices()
	{

		$m = new MongoClient();
	    $db = $m->test;
	    $collection = $db->prices;
	    $id = $this->input->post('id');
	    $param = array('fruit_id' => $id);
	    $pricelist = $collection->find()->sort(array("date"=>1));
	    $data = array();
	    $i = 0;

	    foreach ($pricelist as $pricedata) {
	    	if ($i==0) {
	    		$data[$i++] = $pricedata['date'];
	    	}
	    	$data[$i++] = $pricedata['price'];
	    }

		echo json_encode($data);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */