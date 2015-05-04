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

        date_default_timezone_set('UTC');
        $today = mdate('%Y-%m-%d', now());

		for($i=0; $i<$doc['total_rows']; $i++){
			$data = (array)$doc['rows'][$i];

			$mydata = $this->couchdb->getDoc($data['id']);
			
			$row = array(	'id' => $mydata->_id,
							'name' => $mydata->name,
							'price' => $mydata->price->$today,
							'dist' => $mydata->dist,
							'qty' => $mydata->qty);

			array_push($fruits, $row);
		}

		return $fruits;
    }

    function add_fruit($input){
    	$doc1 = $this->couchdb->getAllDocs();
    	
    	$doc = new stdClass();
    	$doc1 = (array)$doc1;

    	$count = $doc1['total_rows']+1;	
    	$name = $input['new-fruit-name'];
    	$price = $input['new-fruit-price'];
    	$dist = $input['new-fruit-distributor'];
    	$qty = $input['new-fruit-quantity'];

        date_default_timezone_set('UTC');
        $today = mdate('%Y-%m-%d', now());

    	$doc->_id = "" .$count. "";
    	$doc->name = $name;
    	$doc->price = array($today => $price);

    	$doc->dist = $dist;
    	$doc->qty = (int)$qty;
    	try {
    		$response = $this->couchdb->storeDoc($doc);
    	} catch (Exception $e) {
        echo "Something weird happened: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
        exit(1);
		}
		// echo "The document is stored. CouchDB response body: ".print_r($response,true)."\n";

    	return;
    }

    function edit_fruit($input){
    	$doc = $this->couchdb->getDoc($input['edit-fruit-id']);

    	$name = $input['edit-fruit-name'];
    	$price = $input['edit-fruit-price'];
    	$dist = $input['edit-fruit-distributor'];
    	$qty = $input['edit-fruit-quantity'];

        date_default_timezone_set('UTC');
        $today = mdate('%Y-%m-%d', now());

        /* code for testing data */
        // date_default_timezone_set('UTC');
        // $now = now() - (4 * 24 * 3600);
        // $today = mdate('%Y-%m-%d', $now);

    	$doc->name = $name;
    	$doc->price->$today = $price;
    	$doc->dist = $dist;
    	$doc->qty = (int)$qty;

    	try {
	    	$this->couchdb->storeDoc($doc);
		} catch (Exception $e ) {
			echo "The document update failed: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
		}

    	return;
    }

    function delete_fruit($id){
    	$doc = $this->couchdb->getDoc($id);
    	
    	try {
			$result = $this->couchdb->deleteDoc($doc);
		} catch (Exception $e) {
			echo "Something weird happened: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
			exit(1);
		}
		// echo "Document deleted, CouchDB response body: ".print_r($result,true)."\n";

		return;
	}

}