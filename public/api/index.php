<?php 
 $host    = 'db:3306';
 $user    = 'root';
 $pass    = 'qwerty123';
 $db_name = 'Test';

 $link = new mysqli($host, $user, $pass, $db_name);

 if (!$link) {
     die('Ошибка подключения (' . mysqli_connect_errno() . ') '
             . mysqli_connect_error());
 }

 if($_REQUEST['to_bd'] === 'YES') {
     $keys = explode(',', $_GET['keys']);
     $values = explode(',', $_GET['values']);

     for ($i = 0; $i < count($keys); $i++) {
         mysqli_query($link, "INSERT INTO `Test` (`basic`, `value`) VALUES ('$keys[$i]', '$values[$i]')");
     }
     echo 'Выполнено ';
     print_r($_REQUEST);
 }

 mysqli_close($link);


?>