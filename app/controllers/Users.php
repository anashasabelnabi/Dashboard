<?php

class Users extends Controller
{

    public function __construct()
    {

        $this->loginmodel = $this->model('login');
    }


    public function login(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data=[
          'email' => $_POST['email'] ,
          'password' => $_POST['password'],
          'email_err' =>'',
          'password_err' => ''

        ];
            if(empty($data['email'])){
            $data['email_err'] = "Email Required";
            }
            if(empty($data['password'])){
              $data['password_err'] = "Password Required";
            }
            if ($this->loginmodel->finduserbyemail($data['email'])){
              //userfound
                $data['emial_rrr'] = "user found try another email";
              }else{
                //user not found
                $data['emial_rrr'] = "user not found";

              }
            if (empty($data['email_err'])&& empty($data['password_err'])){

              $loggedinuser=$this->loginmodel->login($data['email'] , $data['password']);
              
              if ($loggedinuser){
                 
                $this->createUserSession($loggedinuser);

              }else{
                $data['password_err'] = 'Password Incorrect' ;
                $this->view('login/login', $data);
              }
            }
            else{
              // Load view with errors
              $this->view('login/login', $data);
            }        
      
      }else{
              $data =[    
              'email' => '',
              'password' => '',
              'email_err' => '',
              'password_err' => '',        
            ];

        // Load view
            $this->view('login/login', $data);
          }

      
    }
    
    public function register(){
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    		$data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->loginmodel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->loginmodel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('login/register', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('login/register', $data);
      }
    }
    
    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('dashboards');
    }
    

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
}









?>
