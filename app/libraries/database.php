<?php
//pdo database class
//connect to db
//create prepared statment
//bind values // return rows and result

class Database{
	private $host = DB_HOST ;
	private $user = DB_USER ;
	private $pass = DB_PASS;
	private $dbname = DB_NAME ;

 	private $dbh ;
 	private $stmt ;
 	private $error ;

 	public function __construct(){

 		// set dsn 
 		$dsn  = 'mysql:host=' . $this->host . ';dbname=' .$this->dbname;
 		$options = array(
 			// increase performance
 			PDO::ATTR_PERSISTENT => true ,
 			//HANDLE ERRORS
 			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
 		);
 		//CREATE PDO OBJECT

 		try{
 			$this->dbh = new PDO($dsn ,$this->user,$this->pass,$options);

 		}
 		catch( PDOException $e){
 			$this->error = $e->getmessage();
 			echo $this->error;
 		}

 	}
 	//prepare statment with query 
 	public function query($sql){
 		$this->stmt = $this->dbh->prepare($sql);
 	}
 	// bind values
 	public function bind($param , $value ,$type= null){

 		if (is_null($type)){
 			switch (true) {
 				case is_int($value):
 					$type = PDO::PARAM_INT ;
 					break;
 				case is_bool($value):
 					$type = PDO::PARAM_BOOL ;
 					break;
 				case is_null($value):
 					$type = PDO::PARAM_NULL ;
 					break;
 				default:
 					$type = PDO::PARAM_STR ; 					
 			}
 		}
 		//lw b3d kol elfo2 da etnfz fe function esmha bindvalue btrbot kolo bb3d fa t3ml query b3den y7slha exexcute t7t
 		$this->stmt->bindValue($param,$value,$type);
 	}
 	/// execute the perpared statment
 	public function execute(){
 		return $this->stmt->execute();

 	}
 	// get result as array of objects
 	public function resultSet(){
 		$this->execute();
 		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
 	}
 	//get single record as object
 	public function singleresult(){
 		$this->execute(); 		
 		return $this->stmt->fetch(PDO::FETCH_OBJ);
 	}
 	//get row count
 	public function rowcount(){
 		$this->stmt->rowCount();
 	}
}
?>