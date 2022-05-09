<?php
  echo "<option value='all'>All</option>";
  foreach ($sub->result_array() as $row){
      echo "<option value='$row[id_sub_bagian]'>$row[nama_sub_bagian]</option>";
  }