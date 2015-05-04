<?php
	class Model_homepage extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function get_fruits(){
			$query=$this->db->query("SELECT * FROM `fruit`") or die(mysqli_error());
			return $query->result();
		}

		public function add_fruit($data){
			$query=$this->db->query("INSERT INTO fruit (`name`, `quantity`, `distributor`) values ('".$data['new-fruit-name']."',".$data['new-fruit-quantity'].",'".$data['new-fruit-distributor']."')") or die(mysqli_error());
			$id=$this->db->query("SELECT `id` FROM `fruit` where `name`='".$data['new-fruit-name']."'") or die(mysqli_error());
			$this->add_price($id->result()[0]->id, $data['new-fruit-price']);
			return;
		}

		public function edit_fruit($data){
			$query=$this->db->query("UPDATE fruit SET `name`='".$data['edit-fruit-name']."', `quantity`=".$data['edit-fruit-quantity'].", `distributor`='".$data['edit-fruit-distributor']."' where `id`=".$data['edit-fruit-id']) or die(mysqli_error());
			$id=$this->db->query("SELECT `id` FROM `fruit` where `name`='".$data['edit-fruit-name']."'") or die(mysqli_error());
			$this->add_price($id->result()[0]->id, $data['edit-fruit-price']);
			return;
		}

		public function add_price($id, $price){
			$query=$this->db->query("REPLACE INTO fruitprice (`id`, `price`, `date`) values (".$id.",".$price.", NOW())") or die(mysqli_error());
			return;
		}

		public function delete_fruit($id){
			$query=$this->db->query("DELETE FROM `fruit` where `id`=".$id);
			return;
		}

		public function get_price_date($id){
			$query=$this->db->query("SELECT `price`, `date` FROM `fruitprice` where `id`=".$id." and `date` between DATE_SUB(NOW(), INTERVAL 1 WEEK) and NOW()") or die(mysqli_error());
			// var_dump($query->result());
			return $query->result();
		}

		public function get_latest_price($fruit_id, $date = NULL){
			if($date == NULL){
				$query=$this->db->query("SELECT `price`, max(`date`) FROM `fruitprice` where `id`=".$fruit_id) or die(mysqli_error());
				// var_dump($query->result());
				return $query->result()[0]->price;
			}
			$query=$this->db->query("SELECT `price`, max(`date`) FROM `fruitprice` where `id`=".$fruit_id." and `date` < ".$date) or die(mysqli_error());
			// echo "late";
			// var_dump($query->result());
			// var_dump($query->result()[0]->price);
			if($query->result()[0]->price == null) return 0;
			return $query->result()[0]->price;
		}
	}
?>