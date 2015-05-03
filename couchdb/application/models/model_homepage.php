<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_homepage extends CI_Model {


    function __construct(){
        parent::__construct();
    }

    function getLastId(){
    	$doc = $this->couchdb->getAllDocs();
    	return $doc['total_rows'];
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

    function add_fruit($input){
    	$doc = new stdClass();
    	$doc['id'] = getLastId();
    	$doc['name'] = $input['new-fruit-name'];
    	$doc['price'] = $input['new-fruit-price'];
    	$doc['dist'] = $input['new-fruit-dist'];
    	$doc['qty'] = $input['new-fruit-qty'];

    	try {
    		$this->couchdb->storeDoc($doc);
    	} catch (Exception $e) {
        echo "Something weird happened: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
        exit(1);
		}
		echo "The document is stored. CouchDB response body: ".print_r($response,true)."\n";
    	
    	$i++;

    	return;
    }

    function edit_fruit($input){
    	$doc = $this->couchdb->getDoc($input['id']);

    	$doc['id'] = $input->id;	//getLastId();
    	$doc['name'] = $input['edit-fruit-name'];
    	$doc['price'] = $input['edit-fruit-price'];
    	$doc['dist'] = $input['edit-fruit-dist'];
    	$doc['qty'] = $input['edit-fruit-qty'];

    	try {
	    	$this->couchdb->storeDoc($doc);
		} catch (Exception $e ) {
			echo "The document update failed: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
		}

    	return;
    }

    function delete_fruit($input){
    	$doc = $this->couchdb->getDoc($input['id']);
    	try {
			$result = $this->couchdb->deleteDoc($doc);
		} catch (Exception $e) {
			echo "Something weird happened: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
			exit(1);
		}
		echo "Document deleted, CouchDB response body: ".print_r($result,true)."\n";
	}
}