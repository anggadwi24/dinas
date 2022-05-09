<div class="card m-b-30">
                            <div class="card-header">   
                                <form id='formAct'>                             
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-12 mb-2">
                                        <h5 class="card-title mb-0">Peringkat</h5>
                                    </div>
                                    <div class="col-6 col-lg-2" title='Start Date' >
                                        <input type="date" id='start' class='form-control font-10' value='<?= date('Y-m-d') ?>'>
                                       

                                    </div>
                                    <div class="col-6 col-lg-2" title='End Date'>
                                        <input type="date" id='end' class='form-control font-10' value='<?= date('Y-m-d') ?>'>
                                       

                                    </div>
                                    
                                    <?php if($cabang == 'all'){?>
                                    <div class="col-6 col-lg-3 ">
                                     
                                        <select name="cabang" id="cabang" class="form-control font-12">
                                            <option value="all">Semua</option>
                                        <?php $sekolah = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));
                                            if($sekolah->num_rows() > 0){
                                                foreach($sekolah->result_array() as $skh){
                                                    echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";
                                                } 
                                            }
                                        ?>
                                        </select>
                                    </div> 
                                    <?php }else{
                                        echo "<input type='hidden' id='cabang' name='cabang' value='".encode($cabang)."'>";
                                        }?>
                                    <div class="col-4 col-lg-2" title='Kelas'>
                                        <select class="form-control font-12" name='kelas' id='kelas'>
                                        <option value="all">Semua</option>
                                        <?php if($jenis == 'sekolah'){
                                            $get = $this->model_app->view_where('subdomain',array('id_sd'=>$cabang))->row_array();
                                            $jenis = $get['jenis_sekolah'];
                                            if($jenis == 'sd'){
                                                echo  "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                                            }else if($jenis == 'smp'){
                                                echo  "<option value='VII'>VII</option><option value='VII'>VII</option><option value='IX'>IX</option>";
                                            }else if($jenis == 'sma'){
                                                echo  "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";
                            
                                            }
                                        }?>

                                        </select>
                                    </div>
                                    <div class="col-4 col-lg-2" title='Limit'>
                                        <select class="form-control font-10" name='limit' id='limit'>
                                            <option value="5">5 Besar</option>
                                            <option value="10">10 Besar</option>
                                            <option value="50">50 Besar</option>
                                            <option value="100">100 Besar</option>
                                          

                                        </select>
                                    </div>
                                    <div class='col-2 col-lg-1'>
                                    <button type="submit" class="btn  btn-success-rgba"><i class="feather icon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0" >
                                    <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Sekolah</th>
                                                <th>Poin</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id='tableSel'>
                                            
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                            <script>
                                $(document).on('change','#cabang',function(){
                                    var id = $(this).val();
                                    $.ajax({
                                        type:'POST',
                                        url:'<?= base_url('administrator/seeKelas') ?>',
                                        data:{id:id},
                                        success:function(resp){
                                            $('#kelas').html(resp);
                                        }
                                    })
                                })
                                var kelas = $('#kelas').val();
                                var limit = $('#limit').val();
                                var sekolah = $('#cabang').val();
                                var start = $('#start').val();
                                var end = $('#end').val();
                                dataPeringkat(kelas,limit,start,end,sekolah);
                                function dataPeringkat(kelas,limit,start,end,sekolah){
                                    console.log(kelas);
                                    $.ajax({
                                            type:"POST",
                                            url:"<?php echo base_url('administrator/dataPeringkat'); ?>",
                                            data:{kelas:kelas,limit:limit,start:start,end:end,sekolah:sekolah},
                                        
                                        
                                            beforeSend: function(){
                                                
                                                
                                                $('#tableSel').html('<tr><td colspan=5><div class="d-flex align-items-center"><strong>Loading...</strong><div class="spinner-border ml-auto" role="status" aria-hidden="true"></div></div></td></tr>');
                                            
                                            
                                
                                            },
                                            success: function(resp){
                                            
                                            $('#tableSel').html(resp);
                                            
                                            
                                            
                                            },
                                            complete: function() {
                                            
                                                
                                                
                                                
                                            },
                                        });
                                }
                                $(document).on('submit', '#formAct', function(e) {
                                    e.preventDefault();
                                    var kelas = $('#kelas').val();
                                    var limit = $('#limit').val();
                                    var start = $('#start').val();
                                    var end = $('#end').val();
                                    var sekolah = $('#cabang').val();
                                    dataPeringkat(kelas,limit,start,end,sekolah);
                                });
                            </script>