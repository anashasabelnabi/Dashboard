<?php

  /**
   * summary
   */
  class Dashboards extends Controller
  {
      /**
       * summary
       */
      public function __construct()
      {
        
        if(!isLoggedIn()){
        redirect('users/login');
        }
          $this->postmodel = $this->model('dashboard');
      }
      // 34an a3rd elbooks el f database
      public function index(){
        $books = $this->postmodel->getbooks();
        
        $data =[
        
        'books' => $books
        ];

        $this->view('dashboard/list',$data);
      }
      // 34an add book 
      public function add(){        
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $data =[        
            'title' => $_POST['title'],
            'rate' => $_POST['rate'] ,
            'author_id' => $_POST['author_id'] ,
            'published_at' => $_POST['published_at'],
            'image_path' =>$_FILES['image_path']['name'] ,
            'author_name' => $_POST['author_name'], 
            'title_err' => '',
            'rate_err' =>  '',
            'author_id_err' => '' ,
            'published_at_err' => '' ,
            'image_path_err' => '',
            'author_name_err' => ''
          ];
            if(empty($data['title'])){
            $data['title_Err'] = "Title Required";
            }
            if(empty($data['rate'])){
              $data['rate_err'] = "Rate Required";
            }
            if(empty($data['author_id'])){
              $data['author_id_err'] = "Author_id Required";
            }
            if(empty($data['published_at'])){
              $data['published_at_err'] = "Published_at Required";
            }
            if(empty($data['image_path'])){
              $data['image_path_err'] = "Image_path Required";
            }
            if(empty($data['author_name'])){
              $data['author_name_err'] = "Author_name Required";
            }
            if (empty($data['title_err']) && empty($data['rate_err']) && empty($data['author_id_err']) && empty($data['published_at_err']) && empty($data['image_path_err']) && empty($data['author_name_err'])) {

                if($this->postmodel->addbook($data)){
                    $this->imagePath($data['image_path']);
                    redirect('dashboards/list');
                    flash('book_message', 'Book Added');
                }else{
                  die('Something Wennt Wrong');
                }
        
            }else{
              $this->view('dashboard/form',$data) ;             
                    
            } 
          
        }else{
        $data =[
          'title' => $_POST['title'],
            'rate' => $_POST['rate'] ,
            'author_id' => $_POST['author_id'],
            'published_at' => $_POST['published_at'],
            'image_path' =>$_FILES['image_path']['name'],
            'author_name' => $_POST['author_name'], 
            'title_err' => '',
            'rate_err' =>  '',
            'author_id_err' => '' ,
            'published_at_err' => '' ,
            'image_path_err' => '',
            'author_name_err' => ''
        ];
        // Load view
        $this->view('dashboard/form', $data);
        }         
    }
    // function el edit
      public function edit($id){        
          if ($_SERVER['REQUEST_METHOD'] == 'POST')
          {
           $data =[
            'id' => $id,       
            'title' => $_POST['title'],
            'rate' => $_POST['rate'],
            'author_id' => $_POST['author_id'],
            'published_at' => $_POST['published_at'],
            'image_path' =>$_FILES['image_path']['name'],
            'author_name' => $_POST['author_name'], 
            'title_err' => '',
            'rate_err' =>  '',
            'author_id_err' => '' ,
            'published_at_err' => '' ,
            'image_path_err' => '',
            'author_name_err' => ''
            ];
              if(empty($data['title'])){
              $data['title_Err'] = "Title Required";
              }
              if(empty($data['rate'])){
                $data['rate_err'] = "Rate Required";
              }
              if(empty($data['author_id'])){
                $data['author_id_err'] = "Author_id Required";
              }
              if(empty($data['published_at'])){
                $data['published_at_err'] = "Published_at Required";
              }
              if(empty($data['image_path'])){
                $data['image_path_err'] = "Image_path Required";
              }
              if(empty($data['author_name'])){
                $data['author_name_err'] = "Author_name Required";
              }
              if (empty($data['title_err']) && empty($data['rate_err']) && empty($data['author_id_err']) && empty($data['published_at_err']) && empty($data['image_path_err']) && empty($data['author_name_err'])) {

                  if ($this->postmodel->updatebook($data)){
                        $this->imagePath($data['image_path']);
                        redirect('dashboards/list');
                        flash('book_message', 'Book Updated');
                    
                      }else{
                        die('Something Wennt Wrong');
                      }
        
              }else{
                //load view with errors
                  $this->view('dashboard/edit',$data) ;                  
              } 
        }
        else{
          // get book from form by id ;
           
           $books = $this->postmodel->getbookbyid($id); 
           // eldefault
        $data =[
            'id' => $id, 
            'title' =>$books->title ,
            'rate' => $books->rate,
            'author_id' => $books->author_id ,
            'published_at' => $books->published_at ,
            'image_path' =>$books->image_path,
            'author_name' => $books->author_name, 
            'title_err' => '',
            'rate_err' =>  '',
            'author_id_err' => '' ,
            'published_at_err' => '' ,
            'image_path_err' => '',
            'author_name_err' => ''
        ];
        // Load view
        $this->view('dashboard/edit', $data);
        }         
    }
    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){      

        if($this->postmodel->deletebook($id)){
          redirect('dashboards');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('dashboards');
      }
    }
     
    public function imagePath($image_path)
    {
        move_uploaded_file($_FILES['image_path']['tmp_name'], "../app/pictures/".$image_path);
    }
}

  

                         