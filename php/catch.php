<?php
  $data = json_decode(file_get_contents('./send.json'));
  $data->money  = $data->money * 38;
  $data->contacts = array_chunk($data->contacts, 1);
  // $new_contacts = array_chunk($data->contacts, 1);

  // var_dump($data->contacts);

  $labels = ['Phone', 'Email', 'Name'];

  foreach ($data->contacts as $key => $value) {
   foreach ($value as $var => $var2) {
     for($i = 0; $i < 3; $i++) {
       $key = $labels[$i];
     }
   }
  }

  // var_dump($data->contacts);
   var_dump(json_encode($data));
?>
