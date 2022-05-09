<?php
  echo "<option value=''>- Pilih -</option>";
  foreach ($sub->result_array() as $row){
      echo "<option value='$row[id_sub_kegiatan]'>$row[nama_kegiatan]</option>";
  }