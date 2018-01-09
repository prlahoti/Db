<?php 
   class Opt extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

       public function select($data,$status) 
       { 
         if($status=='id')
         {
            $query = $this->db->get_where('MyP', array('id' => $data['id']));
         }
         elseif($status=='name')
         {
            $query = $this->db->get_where('MyP', array('name' => $data['name']));
         }
         elseif ($status=='both') 
         {
            $query = $this->db->get_where('MyP', array('id'=>$data['id'],'name' => $data['name']));
         }
         return $query;  
      } 
   
   
      public function insert($data) 
      { 
         if($this->db->insert('MyP',$data))
         {
            return true;
         }
      } 
   

      public function delete($data,$status) 
      { 
         if($status=='id')
         {
            $this->db->where('id', $data['id']);  
            $this->db->delete('MyP'); 
            return $this->db->affected_rows();      
         }
         elseif ($status=='name') 
         {
            $this->db->where('name', $data['name']);  
            $this->db->delete('MyP'); 
            return $this->db->affected_rows();
         }
      } 
   
   
      public function update($data) 
      { 
         $this->db->where('id',$data['id']);  
         $this->db->update('MyP', $data);  
         return $this->db->affected_rows();
      } 
   } 
?> 