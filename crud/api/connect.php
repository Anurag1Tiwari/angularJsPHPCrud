<?php
class User{
	private $conn;
    function __construct() {
	    session_start();
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "angularphp";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			$this->conn=$conn;  
		}

	}	
	public function user_list(){
      	$sql = "SELECT * FROM users";
		$query=  $this->conn->query($sql);
		$user=array();
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
			  $user['list'][]= $row;
			}
		}
    	return $user;  
    }

    public function create_user_info($post_data){

	    $firstName='';
	    if(isset($post_data->firstName)){
	        $firstName= mysqli_real_escape_string($this->conn,trim($post_data->firstName));
	    }
      	$lastName='';
	    if(isset($post_data->lastName)){
	        $lastName= mysqli_real_escape_string($this->conn,trim($post_data->lastName));
	    }
       
	    $age='';
      	if(isset($post_data->age)){
        	$age= mysqli_real_escape_string($this->conn,trim($post_data->age));
      	}   
	     
       	$sql="INSERT INTO users (firstName, lastName, age) VALUES ('$firstName', '$lastName', '$age')";
        
        $result=  $this->conn->query($sql);
        
        if($result){
          	return 'Succefully Created User Info';     
        }else{
           	return 'An error occurred while inserting data';     
        }
          
    
    }
    public function update_user_info($post_data){
       	if( isset($post_data->id)){

	       	$user_id=mysqli_real_escape_string($this->conn,trim($post_data->id));
	           
	       	$firstName='';
	       	if(isset($post_data->firstName)){
	       		$firstName= mysqli_real_escape_string($this->conn,trim($post_data->firstName));
	       	}
       		$lastName='';
       		if(isset($post_data->lastName)){
       			$lastName= mysqli_real_escape_string($this->conn,trim($post_data->lastName));
       		}
       
       		$age='';
       		if(isset($post_data->age)){
       			$age= mysqli_real_escape_string($this->conn,trim($post_data->age));
       		}
       
       

       		$sql="UPDATE users SET firstName='$firstName',lastName='$lastName',age='$age' WHERE id =$user_id";
     
        	$result=  $this->conn->query($sql);
        
         
         	unset($post_data->id); 
	        if($result){
	          	return 'Succefully Updated Student Info';     
	        }else{
	         	return 'An error occurred while inserting data';     
	        }      
           
       }   
    }
    


    public function delete_user_by_id($id){
        
       	if(isset($id)){
	       	$user_id= mysqli_real_escape_string($this->conn,trim($id));

	       	$sql="DELETE FROM  users  WHERE id =$user_id";
	        $result=  $this->conn->query($sql);
	        
	        if($result){
	          return 'Successfully Deleted User Info';     
	        }else{
	         return 'An error occurred while inserting data';     
	        }
          
        
           
       }
        
    }

    function __destruct() {
    	mysqli_close($this->conn);  
    }
}