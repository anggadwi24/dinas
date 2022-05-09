<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data COD</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_cod',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_cod]'>
                    <tr><th width='120px' scope='row'>Nama Alamat</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_alamat]' required></td></tr>
                    <tr><th scope='row'>Tarif</th>                 <td><input type='number' class='form-control' name='b' value='$rows[biaya_cod]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/alamat_cod'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
