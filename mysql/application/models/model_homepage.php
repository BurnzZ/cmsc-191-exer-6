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
	}
?>