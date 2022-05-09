<?php
  echo "<option value=''>  Pilih  </option>";
  foreach ($kelurahan->result_array() as $row){
      echo "<option value='$row[id_kel]'>$row[nama]</option>";
  }