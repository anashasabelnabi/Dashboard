<?php
 /**
  * summary
  */
 class Dashboard 
 {
     /**
      * summary
      */
     private $db ;
     public function __construct()
     {
         $this->db = new Database ;
     }
     // elfunction elbt3rd elbooks
     public function getbooks(){
     	$this->db->query("SELECT * FROM books");
     	return $this->db->resultSet();
     }
     // elfunction el bt add book
     public function addbook($data){
      

      $this->db->query("INSERT INTO 
                        books( title , rate, author_id, published_at, image_path, author_name )
                        VALUES(:title,:rate,:author_id,:published_at,:image_path,:author_name) ");
      $this->db->bind(':title' ,$data['title']);
      $this->db->bind(':rate' ,$data['rate']);
      $this->db->bind(':author_id' ,$data['author_id']);
      $this->db->bind(':published_at' ,$data['published_at']);
      $this->db->bind(':image_path' ,$data['image_path']);
      $this->db->bind(':author_name' ,$data['author_name']);

      if ($this->db->execute()) {
        return true ;
      }else{
        return false;
      }
    }
    public function updatebook($data){

      $this->db->query("UPDATE books SET title =:title , rate =:rate, author_id =:author_id,published_at =:published_at, image_path= :image_path ,author_name= :author_name Where id=:id");
      $this->db->bind(':id' ,$data['id']);
      $this->db->bind(':title' ,$data['title']);
      $this->db->bind(':rate' ,$data['rate']);
      $this->db->bind(':author_id' ,$data['author_id']);
      $this->db->bind(':published_at' ,$data['published_at']);
      $this->db->bind(':image_path' ,$data['image_path']);
      $this->db->bind(':author_name' ,$data['author_name']);
      
      if ($this->db->execute()) {
        return true ;
      }else{
        return false;
      }


    }
    public  function getbookbyid ($id){
      $this->db->query("SELECT * FROM books WHERE id = :id ");
      $this->db->bind(':id' ,$id);
      //var_dump($id);
      $row = $this->db->singleresult();
      return $row ;
    } 
    
    public function deletebook($id){
      $this->db->query('DELETE FROM books WHERE id = :id');
      $this->db->bind(':id' , $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

 }

?>