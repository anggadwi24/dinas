<?php
  echo "<option value=''>- Pilih -</option>";
  foreach ($sub->result_array() as $row){
      echo "<option value='$row[id_sub_bagian]'>$row[nama_sub_bagian]</option>";
  }