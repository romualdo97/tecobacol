<?php
/*terminado: 9.05PM martes 11 de marzo 2014*/
require_once"classConnection.php";
class crudData extends database{
	public $validationCode;
	public function __construct(){
		parent::__construct();				
		}
	public function read($query){				
		if(!$this->result=$this->db->query($query)){
			printf("Query error: %s",$this->db->error);
			}
		}
	public function insertComment($username,$comment){
		$commentlen=strlen($comment);
		$usernamelen=strlen($username);
		try{
			if(empty($username)){
				throw new exception("error0",0);
				}elseif($usernamelen<minCharsAllowedOnUsername){
					throw new exception("(error1)",1);
					}elseif($usernamelen>maxCharsAllowedOnUsername){
						throw new exception("(error2)",2);
						}elseif(empty($commentlen)){							
							throw new exception("(error3)",3);
							}elseif($commentlen>maxCharsAllowedOnComments){
								throw new exception("(error4)",4);
								}else{
									if(!$insert=$this->db->query("INSERT INTO comments (name,comment) VALUES ('$username','$comment')")){
										printf("Query error: %s",$this->db->error);
										}
									}
			}catch(exception $e){
				echo $e->getMessage();
				}
		}
	private function validateCode(){
		$codeTypedByUser=$_POST['code'];
		if(!$result=$this->db->query("SELECT code FROM codes WHERE code='$codeTypedByUser'")){
				printf("Query error: %s",$this->db->error);
				}else{
					$rwCnt=$result->num_rows;
					if($rwCnt==0){
						throw new exception("(error5)-Code dont exists-",5);
						}						
					printf("%s",$rwCnt);
					}
		if($result2=$this->db->query("SELECT status FROM codes WHERE code='$codeTypedByUser'")){
			while($row=$result2->fetch_assoc()){
				if($row['status']==1){
					$this->db->query("UPDATE codes SET status=0 WHERE code='$codeTypedByUser'");
					}else{
						throw new exception("(error6)-code already occuped by onother user-",6);
						}
				}
			}else{
				printf("Query error: %s",$this->db->error);
				}
		}
	public function uploadFile(){
		$folder=pasteFileOnDir;
		opendir($folder);
		$fileName=$_FILES['file']['name'];
		$fileSource=$_FILES['file']['tmp_name'];
		$fileSize=$_FILES['file']['size'];
		$paste=$folder.$fileName;				
     	try{			
			if(empty($fileName)){
				throw new exception("(error7)-havent sent file variable-",7);
				}elseif($fileSize<minFileSizeAllowed){
					throw new exception("(error8)-filesize<minFileSizeAllowed-");
					}elseif($fileSize>maxFileSizeAllowed){
						throw new exception("(error9)-filesize>maxFileSizeAllowed-");
						}							
			$this->validateCode();	
			copy($fileSource,$paste);
			$this->db->query("INSERT INTO files(pdf) VALUES ('$paste')");
			}catch(exception $e){
				echo $e->getMessage();
				}
		}	
	private function validateUsername(){
		$adminUsername=$_POST[adminUsername];
		if(empty($adminUsername)){
			throw new exception("(error10)-adminUsername variable empty-",10);
			}
		if(!$result=$this->db->query("SELECT username FROM users WHERE BINARY username='$adminUsername'")){
			printf("Query error: %s",$this->db->error);
			}else{
				$nmRws=$result->num_rows;
				if($nmRws==0){
					throw new exception("(error11)-user dont exists-",11);
					}					
				}			
		}
	private function validatePassword(){
		$username=$_POST[adminUsername]; 
		$password=$_POST[adminPassword];
		if(empty($password)){
			throw new exception("(error12)-password variable is empty-",12);
			}
		if(!$result=$this->db->query("SELECT password FROM users WHERE BINARY username='$username' AND BINARY password='$password'")){
			printf("Query error: %s",$this->db->error);
			}else{
				$nmRws=$result->num_rows;
				if($nmRws==0){
					throw new exception("(error13)-password is incorrect-",13);
					}
				}
		}		
	public function adminLoginValidation(){
		try{
			$this->validateUsername();
			$this->validatePassword();
			session_start();
			$username=$_POST[adminUsername]; 
			$_SESSION[sessionVariable]=$username;
			}catch(exception $e){
				echo $e->getMessage();
				}
		}
	}
	
//Example of use

//Show results sections
$foo=new crudData;
$foo->read("SELECT * FROM comments");
$counter=1;
while($row=$foo->result->fetch_assoc()){
	echo $counter++.'-'.$row['name']."<br>".$row['comment']."<br><br>";
	}
	
//Upload file section
$_POST['code']="ytrewq";
$foo->uploadFile();


echo "<br>";
//admin user section
$_POST[adminUsername]="romualdo97";
$_POST[adminPassword]="gotico97";
$foo->adminLoginValidation();
/*
$par=$_POST['name']="Romualdo Villalobos";
$par2=$_POST['commentMsg']="Me gusta este concurso, por eso h enviado una creacion mia";
$foo->insertComment($par,$par2);
*/
?>