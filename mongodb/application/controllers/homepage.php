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
		$m = new MongoClient();
	    $db = $m->test;
	    $collection = $db->fruits;

		if(isset($_POST['new-fruit-name'])){

		    $document = array( 
		       "name" => $_POST['new-fruit-name'], 
		       "qty" => $_POST['new-fruit-quantity'], 
		       "dist" => $_POST['new-fruit-distributor'],
		       "price" => $_POST['new-fruit-price']
		    );
		    $collection->insert($document);
		}

		elseif (isset($_POST['edit-fruit-name'])) {

			$document = array( '$set' => array(
		       "name" => $_POST['edit-fruit-name'], 
		       "qty" => $_POST['edit-fruit-quantity'], 
		       "dist" => $_POST['edit-fruit-distributor'],
		       "price" => $_POST['edit-fruit-price']
		    ));

			$collection->update(array("_id"=>new MongoId($_POST['edit-fruit-id'])), $document);
		}


		$data['fruits'] = $collection->find()->sort(array('name'=>1));
		$this->load->view('homepage',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */