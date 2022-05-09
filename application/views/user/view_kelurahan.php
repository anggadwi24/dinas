<?php
  echo "<option value='all'>  Pilih  </option>";
  foreach ($kelurahan->result_array() as $row){
      echo "<option value='$row[id_kel]'>$row[nama]</option>";
  }