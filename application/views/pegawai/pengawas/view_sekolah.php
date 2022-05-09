<style>
    .border-active{
        background-color:#b50c0d;
        color:white;
        border-color:#000000;
    }
    .border-active h5{
        color:white;
    }
    .border-active span{
        color:white;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-6 form-group mt-4" >
           
            <select name="sekolah" id="sekolah" class="form-control">
                <option disabled selected ></option>
                <?php if($record->num_rows() > 0){
                    $no = 1;
                    foreach($record->result_array() as $row){
                        
                            echo "<option value=".encode($row['id_sd'])." >".strtoupper($row['nama_cabang'])."</option>";
                            
                        
                        $no++;
                    }
                        }?>
            </select>
        </div>
        <div class="col-6 form-group mt-4">
            <input type="date" class="form-control" id="date" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="col-12 mt-2">
            <button id="btnFilter" class="btn btn-danger w-100">FILTER</button>
        </div>
        <div class="col-12 my-5" >
             <div class="row justify-content-center">
                <div class="col-12 my-2">
                    <h5  id="sekolahIdentity">Sekolah</h5>
                </div>
                <div class="col-12 my-1"> 
                    <h5 id="kepsek"> <span class="mr-2" >Kepala Sekolah  </span> Nama Kepsek </h5>
                </div>
                <div class="col-12 my-1"> 
                    <h5 id="guru"> <span class="mr-2">Guru  </span> 0 Guru</h5>
                </div>
                <div class="col-12 my-1">
                    <h5 id="siswa"> <span class="mr-2">Siswa  </span> 0 Siswa</h5>
                </div>
                  <div class="col-12 my-1">
                    <h5 id="vaksin"> <span class="mr-2">Sudah Vaksin  </span> 0 Siswa</h5>
                </div>
                <div class="col-12 my-1">
                    <h5 id="belumVaksin"> <span class="mr-2">Belum Vaksin  </span> 0 Siswa</h5>
                </div>
                <div class="col-12 my-1">
                    <hr>
                </div>
                <div class="col-5 border border-danger text-center py-1 mx-1 " style="border-radius:20px;" id="grafik">
                   
                        <span class="ri-user-2-fill" style="font-size:30px;"></span>
                        <h5 >Grafik</h5>
                  
                </div>
                <div class="col-5 border border-danger text-center py-1 mx-1"  style="border-radius:20px;" id="report">
                   
                        <span class="ri-building-4-fill" style="font-size:30px;"></span>
                        <h5 >Report</h5>
               
                </div>
                <div class="col-12 my-2">
                    <hr>
                </div>
                <div class="col-12 my-3" id="dataReport"></div>
                <div class="col-12 my-3" id="dataMenu">
                    <div class="row" >
                        <div class="col-12 my-1">
                            <h3>Grafik Guru</h3>
                        </div>
                        <div class="col-12 my-2">
                                <canvas id="bar-chart" width="auto" height="auto"></canvas>
                        </div>
                        <div class="col-12 mt-5 mb-3">
                            <div class="row">
                                <div class="col-6" data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir"><span style="background-color:#3e95cd " class="px-1" >&nbsp; &nbsp;</span> Hadir</div>
                                <div class="col-2"  data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir" id="countHadir">0</div>
                                <div class="col-4"  data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir">Pegawai</div>
                                <div class="col-12">
                                    <div class="collapse" id="hadir">
                                        <div class="card card-body  my-3">
                                            <ul id="dataHadir">
                                        
                                        
                                            </ul>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-6"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir"><span style="background-color:#8e5ea2 " class="px-1" >&nbsp; &nbsp;</span> Belum Hadir</div>
                                <div class="col-2"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir" id="countBelum">0</div>
                                <div class="col-4"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir">Pegawai</div>
                                <div class="col-12">
                                    <div class="collapse" id="tidakhadir">
                                        <div class="card card-body  my-3">
                                            <ul id="dataBelum">
                                        
                                        
                                        
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit"><span style="background-color:#3cba9f " class="px-1" >&nbsp; &nbsp;</span> Sakit</div>
                                <div class="col-2" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit" id="countSakit">0</div>
                                <div class="col-4" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit">Pegawai</div>
                                <div class="col-12">
                                    <div class="collapse" id="sakit">
                                        <div class="card card-body  my-3">
                                            <ul id="dataSakit">
                                        
                                        
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                <div class="col-6" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin"><span style="background-color:#e8c3b9 " class="px-1" >&nbsp; &nbsp;</span> Ijin</div>
                                <div class="col-2" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin" id="countIzin">0</div>
                                <div class="col-4" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin">Pegawai</div>
                                    <div class="col-12">
                                    <div class="collapse" id="ijin">
                                        <div class="card card-body  my-3">
                                            <ul id="dataIzin">
                                        
                                        
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                <div class="col-6" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat"><span style="background-color:#c45850 " class="px-1" >&nbsp; &nbsp;</span> Terlambat</div>
                                <div class="col-2" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat" id="countTerlambat">0</div>
                                <div class="col-4" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat">Pegawai</div>
                                <div class="col-12">
                                    <div class="collapse" id="terlambat">
                                        <div class="card card-body  my-3">
                                            <ul id="dataTerlambat"> 
                                            
                                        
                                            </ul>
                                        </div>
                                        </div>
                                    </div>

                                <div class="col-6"  data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang"><span style="background-color:#faae49 " class="px-1" >&nbsp; &nbsp;</span> Pulang Cepat</div>
                                <div class="col-2" data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang" id="countPulang">0</div>
                                <div class="col-4" data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang">Pegawai</div>
                                    <div class="col-12">
                                    <div class="collapse" id="pulang">
                                        <div class="card card-body  my-3">
                                            <ul id="dataPulang">
                                            
                                        
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        
        </div>
    </div>
</div>

<script>
    
 // executes when complete page is fully loaded, including all frames, objects and images
    // $("#sekolah option:first").change();
    grafikSekolah(0,0,0,0,0,0);

    function grafikSekolah(hadir,belum,sakit,izin,telat,pulang){
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
            labels: ["Hadir", "Belum Absen", "Sakit", "Izin", "Terlambat", "Pulang Cepat"],
            datasets: [
                {
                label: "Guru",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#faae49"],
                data: [hadir,belum,sakit,izin,telat,pulang]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Grafik Absensi Guru'
            }
            }
        });
    }
    $(document).on('click','#grafik',function(){
        var id = $('#sekolah').val();
        var tanggal = $('#date').val();

        if(id == null || id == ''){
            $('#sekolah').focus();
        }else{
            grafik(id,tanggal);
        }
    })
    $(document).on('click','#report',function(){
        var id = $('#sekolah').val();
        var tanggal = $('#date').val();

        if(id == null || id == ''){
            $('#sekolah').focus();
        }else{
            
            report(id,tanggal);
        }
    })
    $('#dataReport').hide();

    function report(id,tanggal){
        $.ajax({
            type:'POST',
            url:'<?= base_url('pengawas/getSekolahReport') ?>',
            data:{id:id,tanggal:tanggal},
            dataType:'json',
            beforeSend:function(){
                $('#loader').css('display','');
            },success:function(resp){
                if(resp.status == true){
                    $('#dataMenu').hide();
                    $('#dataReport').show();
                    $('#grafik').removeClass('border-active');

                    $('#report').addClass('border-active');
                    $('#dataReport').html(resp.output);
                }
            },complete:function(){
                $('#loader').css('display','none');
            }
        });
    }
    function grafik(id,tanggal){
        $.ajax({
            type:'POST',
            url:'<?= base_url('pengawas/getSekolahGrafik') ?>',
            data:{id:id,tanggal:tanggal},
            dataType:'json',
            beforeSend:function(){
                $('#loader').css('display','');
            },success:function(resp){
                if(resp.status == true){
                    $('#dataMenu').show();
                    $('#dataReport').hide();
                    $('#grafik').addClass('border-active');
                    $('#report').removeClass('border-active');

                    grafikSekolah(resp.arr.countHadir,resp.arr.countBelum,resp.arr.countSakit,resp.arr.countIzin,resp.arr.countTerlambat,resp.arr.countPulang);
                    $('#sekolahIdentity').html(resp.arr.sekolah);
                   
                    $('#kepsek').html(resp.arr.kepsek);
                    $('#guru').html(resp.arr.guru);
                    $('#siswa').html(resp.arr.siswa);
                    $('#vaksin').html(resp.arr.vaksin);
                    $('#belumVaksin').html(resp.arr.belumVaksin);

                    $('#countHadir').html(resp.arr.countHadir);
                    $('#countBelum').html(resp.arr.countBelum);
                    $('#countSakit').html(resp.arr.countSakit);
                    $('#countIzin').html(resp.arr.countIzin);
                    $('#countTerlambat').html(resp.arr.countTerlambat);
                    $('#countPulang').html(resp.arr.countPulang);
                    $('#dataHadir').html(resp.arr.dataHadir);
                    $('#dataBelum').html(resp.arr.dataBelum);
                    $('#dataSakit').html(resp.arr.dataSakit);
                    $('#dataIzin').html(resp.arr.dataIzin);
                    $('#dataTerlambat').html(resp.arr.dataTerlambat);
                    $('#dataPulang').html(resp.arr.dataPulang);
                   




                }
            },complete:function(){
                $('#loader').css('display','none');

            }
        })
    }
    $(document).on('click','#btnFilter',function(){
        var id = $('#sekolah').val();
        var tanggal = $('#date').val();
        if(id == '' || id == null){
            $('#sekolah').focus();

        }else if(tanggal == '' || tanggal == null){
                $('#tanggal').focus();
        }else{
            
            
            grafik(id,tanggal);
        }
    })
    $(document).on('click','.detail',function(){
        var id = $(this).attr('data-id');
        window.location = '<?= base_url('pengawas/reportDetail?id=') ?>'+id;
    })
</script>