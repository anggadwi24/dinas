            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Ganti Slider</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <a href="<?= base_url('administrator/slider')?>" class="btn btn-primary mt-2 mb-5">KEMBALI</a>
                    <form method="POST" action="<?= base_url('administrator/edit_slider')?>" enctype= multipart/form-data>
                        <div class="row">
                          <div class="col-lg-12 form-group">
                            <label>Slider :</label>
                            <input type="file" name="file" class="form-control" required accept="image/*">
                            <small>Gambar Lama : <a href="<?= base_url('asset/slider/').$row['gambar']?>" target="BLANK"><?= $row['gambar']?></a></small>
                          </div>
                          <div class="col-lg-12">
                            <input type="hidden" name="id" value="<?= $row['id_gambar']?>">
                            <input type="submit" name="submit" class="btn btn-primary" style="width:100%" value="UBAH">
                          </div>
                        </div>
                       

                    </form>
              
              </div>