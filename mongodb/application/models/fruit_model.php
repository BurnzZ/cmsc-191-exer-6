<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fruit_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_all_fruits(){

    	$m = new MongoClient();
	    $db = $m->test;
	    $collection = $db->fruits;

    	return $collection->find()->sort(array('name'=>1));

    }

    function insert_fruit($document){

    	$m = new MongoClient();
	    $db = $m->test;
	    $collection = $db->fruits;
	    $prices = $db->prices;

    	$collection->insert($document);
    	$fruitData = $collection->findOne($document);

    	date_default_timezone_set('UTC');
    	$date = mdate('%Y-%m-%d',now());

    	$newprice = array( 
		    "fruit_id" => (string)$fruitData['_id'], 
		    "date" => $date, 
		    "price" => $document['price']
		 );


    	$prices->insert($newprice);

    }

    function edit_fruit($id, $document){

    	$m = new MongoClient();
	    $db = $m->test;
	    $collection = $db->fruits;
	    $prices = $db->prices;

	    $set = array('$set' => $document);
    	$collection->update(array("_id"=>new MongoId($id)), $set);

    	date_default_timezone_set('UTC');
    	$date = mdate('%Y-%m-%d',now());


    	$param = array(
    		'fruit_id' => $id,
    		'date' => $date
    	);
    	$priceData = $prices->findOne($param);

    	if($priceData == null){
    		//iterate
	    	$newprice = array( 
			    "fruit_id" => $id, 
			    "date" => $date, 
			    "price" => $document['price']
			 );


	    	$prices->insert($newprice);

    	}

    	else{

    		$param2 = array( '$set' => array(
	    		'date' => $date,
	    		'price' => $document['price']
	    	));

    		$prices->update($param, $param2);

    	}


    }

}