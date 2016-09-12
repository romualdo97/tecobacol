<?php
/*Constructor method*/
define('hostname','localhost');
define('database','tecobacol');
define('username','root');
define('password','');
define('charset','utf8');

/*Insert comment method -Comments section-*/
define("minCharsAllowedOnUsername",5);
define("maxCharsAllowedOnUsername",30);
define("maxCharsAllowedOnComments",255);

/*Upload file*/
define("pasteFileOnDir","files/");
define("minFileSizeAllowed",0);
define("maxFileSizeAllowed",2048);

/*Admin user vars*/
define("adminUsername","adminUser");
define("adminPassword","adminPass");
define("sessionVariable","username");

?>