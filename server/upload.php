<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Contenido subido</title>
    </head>
    
    <body>
    <?php
    include_once "config.php";	
	$bookName=$_POST[bookNameIndex];
    $fold=folder;
    opendir($fold);
    $fileName=$_FILES[fileIndex]['name'];
    $fileSource=$_FILES[fileIndex]['tmp_name'];
	$fileSize=$_FILES[fileIndex]['size'];	
    $to=$fold.$fileName;	
		
    if(isset($_POST[validateFormIndex]) && $_POST[validateFormIndex] == uploadSucced){
        if(isset($_FILES[fileIndex]) && !empty($_FILES[fileIndex])){
			if ($fileSize > minFileSizeAllowed && $fileSize < maxFileSizeAllowed){
				/*end*/
				if(isset($_POST[bookNameIndex]) && !empty($_POST[bookNameIndex])){
					copy($fileSource,$to);
					$con=mysql_connect(hostDatabase,DbUsername,DbPass) or die ("error 1");
					mysql_select_db(databaseName,$con) or die ("error 2");
					mysql_query("INSERT INTO files(pdf,name) VALUES('$to','$bookName')",$con);            
					echo "datos insertados"; 
					}else{
						echo "archivo no tiene un nombre";
						}
				/*end*/
				}else{					
					echo"file too big please reduce file size";
					}						                      
            }else{
                echo "no ha seleccionado ningun archivo";
                }
        }else{
            echo "incorrecto";
            }
    ?>
    <br><br>
    <a href="graphicall.php">Ver archivos</a>
    </body>
</html>