<?php

    $pegawai = $this->model_app->view_where("pegawai",array('id_sd'=>$cabang['id_sd']))->num_rows();
    $pengawas = $this->model_app->view_where("pengawas",array('id_sd'=>$cabang['id_sd']))->num_rows();
    $sekolah = $this->model_app->view_where('subdomain',array('status'=>'sekolah'))->num_rows();
    $soal = $this->model_app->view_where('quiz',array('status'=>'y'))->num_rows();

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
                        <h5 class="card-title font-14">Pegawai</h5>
                        <h4 class="mb-0"><?= $pegawai ?></h4>
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
                        <h5 class="card-title font-14">Pengawas</h5>
                        <h4 class="mb-0"><?= $pengawas ?></h4>
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
                        <span class="action-icon badge badge-primary-inverse mr-0"><i class="la la-building-o"></i></span>
                    </div>
                    <div class="col-7 text-right">
                        <h5 class="card-title font-14">Sekolah</h5>
                        <h4 class="mb-0"><?=$sekolah ?></h4>
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
                        <h5 class="card-title font-14">Soal</h5>
                        <h4 class="mb-0"><?=$soal ?></h4>
                    </div>
                  </div>
                </div>
                
              </div>
          </div>
         <div class="col-lg-6 col-xl-12">
                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Kehadiran Hari Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="apex-pie-chart"></div>
                                        <div class="row">
                                            <div class="col-6 text-right">
                                                <p class="mb-1">Hadir<i class="mdi mdi-circle text-primary ml-2"></i></p>
                                                <h5 class="mb-0" id="hadir">105</h5>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1"><i class="mdi mdi-circle text-light mr-2"></i>Tidak</p>
                                                <h5 class="mb-0" id="tidak">45</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="row">
                                            <div class="col-6 border-right">
                                                <p class="my-2"><span class="font-18 f-w-6 text-primary" id="persen">75%</span></p>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?= base_url('administrator/absensi')?>"><p class="my-2">See All</p></a>
                                            </div>
                                        </div>
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
                        <div class="col-7">
                          <h5 class="card-title mb-0">Grafik Absensi Pegawai</h5>
                        </div>
                        <div class="col-5">
                         
                                    <select name="daily" id="daily" class="form-control">
                                        <option value="hari">Harian</option>
                                        <option value="minggu">Mingguan</option>
                                        <option value="bulan">Bulanan</option>

                                    </select>
                                
                        </div>
                    </div>
                  </div>
                <div class="card-body py-0 pl-0 pr-2">
                      <div id="chartPegawai"></div>
                 </div>
            </div>
      </div>
      <div class="col-lg-12 col-xl-12">
          <div class="card m-b-30">
              <div class="card-header">                                
                    <div class="row">                      
                        <div class="col-4">
                          <h5 class="card-title mb-0">Grafik Absensi Guru</h5>
                        </div>
                        <div class="col-8">
                         <form id="formGuru">
                             <div class="row">
                                <div class="col-5">
                                    <select name="sekolah" id="sekolahSel" class="form-control">
                                        <?php 
                                            $sekolah = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'id_sd','DESC');
                                            if($sekolah->num_rows() > 0){
                                                foreach($sekolah->result_array() as $sch){
                                                    echo "<option value='".encode($sch['id_sd'])."'>".$sch['nama_cabang']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select name="status" id="status" class="form-control">
                                            <option value="hari">Harian</option>
                                            <option value="minggu">Mingguan</option>
                                            <option value="bulan">Bulanan</option>

                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary">
                                        <i class="dripicons-search"></i>
                                    </button>
                                </div>
                             </div>
                                    
                        </form>   
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
                                        <h5 class="card-title mb-0">Sekolah</h5>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0" id='dataTable' >
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Sekolah</th>
                                                <th>Nama Sekolah</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Jumlah Guru</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php 
                                                $school = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));
                                                if($school->num_rows() > 0){
                                                    $no=1;
                                                    foreach($school->result_array() as $sch){
                                                        $guru = $this->model_app->view_where('guru',array('id_sd'=>$sch['id_sd']))->num_rows();
                                                        $siswa = $this->model_app->view_where('siswa',array('id_sd'=>$sch['id_sd']))->num_rows();

                                                        echo "<tr>
                                                                <td>".$no."</td>
                                                                <td>".strtoupper($sch['jenis_sekolah'])."</td>
                                                                <td>".strtoupper($sch['nama_cabang'])."</td>
                                                                <td>".$siswa." Siswa</td>
                                                                <td>".$guru." Siswa</td>


                                                            </tr>";
                                                        $no++;

                                                    }
                                                }
                                            ?>
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
   
   
    var options = {
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
         grafikAbsensiPegawai('hari');
        $(document).on('change','#daily',function(){
            grafikAbsensiPegawai($(this).val());
             
         })

            
            var chart = new ApexCharts(document.querySelector("#chartPegawai"), options);
            chart.render();

            grafikAbsensiGuru(null,'hari');
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
    function grafikAbsensiPegawai(status){
        $.ajax({
            type:'POST',
            url:'<?=base_url('administrator/grafikPegawai')?>',
            data:{status:status},
            dataType:'json',
            beforeSend:function(){
                
            },
            success:function(resp){
               
                chart.updateOptions({
                xaxis: {
                    categories: resp.tanggal,
                },
                
                
                })
                chart.updateSeries([
                    {name: 'Absen', data: resp.absen}, 
                    {name: 'DL', data: resp.dl}, 
                    {name: 'TL',data: resp.tl}, 
                    {name: 'Alpha ',data: resp.tidak},
                   
                ])
               
               
                
          },
     })
              
                
        
    }
    $(document).on('submit','#formGuru',function(e){
        e.preventDefault();
        var sekolah = $('#sekolahSel').val();
        var status = $('#status').val();
        grafikAbsensiGuru(sekolah,status);

    })
    function grafikAbsensiGuru(sekolah,status){
        $.ajax({
            type:'POST',
            url:'<?=base_url('administrator/grafikGuru')?>',
            data:{status:status,sekolah:sekolah},
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
    kehadiran();
    function kehadiran(){
        $.ajax({
            type:'POST',
            url:'<?=base_url('administrator/kehadiranToday')?>',
            dataType:'json',
            success:function(resp){
                $('#hadir').html(resp.absensi);
                $('#tidak').html(resp.tidak);
                $('#persen').html(resp.persen+'%');
                var options = {
        chart: {
            type: 'donut',
            width: 180,
            height: 150
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "85%"
                }
            }
        },
        noData: {
          text: 'Loading...'
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#0080ff', '#d4d8de'],
        series: [resp.absensi, resp.tidak],
        labels:['Hadir','Tidak Hadir'],
        legend: {
            show: false,
        },
    }
    var chart = new ApexCharts(
        document.querySelector("#apex-pie-chart"),
        options
    );    
    chart.render();
            }
        })
       
    }
</script>