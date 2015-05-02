<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_homepage extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getAll() {

		try {
			$doc = $this->couchdb->useDatabase('myfruit');
			$doc = $this->couchdb->getAllDocs();
		} catch (Exception $e) {
			if ( $e->code() == 404 ) {
				echo "Document \"some_doc\" not found\n";
			} else {
				echo "Something weird happened: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
			}
			exit(1);
		}

		$doc = (array)$doc;

		$fruits = array();

		for($i=0; $i<$doc['total_rows']; $i++){
			$data = (array)$doc['rows'][$i];

			$mydata = $this->couchdb->getDoc($data['id']);
			
			$row = array(	'id' => $mydata->_id,
							'name' => $mydata->name,
							'price' => $mydata->price,
							'dist' => $mydata->dist,
							'qty' => $mydata->qty);

			array_push($fruits, $row);
		}

		return $fruits;
    }

    function addFruit($input){
    }
}