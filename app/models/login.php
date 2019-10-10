<?php

/**
 * summary
 */
class Login 
{
    /**
     * summary
     */
    private $db;
    public function __construct()
    {
       $this->db = new Database ; 
    }

    public function register($data){
      $this->db->query('INSERT INTO login (name, email, password) VALUES(:name, :email, :password)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function login($email , $password){
    	$this->db->query("SELECT * FROM login WHERE email = :email");
    	$this->db->bind(':email' , $email);

    	$row = $this->db->singleresult();
        
    	$hashedpassword = $row->password ;
    	if (password_verify($password, $hashedpassword)) {
    		return $row ;
    	}
    	else{
    		return false ;
    		
    	}
    }
    public function finduserbyemail($email){
    	$this->db->query('SELECT * FROM login WHERE email = :email');
    	$this->db->bind(':email' , $email);
    	$row = $this->db->singleresult();
    	if ($this->db->rowcount()>0) {
    		return true;
    	}else{
    		return false ;
    		}
    		
    	}
    



}


?>