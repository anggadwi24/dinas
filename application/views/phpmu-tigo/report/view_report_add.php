 <section id="about" class="about">
      <div class="container-fluid" data-aos="fade-up" >

<form method="post" action="<?= base_url('pegawai/do_report')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();">
          
              <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                  <label>Judul</label>
                  <input type="text" name="judul_report" class="form-control" required value="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="date" class="form-control" required value="<?= date('Y-m-d')?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Dari</label>
                  <input type="time" name="start" class="form-control" required value="<?= date('H:i')?>">
                </div>
              </div>
             
               <div class="col-md-12">
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="report" required></textarea>
                </div>

              </div>
                <div class="col-md-12">
                <div class="form-group">
                  <label>Foto</label>
                <input type="file"  class="form-control"  required accept="image/*"  name='files[]' capture multiple>
                </div>

              </div>
             
             
             
             
            <div class="col-md-12">
             <div class="form-group">
                  <button type="submit" class="btn btn-warning col-12 my-3 text-light">TAMBAH REPORT</button>
              </div>
              </div>
              </div>
            </form>

          </div>
        </section>