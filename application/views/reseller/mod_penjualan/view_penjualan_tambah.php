            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tambah Transaksi Penjualan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                  $provinsi = $this->model_app->view('rb_provinsi');
                  $user = $this->model_app->view_where('rb_konsumen_offline',array('rbo_id'=>$this->session->idko))->row_array();
                  $konoff = $this->db->query("SELECT *,b.nama_kota, a.nama_provinsi FROM rb_provinsi a JOIN rb_kota b ON a.provinsi_id=b.provinsi_id where b.kota_id='".$user['kota_id']."'")->row_array();
                  $attributes = array('class'=>'form-horizontal','role'=>'form');
                  echo form_open_multipart('reseller/tambah_penjualan',$attributes); 
                  if (isset($rows['kode_transaksi'])){
                     $kode_transaksi = $rows['kode_transaksi'];
                     $nama =$user['nama_lengkap'];
                     $hp = $user['no_hp'];
                     $alamat = $user['alamat'];
                     $kecamatan = $user['kecamatan'];
                     $kota = $user['kota_id'];
                    
                  }else{
                    $kode_transaksi = 'TRX-'.date('YmdHis');
                     $nama ="";
                     $hp = "";
                     $alamat = "";
                     $kecamatan = "";
                     $kota = "";
                  }
                ?>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode penjualan</th>  <td><input type='text' class='form-control' value='<?php echo "$kode_transaksi"; ?>' name='a' readonly required></td></tr>
                    <tr><th scope='row'>Nama Konsumen</th>                 <td><input type="text" class="form-control" name="nama" required value="<?= $nama ?>"></td></tr>
                    <tr><th scope='row'>No HP</th>                 <td><input type="number" class="form-control" name="nohp" value="<?= $hp ?>" required></td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td><textarea class="form-control" name="alamat"   rows="3" required><?= $alamat ?></textarea></td></tr>
                    <tr>
                      <th scope="row">Provinsi</th>
                      <td>
                        <select name="" class="form-control" id="prov" required>
                          <option value="">-- Pilih Provinsi --</option>
                            <?php foreach($provinsi->result_array() as $prov){
                            ?>
                                <option value='<?= $prov['provinsi_id']; ?>' 
                                  <?php if($konoff['nama_provinsi']==$prov['nama_provinsi']){echo "selected";}?> >
                                  <?= $prov['nama_provinsi'];?>
                                    
                                  </option>";
                            <?php } ?>
                        </select>
                      </td>
                    </tr>
                      <tr>
                      <th scope="row">Kota</th>
                      <td>

                        <select name="kota" class="form-control" id="kota" required>
                           <?php 

                            if($konoff['kota_id']!=0)
                            {
                            ?>
                                                      <option value="<?= $konoff['kota_id']?>"><?= $konoff['nama_kota'] ?></option>

                            <?php 
                            }
                           ?>
                          <option value="">-- Pilih Kota --</option>
                           
                        </select>
                      </td>
                    </tr>
                        <tr>
                      <th scope="row">Kecamatan</th>
                      <td>
                       <input type="text" name="kecamatan" class="form-control" value="<?= $kecamatan ?>" required>
                      </td>
                    </tr>
                  </tbody>
                  </table>
                  <input class='btn btn-primary btn-sm' type="submit" name='submit1' value='Simpan Data'>
                  <?php if ($this->session->idp !=''){ ?>
                  <a class='btn btn-default btn-sm' href='<?php echo base_url(); ?>reseller/penjualan'>Selesai / Kembali</a>
                  <hr>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th width='120px'>Harga Jual</th>
                        <th width='80px'>Jumlah</th>
                        <th width='80px'>Satuan</th>
                        <th>Sub Total</th>
                        <th width='70px'>Action</th>
                      </tr>
                    </thead>
                    <?php 
                        echo "<tr>
                                <td></td>
                                <input type='hidden' value='".$this->uri->segment(3)."' name='idpd'>
                                <td><select name='aa' class='combobox form-control' onchange=\"changeValue(this.value)\" autofocus>
                                                                      <option value='' selected> Cari Barang </option>";
                                                                      $jsArray = "var prdName = new Array();\n";    
                                                                      foreach ($barang as $r){
                                                                        $disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$r['id_produk'],'id_reseller'=>$this->session->id_reseller))->row_array();
                                                                        if ($r['id_produk']==$row['id_produk']){
                                                                          echo "<option value='$r[id_produk]' selected>$r[nama_produk]</option>";
                                                                          $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_konsumen']-$disk['diskon']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                                        }else{
                                                                          echo "<option value='$r[id_produk]'>$r[nama_produk]</option>";
                                                                          $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_konsumen']-$disk['diskon']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                                        }
                                                                      }
                                                                   echo "</select></td>
                                <td><input class='form-control' type='number' name='bb' value='$row[harga_jual]' id='harga'> </td>
                                <td><input class='form-control' type='number' name='dd' value='$row[jumlah]'></td>
                                <td><input class='form-control' type='text' name='ee' id='satuan' value='$row[satuan]' readonly='on'> </td>
                                <td></td>
                                <td><button type='submit' name='submit' class='btn btn-success  btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                                    <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."reseller/tambah_penjualan'><span class='glyphicon glyphicon-remove'></span></a>
                                </td>
                              </tr>";
                      ?>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    $sub_total = ($row['harga_jual']*$row['jumlah']);
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp ".rupiah($row['harga_jual'])."</td>
                              <td>$row[jumlah]</td>
                              <td>$row[satuan]</td>
                              <td>Rp ".rupiah($sub_total)."</td>
                              <td>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."reseller/tambah_penjualan/$row[id_penjualan_detail]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."reseller/delete_penjualan_tambah_detail/$row[id_penjualan_detail]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </td>
                          </tr>";
                      $no++;
                    }

                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->session->idp."'")->row_array();
                    echo "<tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                          </tr>";
                  ?>
                  </tbody>
                </table>
                <?php } ?>
                <?php

                  if($record !=NULL){
                   ?>
 <?php   $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$rows[id_penjualan]."'")->row_array();?>
<form action="<?= base_url('reseller/tambah_penjualan')?>" method="POST">
<input type="hidden" name="total" id="total" value="<?php echo $total['total']; ?>"/>
<input type="hidden" name="ongkir" id="ongkir" value="0"/>
<input type="hidden" name="berat" value="<?php echo $total['total_berat']; ?>"/>
<input type="hidden" name="diskonnilai" id="diskonnilai" value="<?php echo $diskon_total; ?>"/>
<?php       $kon = $this->db->query("SELECT * FROM rb_penjualan JOIN rb_konsumen_offline ON rb_penjualan.kode_transaksi = rb_konsumen_offline.rbo_kode_transaksi where id_penjualan='".$rows['id_penjualan']."'")->row_array();
?>

<div class="card">
    <div class="card-body">
      <p class="card-title">Pilih Kurir</p>
      <p class="card-text">
        <?php       
        $kurir=array('jne'=>'JNE','pos'=> 'POS Indonesia','ninja'=>'Ninja Xpress' ,'ide'=>'ID Express','sicepat'=>'SiCepatExpress','sap'=>'SAP Express','ncs'=>'Nusantara Card Semesta','anteraja'=>'AnterAja','rex'=>'Royal Express Indonesia','sentral'=>'Sentral Cargo','tiki'=>'Citra Van Titipan Kilat','RPX'=>'RPX Holding','pandu'=>'Pandu Logistik','wahana'=>'Wahana Prestasi Logistik','jnt'=>'J&T Express','pahala'=>'Pahala Kencana Express' ,'jet'=>'JET Express','slis'=>'Solusi Ekpers','expedito'=>'Expedito*','dse'=>'21 Express','first'=>'First Logistik','star'=>'Star Cargo','idl'=>'IDL Cargo');
        foreach($kurir as $rkurir => $value){
            ?>          
                <label class="form-check-label" >
                <input type="radio" name="kurir" class="kurir form-check-input " value="<?php echo $rkurir; ?>"/> <?php echo strtoupper($rkurir); ?>
                </label>
            <?php
        }
        ?>
        <label class=" form-check-label"><input type="radio" name="kurir" class="kurir form-check-input" value="cod"/> COD (Cash on delivery)</label>
      </p>
    </div>
    <div class="card-body" id="kuririnfo" style="display: none" >
      <p class="card-title">Service</p>
      <p class="card-title"  id="kurirserviceinfo"></p>
    </div>
    <br>
   <input type="hidden" name="id_penjualan" value="<?= $this->session->idp?>">
    <table class="table table-bordered table-striped">
      <thead>
      <tr><td width='500px'></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td>Status</td>
        <td colspan="4"> <input type="radio" id="proses" name="proses" value="2" checked>
        <label for="male">Belum Bayar</label></td>
        <td> <input type="radio" id="proses" name="proses" value="3">
  <label for="male">Lunas</label></td>
      </tr>
      <tr><td colspan="5">Total Bayar</td><td id="totalbayar"></td></tr>
      <tr><td colspan="5"></td><td> <input type="submit" name="kirim" value="KIRIM" class="btn btn-primary card-link" id="oksimpan"></td></tr>
      </thead>
    </table>
  </form>
                  <?php 
                  }
                ?>
                </div>
                </div>
                </div>

              </div>
              

<script type="text/javascript">    
<?php echo $jsArray; ?>  
  function changeValue(id){  
    document.getElementById('harga').value = prdName[id].name;  
    document.getElementById('satuan').value = prdName[id].desc;  
  };  
  $(document).ready(function(){
        $('#prov').change(function(){
          var state_id = $(this).val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('auth/city'); ?>",
            data:"stat_id="+state_id,
            success: function(response){
              $('#kota').html(response);
            }
          })
        })
      })

   function toDuit(number) {
      var number = number.toString(), 
      duit = number.split('.')[0], 
      duit = duit.split('').reverse().join('')
          .replace(/(\d{3}(?!$))/g, '$1,')
          .split('').reverse().join('');
      return 'Rp ' + duit ;
    }
  $(document).ready(function(){

$(".kurir").each(function(o_index,o_val){
    $(this).on("change",function(){
        var did=$(this).val();
        var id_penjualan = "<?php echo $this->session->idp;?>";
        var berat="<?php echo $total['total_berat']; ?>";
        var kota="<?php echo $kon['kota_id'];?>";
        $.ajax({
          method: "get",
          dataType:"html",
          url: "<?php echo base_url(); ?>reseller/kurirdata1",
          data: "kurir="+did+"&berat="+berat+"&kota="+kota,
          beforeSend:function(){
            $("#oksimpan").hide();
          }
        })
        .done(function( x ) {           
            $("#kurirserviceinfo").html(x);
            $("#kuririnfo").show();         
        })
        .fail(function(  ) {
            $("#kurirserviceinfo").html("");
            $("#kuririnfo").hide();
        });
    });
    });

$("#diskon").html(toDuit(0));
hitung();
});


function hitung(){
    var diskon=$('#diskonnilai').val();
    var total=$('#total').val();
    var ongkir=$("#ongkir").val();
    var bayar=(parseFloat(total)+parseFloat(ongkir));
    if(parseFloat(ongkir) > 0){
        $("#oksimpan").show();
    }else{
        $("#oksimpan").hide();
    }
    $("#totalbayar").html(toDuit(bayar));
}

</script> 