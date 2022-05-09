            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tambah Transaksi Pembelian</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                  $attributes = array('class'=>'form-horizontal','role'=>'form');
                  echo form_open('reseller/kirim_pembelian',$attributes); 
                ?>

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th width='120px'>Harga</th>
                        <th width='80px'>Jumlah</th>
                        <th width='80px'>Satuan</th>
                        <th>Sub Total</th>
                        <th width='80px'>Action</th>
                      </tr>
                    </thead>
                   <tbody>
                  <?php 
                    $no = 1;

                    foreach ($record as $row){
                    $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
                    $id_penjualan = $row['id_penjualan'];
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp ".rupiah($row['harga_jual'])."</td>
                              <td>$row[jumlah]</td>
                              <td>$row[satuan]</td>
                              <td>Rp ".rupiah($sub_total)."</td>
                              <td>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_pembelian_tambah_detail/$row[id_penjualan_detail]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </td>
                          </tr>";
                      $no++;
                    }

                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->session->idp."'")->row_array();
                    echo "<tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                            <td></td>
                          </tr>";
                  ?>
                
                 
                  </tbody>
                </table>

                <?php   $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$row[id_penjualan]."'")->row_array();?>
                <input type="hidden" name="total" id="total" value="<?php echo $total['total']; ?>"/>
<input type="hidden" name="ongkir" id="ongkir" value="0"/>
<input type="hidden" name="berat" value="<?php echo $total['total_berat']; ?>"/>
<input type="hidden" name="diskonnilai" id="diskonnilai" value="<?php echo $diskon_total; ?>"/>
<?php       $kon = $this->db->query("SELECT * FROM rb_penjualan JOIN rb_reseller ON rb_penjualan.id_pembeli = rb_reseller.id_reseller where id_penjualan='".$row['id_penjualan']."'")->row_array();
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
    
     
    
  

</div>
<input type="hidden" name="id_penjualan" value="<?= $id_penjualan?>">
    <table class="table table-bordered table-striped">
      <thead>
      <tr><td width='500px'></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td colspan="5">Total Bayar</td><td id="totalbayar"></td></tr>
      <tr><td colspan="5"></td><td> <input type="submit" name="kirim" value="KIRIM" class="btn btn-primary card-link" id="oksimpan"></td></tr>
      </thead>
    </table>



             
                </form>
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
</script> 
<script type="text/javascript">
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
        var id_penjualan = "<?php echo $id_penjualan;?>";
        var berat="<?php echo $total['total_berat']; ?>";
        var kota="<?php echo $kon['kota_id'];?>";
        $.ajax({
          method: "get",
          dataType:"html",
          url: "<?php echo base_url(); ?>reseller/kurirdata",
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