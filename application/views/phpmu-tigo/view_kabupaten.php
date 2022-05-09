<?php
  echo "<option value=''>   Pilih   </option>";
  foreach ($kabupaten->result_array() as $row){
      echo "<option value='$row[id_kab]'>$row[nama]</option>";
  }