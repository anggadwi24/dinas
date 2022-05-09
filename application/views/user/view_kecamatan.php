<?php
  echo "<option value=''>  Pilih  </option>";
  foreach ($kecamatan->result_array() as $row){
      echo "<option value='$row[id_kec]'>$row[nama]</option>";
  }