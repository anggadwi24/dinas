<?php 
  $yes = date('Y-m-d',strtotime("-1 Days"));
  $now = date('Y-m-d');
  $yesSiswa = $this->db->query("SELECT * FROM siswa WHERE active='y' AND created_at <= '".$yes." 23:59:59' AND id_sd ='".$cabang['id_sd']."' ")->num_rows();
  $todaySiswa = $this->db->query("SELECT * FROM siswa WHERE active='y' AND created_at <= '".$now." 23:59:59'  AND id_sd ='".$cabang['id_sd']."' ")->num_rows();

  $siswa = $this->model_app->view_where('siswa',array('active'=>'y','id_sd'=>$cabang['id_sd']))->num_rows();

  if($todaySiswa > $yesSiswa){
    $selSiswa = $todaySiswa-$yesSiswa;
    $perSiswa = round(($selSiswa/$yesSiswa ) * 100,0);
    
  }else{
    $perSiswa = 0;
  }

  $yesGuru = $this->db->query("SELECT * FROM guru WHERE status='active' AND created_on<= '".$yes." 23:59:59' AND id_sd ='".$cabang['id_sd']."' ")->num_rows();
  $todayGuru = $this->db->query("SELECT * FROM guru WHERE status='active' AND created_on <= '".$now." 23:59:59'  AND id_sd ='".$cabang['id_sd']."' ")->num_rows();

  $guru = $this->model_app->view_where('guru',array('status'=>'active','id_sd'=>$cabang['id_sd']))->num_rows();

  if($todayGuru > $yesGuru){
    $selGuru = $todayGuru-$yesGuru;
    $perGuru = round(($selGuru/$yesGuru ) * 100,0);
    
  }else{
    $perGuru = 0;
  }


  $yesQuiz = $this->db->query("SELECT * FROM quiz WHERE status='y' AND created_at <= '".$yes." 23:59:59'  ")->num_rows();
  $todayQuiz = $this->db->query("SELECT * FROM quiz WHERE status='y' AND created_at <= '".$now." 23:59:59' ")->num_rows();

  $quiz = $this->model_app->view_where('quiz',array('status'=>'y'))->num_rows();

  if($todayQuiz > $yesQuiz){
    $selQuiz = $todayQuiz-$yesQuiz;
    $perQuiz = round(($selQuiz/$yesQuiz ) * 100,0);
    
  }else{
    $perQuiz = 0;
  }

  $yesPart = $this->db->query("SELECT * FROM quiz_partisipasi a JOIN siswa b ON a.id_siswa = b.id_siswa WHERE  a.created_at >= '".$yes." 00:00:00' AND a.created_at <= '".$yes." 23:59:59' AND id_sd ='".$cabang['id_sd']."' ")->num_rows();
  $todayPart = $this->db->query("SELECT * FROM quiz_partisipasi a JOIN siswa b ON a.id_siswa = b.id_siswa WHERE a.created_at >= '".$now." 00:00:00' AND id_sd ='".$cabang['id_sd']."' ")->num_rows();

  $part = $todayPart;
  $selPart = $todayPart - $yesPart;

  if($selPart > 1){
    if($todayPart > $yesPart){
      $selPart = $todayPart-$yesPart;
      $perPart = ($selPart/$yesPart ) * 100;
      
    }else{
      $perPart = 0;
    }
  }else{
    $perPart = 100;
  }
  
  
?>
<div class='row'>
  <div class="col-lg-12 col-xl-3">
      <div class='row'>
         <div class="col-lg-6 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-5">
                        <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                    </div>
                    <div class="col-7 text-right">
                        <h5 class="card-title font-14">Siswa</h5>
                        <h4 class="mb-0"><?= $siswa ?></h4>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row align-items-center">
                      <div class="col-8">
                        <span class="font-13">Updated Today</span>
                      </div>
                      <div class="col-4 text-right">
                        <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i><?= $perSiswa?>%</span>
                      </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-lg-6 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-5">
                        <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                    </div>
                    <div class="col-7 text-right">
                        <h5 class="card-title font-14">Guru</h5>
                        <h4 class="mb-0"><?= $guru ?></h4>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row align-items-center">
                      <div class="col-8">
                        <span class="font-13">Updated Today</span>
                      </div>
                      <div class="col-4 text-right">
                        <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i><?= $perGuru?>%</span>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        
          <div class="col-lg-6 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-5">
                        <span class="action-icon badge badge-primary-inverse mr-0"><i class="dripicons-view-list-large"></i></span>
                    </div>
                    <div class="col-7 text-right">
                        <h5 class="card-title font-14">Soal</h5>
                        <h4 class="mb-0"><?=$quiz ?></h4>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row align-items-center">
                      <div class="col-8">
                        <span class="font-13">Updated Today</span>
                      </div>
                      <div class="col-4 text-right">
                        <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i><?= $perQuiz ?>%</span>
                      </div>
                  </div>
                </div>
              </div>
          </div>

          <div class="col-lg-6 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-5">
                        <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-clipboard"></i></span>
                    </div>
                    <div class="col-7 text-right">
                        <h5 class="card-title font-14">Quiz</h5>
                        <h4 class="mb-0"><?=$part ?></h4>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row align-items-center">
                      <div class="col-8">
                        <span class="font-13">Updated Today</span>
                      </div>
                      <div class="col-4 text-right">
                        <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i><?= $perPart ?>%</span>
                      </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-lg-12 col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <h5 class="card-title mb-0">Peringkat Quiz</h5>
                                    </div>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetBestDoctors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetBestDoctors">
                                                <a class="dropdown-item font-13" onClick=dataTopLim()>Refresh</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='card-body py-0'>
                                <ul class="list-unstyled" id='dataTop'>
                                    
                              </ul>
                            </div>
                        </div>
          </div>
          
      </div>
  </div>
  <div class="col-lg-12 col-xl-9">
      <div class='row'>
      <div class="col-lg-12 col-xl-12">
          <div class="card m-b-30">
              <div class="card-header">                                
                    <div class="row">                      
                        <div class="col-4">
                          <h5 class="card-title mb-0">Grafik Absensi Guru</h5>
                        </div>
                        <div class="col-8">
                         
                                    <select name="status" id="status" class="form-control">
                                            <option value="hari">Harian</option>
                                            <option value="minggu">Mingguan</option>
                                            <option value="bulan">Bulanan</option>

                                    </select>
                               
                        </div>
                    </div>
                  </div>
                <div class="card-body py-0 pl-0 pr-2">
                      <div id="chartGuru"></div>
                 </div>
            </div>
      </div>
      <div class="col-lg-12 col-xl-12">
          <div class="card m-b-30">
              <div class="card-header">                                
                  <div class="row align-items-center">
                       <div class="col-9">
                          <h5 class="card-title mb-0">Quiz Performance</h5>
                        </div>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetStudent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetStudent">
                                      <a class="dropdown-item font-13" href="#">Refresh</a>
                                      <a class="dropdown-item font-13" href="#">Export</a>
                                 </div>
                            </div>
                          </div>
                    </div>
                  </div>
                <div class="card-body py-0 pl-0 pr-2">
                      <div id="chart"></div>
                 </div>
            </div>
      </div>
      <div class="col-lg-12 col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    <div class="col-6 col-lg-7">
                                        <h5 class="card-title mb-0">Top Siswa</h5>
                                    </div>
                                    <div class="col-2 col-lg-2">
                                        <select class="form-control font-12" id='selLimit'>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                          

                                        </select>
                                    </div>
                                    <div class="col-4 col-lg-3">
                                        <select class="form-control font-12" id='selKelas'>
                                            <option value="all">Semua</option>
                                            <?php 
                                              $cbg = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                                              $jenis = $cbg['jenis_sekolah'];
                                              if($jenis == 'sd'){
                                                echo "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                                            }else if($jenis == 'smp'){
                                                echo "<option value='VII'>VII</option><option value='VIII'>VIII</option><option value='IX'>IX</option>";
                                            }else if($jenis == 'sma'){
                                                echo "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0" >
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Jumlah Kuis</th>
                                                <th>Poin</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id='tableSel'>
                                            
                                        </tbody>
                                    </table>
                               </div>
                            </div>
</div>
      </div>
  </div>


</div>
<script src="<?= theme()?>/plugins/apexcharts/apexcharts.min.js"></script>
<script src="<?= theme()?>/js/custom/custom-dashboard-school.js"></script>
<script>
  $(document).on('change','#status',function(){
    grafikAbsensiGuru($(this).val());
    })
          grafikAbsensiGuru('hari');
            var options1 = {
              series: [],
              chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                stackType: '100%',
                toolbar: {
                  show: false
                },
                zoom: {
                  enabled: true
                }
             },
              dataLabels: {
                  enabled: true
              },
              title: {
                  text: '',
              },
              noData: {
                  text: 'Loading...'
              },
              legend: {
                position: 'top',
                offsetX: 0,
                fontSize:'10px;',
                offsetY: 0
              },
              xaxis: {
                  type: 'category',
                  tickPlacement: 'on',
                  labels: {
                      rotate: -45,
                      rotateAlways: true
                  }
              }
            };
            
            var chartGuru = new ApexCharts(document.querySelector("#chartGuru"), options1);
            chartGuru.render();
            function grafikAbsensiGuru(status){
              $.ajax({
                  type:'POST',
                  url:'<?=base_url('administrator/grafikGuru')?>',
                  data:{status:status},
                  dataType:'json',
                  beforeSend:function(){
                      
                  },
                  success:function(resp){
                  
                    chartGuru.updateOptions({
                    xaxis: {
                        categories: resp.tanggal,
                    },
                    
                    
                    })
                    chartGuru.updateSeries([
                        {name: 'Absen', data: resp.absen}, 
                        {name: 'DL', data: resp.dl}, 
                        {name: 'TL',data: resp.tl}, 
                        {name: 'Alpha ',data: resp.tidak},
                      
                    ])
                      
                },
          })
                    
                      
              
          }
  $(document).on('change', '#selKelas', function(e) {
    var kelas = $(this).val();
    var limit = $('#selLimit').val();
    dataTop(kelas,limit);
  });

  $(document).on('change', '#selLimit', function(e) {
    var kelas = $('#selKelas').val();
    var limit = $('#selLimit').val();
    dataTop(kelas,limit);
  });
  dataTop('all',5);
  function dataTop(kelas,limit){
  
    $.ajax({
            type:"POST",
            url:"<?php echo base_url('administrator/dataTop'); ?>",
            data:{kelas:kelas,limit:limit},
          
          
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
  dataTopLim();
  function dataTopLim(){
    $.ajax({
            type:"POST",
            url:"<?php echo base_url('administrator/dataTop5'); ?>",
           
          
          
             beforeSend: function(){
                
                
                $('#dataTop').html('<div class="d-flex align-items-center"><strong>Loading...</strong><div class="spinner-border ml-auto" role="status" aria-hidden="true"></div></div>');
              
               
   
            },
            success: function(resp){
               
              $('#dataTop').html(resp);
             
              
              
            },
            complete: function() {
              
                
                 
              

            },
        });
  }

</script>