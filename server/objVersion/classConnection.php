<?php
require_once"config.php";
/*
insertComments=insertComments method insert into comments table the comment nessage
errors={
	"error0":"(error0) username empty",
	"error1":"(error1) username < minCharsAllowedOnUsername",
	"error2":"(error2) username < maxCharsAllowedOnUsername",
	"error3":"(error3) comment message empty",
	"error4":"(error4) comment message > maxCharsAllowedOnComments"
	}
*/
class database{
	protected $db;
	public function __construct(){
		$this->db=new mysqli(hostname,username,password,database);
		if($this->db->connect_errno>0){
			die("error:".$this->db->connect_error);
			exit();
			}		
		if(!$this->db->set_charset(charset)){
			printf("error: %s\n",$this->db->error);
			}
		}
	}
?>