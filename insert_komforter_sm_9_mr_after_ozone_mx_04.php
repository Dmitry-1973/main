<?php
/* вставляет в файлах папки bags (bags/фирма/модель/names.php)
     после строки "$bag[] = 'ozone_mx_04'" строку "$bag[] = 'komforter_sm_9_mr'".
	 Если в файле нет подстроки 'ozone_mx_04' или есть подстрока 'komforter_sm_9_mr', то файл не изменяется.
     Показываются только те файлы names.php, которые перезаписываются.
	 Нужно изменить название данного файла на index.php и удалить из папки сайта файл .htaccess.
     Запустить в браузере как localhost.
     Повторный запуск не портит файлы names.php.	 
*/

$dir_pointer1=opendir('./bags');
while (($res1=readdir($dir_pointer1))!==false)
 {
  if (is_dir('./bags/'.$res1)&&($res1!=('.'))&&($res1!=('..')))
   {
    unset($flag2);
    $dir_pointer2=opendir('./bags/'.$res1);
	while (($res2=readdir($dir_pointer2))!==false)
	 {      	  
	  if (is_dir('./bags/'.$res1.'/'.$res2)&&($res2!=('.'))&&($res2!=('..')))
	   {
		 $names = file_get_contents('./bags/'.$res1.'/'.$res2.'/names.php');
		 if ( (strpos($names, 'ozone_mx_04') !== false) && (strpos($names, 'komforter_sm_9_mr') === false) )
		  {
//  	    echo $names.'***'."\r\n";
            unset($name);
		    unset($name_1);
		    unset($flag1);
		    $name = explode("\n", $names);		 
		    for ($i=0; $i<count($name); $i++)
		     {
		        if ($name[$i] != "")
			     {
				    $name_1[] = $name[$i];					 
		    		if (strpos($name[$i], 'ozone_mx_04') !== false)  //поиск элемента 'ozone_mx_04'
				     {
				    	$flag1 = 1;
			            $name_1[] = "\$bag[] = 'komforter_sm_9_mr';"."\r";
				     }
			     }
	 
			    
		     }
		    if ( isset($flag1) )
		     {			 
               if (!isset($flag2))
			    {
		          echo'<b>'.$res1.':</b><br>'."\r\n";
			      $flag2 = 1;
			    }	

		       print_r($name_1);
               echo'<br>';
			   //Запись данных
			   $file_pointer = fopen('./bags/'.$res1.'/'.$res2.'/names_1.php', 'w');
			   for ($ii=0; $ii<count($name_1); $ii++)
			    {
			     fputs($file_pointer, $name_1[$ii]."\r\n");
			    }
			   fclose($file_pointer);
			   unlink('./bags/'.$res1.'/'.$res2.'/names.php');
			   rename('./bags/'.$res1.'/'.$res2.'/names_1.php', './bags/'.$res1.'/'.$res2.'/names.php'); 
		     }					 
		  }
	   }		  
	 }

   }
 }   
?>