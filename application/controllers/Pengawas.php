<?php
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengawas extends CI_Controller {
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
         $this->key = "aplikasidatakepegawaianENCRYPTION30224923912";
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
         $this->cabang = $cabang['id_sd'];
         if($cabang['status'] != 'dinas'){
           exit();
         }
       
    }
    function index(){
      cek_session_pengawas();
       $data['title'] = "APLIKASI E-LAPKER";
      $this->template->load(base_theme().'/template-pengawas',base_theme().'/pengawas/view_home',$data);

    }
    function sekolah(){
      cek_session_pengawas();
      $data['title'] = "APLIKASI E-LAPKER";
      $data['menu'] = 'SEKOLAH';
      $data['back'] = base_url('pengawas');
      $data['record'] = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));
     $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_sekolah',$data);
    }
    function reportDetail(){
      $id = decode($this->input->get('id'));
      $cek = $this->model_app->view_where('report',array('id_report'=>$id,'status_report'=>'guru'));
      if($cek->num_rows() > 0){
          $row = $cek->row_array();
          $data['title'] = "APLIKASI E-LAPKER";
          $data['menu'] = 'DETAIL REPORT';
          $data['back'] = base_url('pengawas/sekolah');
          $data['row'] = $row;
          $data['rows'] = $this->model_app->view_where('guru',array('id_guru'=>$row['id_pegawai']))->row_array();
        $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_report_guru',$data);
      }else{
        $this->session->set_flashdata('message','Report tidak ditemukan!');
        redirect('pengawas/sekolah');
      }
    }
    function getSekolahReport(){
      $output = null;
      $id = decode($this->input->post('id'));
      $date = $this->input->post('tanggal');
      $cek = $this->model_app->view_where('subdomain',array('id_sd'=>$id));
      if($cek->num_rows() > 0){
        $status = true;
       
        $data = $this->db->query("SELECT * FROM guru a JOIN report b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$id."' AND date = '".$date."' AND status_report= 'guru' ORDER BY id_report DESC ");
        $output .= "<div class='row justify-content-center'>";
        if($data->num_rows () > 0){
          foreach($data->result_array() as $row){
              if($row['finish'] == 'y'){
                  $border = 'border border-success';
              }else{
                  $border = 'border border-danger';
              }
              $output .= "<div class='col-11 my-2 py-3 ".$border." detail' data-id='".encode($row['id_report'])."' >
                              <div class='row'>
                                  <div class='col-3'>
                                      <img src='".$row['foto']."' style='widht:40px;height:40px' class='rounded-circle my-2' srcset=''> 
                                   </div>
                                   <div class='col-9'>
                                      <h6 class='mb-1'>".$row['judul_report']."</h6>
                                      <span class='my-0'>".$row['nama_guru']."</span>
                                   </div>
                              </div>
                          </div>";
          }
        }else{
            $output .= '<div class="col-12 my-2"><i>Tidak ada report</i></div>';
        }
        $output .= "</div>";
      }else{
        $status= false;
        $msg = 'Sekolah tidak ditemukan!';
      }

      echo json_encode(array('output'=>$output,'status'=>$status));
    }
    function getSekolahGrafik(){
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('subdomain',array('id_sd'=>$id));
      $arr = null;
      if($cek->num_rows() > 0 ){
       $date = $this->input->post('tanggal');

        $status = true;
        $msg = null;
        $row = $cek->row_array();
        $kepalasekolah= $this->model_app->view_where('kepala_sekolah',array('kepsek_id_sd'=>$id));
        $guru = $this->model_app->view_where('guru',array('id_sd'=>$id,'status'=>'active'));
        $siswa = $this->model_app->view_where('siswa',array('id_sd'=>$id,'active'=>'y'));
        $vaksin = $this->model_app->view_where('siswa',array('id_sd'=>$id,'active'=>'y','vaksin'=>'y'));
        $belumVaksin = $this->model_app->view_where('siswa',array('id_sd'=>$id,'active'=>'y','vaksin'=>'n'));


        // $quiz = $this->db->query("SELECT d.mapel,d.mapel_kelas,SUM(qp_poin) as total_poin , COUNT(id_qp) as total_peserta FROM siswa a JOIN quiz_partisipasi b ON a.id_siswa= b.id_siswa JOIN quiz_date c ON c.id_qd = b.qp_date JOIN mata_pelajaran d ON c.mapel_id = d.mapel_id WHERE a.id_sd = '".$id."' AND MONTH(c.tanggal) = ".date('m')." GROUP BY c.mapel_id" );
        $mapel = $this->db->query("SELECT * FROM siswa a JOIN mata_pelajaran b ON a.kelas = b.mapel_kelas WHERE a.id_sd = '".$id."' GROUP BY mapel_id ");
        if($kepalasekolah->num_rows () > 0){
          $kepsek = $kepalasekolah->row_array(); 
          $nama_kepsek = $kepsek['kepsek_name'];
        }else{
          $nama_kepsek = "";
        }
        $countHadir = 0;
        $countBelum = 0;
        $countSakit = 0;
        $countIzin = 0;
        $countTerlambat = 0;
        $countPulang = 0;
        $dataHadir = null;
        $dataBelum = null;
        $dataSakit = null;
        $dataIzin = null;
        $dataTerlambat = null;
        $dataPulang = null;
        if($guru->num_rows() > 0 ){
          $tanggal = date('Y-m-d');
          foreach($guru->result_array() as $gur){
            $absensi = $this->model_app->view_where('absensi',array('id_pegawai'=>$gur['id_guru'],'status_absen'=>'guru','tanggal'=>$date));
            if($absensi->num_rows() > 0){
              $countHadir +=1;
              $dataHadir .= '<li>'.$gur['nama_guru'].'</li>';
              $rowAbs = $absensi->row_array();
              if($rowAbs['telat'] == 'y'){
                $countTerlambat += 1;
                $dataTerlambat .= '<li>'.$gur['nama_guru'].'</li>';
              }else{
                $countTerlambat += 0;
                $dataTerlambat .= null;
              }

              if($rowAbs['pulang_awal'] == 'y'){
                $countPulang +=1;
                $dataPulang .=  '<li>'.$gur['nama_guru'].'</li>';
              }else{
                $countPulang +=0;
                  $dataPulang .=  null;
              }

            }else{
              $countBelum += 1;
              $dataBelum .= '<li>'.$gur['nama_guru'].'</li>';

            }
            $s = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $gur[id_guru] AND status ='Sakit' AND sampai >= '$date' AND status_form = 'guru'");
            if($s->num_rows() > 0){
              $countSakit += 1;
              $dataSakit .= '<li>'.$gur['nama_guru'].'</li>';
            }else{
              $countSakit += 0;
              $dataSakit .= null;
            }
            
            $i = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $gur[id_guru] AND status ='Izin' AND sampai >= '$date' AND status_form = 'guru'");
            if($i->num_rows() > 0){
              $countIzin += 1;
              $dataIzin .= '<li>'.$gur['nama_guru'].'</li>';
            }else{
              $countIzin += 0;
              $dataIzin = null;
            }
             
            
          }
        }
        $arr = array('sekolah'=>'<i class="ri-building-4-fill"></i> <span>'.strtoupper($row['jenis_sekolah']).'</span>  - '.strtoupper($row['nama_cabang']),
                   
                     'kepsek'=>' <span class="mr-2" >Kepala Sekolah  </span> '.$nama_kepsek.' ',
                     'guru'=>'<span class="mr-2">Guru  </span> '.$guru->num_rows().' Guru',
                     'siswa'=>'<span class="mr-2">Siswa  </span> '.$siswa->num_rows().' Siswa',
                     'countHadir'=>$countHadir,
                     'countBelum'=>$countBelum,
                     'countSakit'=>$countSakit,
                     'countIzin'=>$countIzin,
                     'countTerlambat'=>$countTerlambat,
                     'countPulang'=>$countPulang,
                     'dataHadir'=>$dataHadir,
                     'dataBelum'=>$dataBelum,
                     'dataSakit'=>$dataSakit,
                     'dataIzin'=>$dataIzin,
                     'dataTerlambat'=>$dataTerlambat,
                     'dataPulang'=>$dataPulang,
                     'vaksin'=>'<span class="mr-2">Sudah Vaksin  </span> '.$vaksin->num_rows().' Siswa',
                     'belumVaksin'=>'<span class="mr-2">Belum Vaksin  </span> '.$belumVaksin->num_rows().' Siswa',
                    );
      }else{
        $status = false;
        $msg = 'Sekolah tidak ditemukan!';

      }
      echo json_encode(array('status'=>$status,'msg'=>$msg,'arr'=>$arr));
    }
    function pegawai()
    {        cek_session_pengawas();
            $data['title'] = "APLIKASI E-LAPKER";
            $jabatan = $this->session->jabatan;
            $data['jabatan'] = $jabatan;
            $data['menu'] = 'PEGAWAI';
            $data['back'] = base_url('pengawas');
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           
            $status = $cabang['status'];
            $data['status'] = $status;
          
                    $data['kelurahan'] = $cabang['kelurahan'];
                    $data['kabupaten'] = $cabang['kabupaten'];
                    $data['kecamatan'] = $cabang['kecamatan'];
                    $data['id_sd'] = $cabang['id_sd'];
            $id_sd = $cabang['id_sd'];
            if($status == 'dinas'){
               if($jabatan == 'admin'){
                if(isset($_POST['submit'])){
                    
                    $data['sub_bagian'] = $this->input->post('sub');
                    $data['bagian'] =$this->input->post('bagian');
                    if($data['sub_bagian'] =='all' AND $data['bagian'] =='all')
                    { 
                        $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$id_sd));
                    }
                    elseif($data['sub_bagian'] == 'all'){
                        $data['bagian'] = $this->input->post('bagian');
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'id_sd'=>$id_sd));
                    
                    }else{
                        $data['bagian'] = $this->input->post('bagian');
                        $data['sub_bagian'] = $this->input->post('sub');
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian'],'id_sd'=>$id_sd));
                    }
                }else
                {
                    $data['bagian'] = 'all';
                    $data['sub_bagian'] = 'all';
                    $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$id_sd));
                }
            }else{
                //kepala bagian
                if($this->session->sub_bagian == 0){
                    if(isset($_POST['submit'])){
                        $data['sub_bagian'] = $this->input->post('sub');
                        $data['bagian'] = $this->session->bagian;
                    if($data['sub_bagian'] =='all')
                    {
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'id_sd'=>$id_sd));
                    }
                    else{
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian'],'id_sd'=>$id_sd));
                    }
                    }else{
                        $data['bagian'] = $this->session->bagian;
                        $data['sub_bagian'] = 'all';
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'id_sd'=>$id_sd));
                    }
                    


                }
                // kepala sub bagian
                else{
                    $data['bagian'] = $this->session->bagian;
                    $data['sub_bagian'] = $this->session->sub_bagian;
                    $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian'],'id_sd'=>$id_sd));
                }
            }
            }else{
              $sd = $this->input->post('cabang');
              $data['cabang'] = $sd;
              if(isset($sd)){
                 if($jabatan == 'admin'){
                if(isset($_POST['submit'])){
                    
                    $data['sub_bagian'] = $this->input->post('sub');
                    $data['bagian'] =$this->input->post('bagian');
                    if($data['sub_bagian'] =='all' AND $data['bagian'] =='all')
                    { 
                       $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$sd));
                    }
                    elseif($data['sub_bagian'] == 'all'){
                        $data['bagian'] = $this->input->post('bagian');
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'id_sd'=>$sd));
                    
                    }else{
                        $data['bagian'] = $this->input->post('bagian');
                        $data['sub_bagian'] = $this->input->post('sub');
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian'],'id_sd'=>$sd));
                    }
                }else
                {
                    $data['bagian'] = 'all';
                    $data['sub_bagian'] = 'all';
                   $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$sd));
                }
            }else{
                //kepala bagian
                if($this->session->sub_bagian == 0){
                    if(isset($_POST['submit'])){
                        $data['sub_bagian'] = $this->input->post('sub');
                        $data['bagian'] = $this->session->bagian;
                    if($data['sub_bagian'] =='all')
                    {
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'id_sd'=>$sd));
                    }
                    else{
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian'],'id_sd'=>$sd));
                    }
                    }else{
                        $data['bagian'] = $this->session->bagian;
                        $data['sub_bagian'] = 'all';
                        $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'id_sd'=>$sd));
                    }
                    


                }
                // kepala sub bagian
                else{
                    $data['bagian'] = $this->session->bagian;
                    $data['sub_bagian'] = $this->session->sub_bagian;
                    $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian'],'id_sd'=>$sd));
                    }
                }
              }
            }
           
           $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_pengawas',$data);
        
    }
    function sub(){
    $id_bagian = $this->input->post('id_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian' => $id_bagian),'id_sub_bagian','DESC');
    $this->load->view('pegawai/view_sub_bagian',$data);    
  }
  function report(){
     cek_session_pengawas();
          $data['title'] = "APLIKASI E-LAPKER";
          $jabatan = $this->session->jabatan;
          $data['jabatan'] = $jabatan;

          if($jabatan == 'admin'){
            if(isset($_POST['submit'])){
              
              $data['sub_bagian'] = $this->input->post('sub');
              $data['bagian'] =$this->input->post('bagian');
              if($data['sub_bagian'] =='all' AND $data['bagian'] =='all')
              {
                $data['peg'] = $this->model_app->view('pegawai');
              }
              elseif($data['sub_bagian'] == 'all'){
                $data['bagian'] = $this->input->post('bagian');
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian']));
              
              }else{
                $data['bagian'] = $this->input->post('bagian');
                $data['sub_bagian'] = $this->input->post('sub');
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian']));
              }
            }else
            {
              $data['bagian'] = 'all';
              $data['sub_bagian'] = 'all';
              $data['peg'] = $this->model_app->view('pegawai');
            }
          }else{
            //kepala bagian
            if($this->session->sub_bagian == 0){
              if(isset($_POST['submit'])){
                $data['sub_bagian'] = $this->input->post('sub');
                $data['bagian'] = $this->session->bagian;
              if($data['sub_bagian'] =='all')
              {
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian']));
              }
              else{
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian']));
              }
              }else{
                $data['bagian'] = $this->session->bagian;
                $data['sub_bagian'] = 'all';
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian']));
              }
              


            }
            // kepala sub bagian
            else{
              $data['bagian'] = $this->session->bagian;
              $data['sub_bagian'] = $this->session->sub_bagian;
              $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian']));
            }
          }
          $data['menu'] = 'Report Pegawai';
          $data['back'] = base_url('pengawas/pegawai');
           $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_report',$data);
  }
    function approveADD(){
     cek_session_pengawas();
          $data['title'] = 'ALOKASI DANA DESA - '.title();
          $data['menu'] = 'ALOKASI DANA DESA';
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $data['id_sd'] = $cabang['id_sd'];
          $data['back'] = base_url('pengawas');
          
         $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_approve',$data);

      }
    function dataTahap(){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $keyword = $this->input->post('keyword');
        $status = $this->input->post('status');
        $tahap = $this->input->post('tahap');
        
        if($status == 'alokasi' ){
            $this->dataTahapADD($cabang['id_sd'],$keyword,$tahap);
            
        }elseif($status == 'persentase' ){
            $this->dataPersentaseADD($cabang['id_sd'],$keyword,$tahap);
        }else if($status == 'all'){
            $this->dataTahapADD($cabang['id_sd'],$keyword,$tahap);
            $this->dataPersentaseADD($cabang['id_sd'],$keyword,$tahap);

        }


    }
    function dataTahapADD($cabang,$keyword,$tahap){
        $data = $this->model_app->dataTahapApp($cabang,$keyword,$tahap);
        $output = "<div class='col-12 mb-3 mt-2'><h3 class='text-center'>APPROVE PERSENTASE ADD</h3></div>";
        $output .= "<div class='col-12'><div class='row justify-content-center' style='max-height:15rem;overflow:auto'>";
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                if($row['id_parent'] != NULL AND $row['id_sub_parent'] == NULL){
                    $parent = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_parent']))->row_array();
                    if(strlen($parent['uraian']) > 35){
                        $pr = substr($parent['uraian'],0,35).'...';;
                    }else{
                        $pr = $parent['uraian'];
                    }
                    $parenting = "<small>".strtoupper($pr)."</small>";

                }elseif($row['id_parent'] != NULL AND $row['id_sub_parent'] != NULL){
                    $parent = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_parent']))->row_array();
                    if(strlen($parent['uraian']) > 20){
                        $pr = substr($parent['uraian'],0,20).'...';
                    }else{
                        $pr = $parent['uraian'];
                    }
                    $subparent = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_sub_parent']))->row_array();
                    if(strlen($subparent['uraian']) > 20){
                        $sp = substr($subparent['uraian'],0,20).'...';;
                    }else{
                        $sp = $subparent['uraian'];
                    }
                    $parenting = "<small>".strtoupper($pr)."<i class='ri-arrow-right-s-line'></i> ".strtoupper($sp)."</small>";

                }

                $me = $this->model_app->view_where('pegawai',array('id_pegawai'=>$row['created_by']))->row_array();
                $output .= "<div class='mb-2 p-2 col-11 bg-light detailADD' data-id='".$row['id_add']."' >
                                <div class='row'>
                                    <div class='col-12'><h6 class='mb-0'>".$row['uraian']."</h6></div>
                                    <div class='col-12'>".$parenting."</div>
                                    <div class='col-12 text-right' style='color:#B56C0D'><small class='text-right'>".$me['nama_panggilan']." | ".date('d/m/Y',strtotime($row['created_on']))."</small></div>


                                </div>
                            </div>";
            }
            $output.="</div></div>";

        }
        echo $output;
    }
    function dataPersentaseADD($cabang,$keyword,$tahap){
        $data = $this->model_app->dataPersentaseApp($cabang,$keyword,$tahap);
        $output = "<div class='col-12 mb-3 mt-3'><h3 class='text-center'>APPROVE ALOKASI DANA DESA</h3></div>";
        $output .= "<div class='col-12'><div class='row justify-content-center' style='max-height:15rem;overflow:auto'>";
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $add = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_add']))->row_array();

                    if(strlen($add['uraian_output']) > 35){
                        $pr = substr($add['uraian_output'],0,35).'...';;
                    }else{
                        $pr = $add['uraian_output'];
                    }
                    if(strlen($row['keteranganA']) > 50){
                        $keterangan = substr($row['keteranganA'],0,50).'...';;
                    }else{
                        $keterangan = $row['keteranganA'];
                    }

                    $parenting = "<small>".strtoupper($pr)."</small>";
                $me = $this->model_app->view_where('pegawai',array('id_pegawai'=>$row['id_pegawai']))->row_array();
                $output .= "<div class='mb-2 p-2 col-11 bg-light detailPersentase' data-id='".$row['id_pa']."' >
                                <div class='row'>
                                    <div class='col-2'><h3 class='mb-0'>".$row['persentase']."%</h3></div>
                                    <div class='col-10'><h6 class='mb-0'>".$keterangan."</h6></div>
                                    <div class='col-12'>".$parenting."</div>
                                    <div class='col-12 text-right' style='color:#B56C0D'><small class='text-right'>".$me['nama_panggilan']." | ".date('d/m/Y',strtotime($row['created_at']))."</small></div>


                                </div>
                            </div>";
            }
            $output.="</div></div>";

        }
        echo $output;
    }
    function detailAlokasiDesa(){
        $id = $this->input->get('id');
        $cek = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$id));
        if($cek->num_rows() > 0){
            $row=$cek->row_array();
            $data['row'] = $row;
            $data['title'] = $row['uraian_output'].' - '.title();
            $data['menu'] = $row['uraian_output'];
            $data['back'] = base_url('pengawas/approveADD');
           $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_add_detail',$data);

        }else{
            $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
            redirect('pengawas/approveADD');
        }
    }
    function detailPersentase(){
        $id = $this->input->get('id');
        $cek = $this->db->query("SELECT *,a.keterangan as keterangan_p,a.approve_pengawas as app_pengawas,a.realisasi as reali FROM persentase_add a JOIN alokasi_dana_desa b ON a.id_add = b.id_add WHERE id_pa = '".$id."' ");
        if($cek->num_rows() > 0){
            $row=$cek->row_array();
            $data['row'] = $row;
            $data['title'] = $row['keterangan_p'].' - '.title();
            $data['menu'] = $row['keterangan_p'];
            $data['back'] = base_url('pengawas/approveADD');
           $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_persentase_app',$data);

        }else{
            $this->session->set_flashdata('message','Pencapaian Alokasi Dana Desa Tidak Ditemukan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    function appPersentaseADD(){
        $status = $this->input->post('status');
        $id_add = $this->input->post('id_add');
        $id_pa = $this->input->post('id_pa');
        $add = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$id_add))->row_array();
        $real = $add['realisasi'];
        $realisasi = $this->input->post('realisasi');
        $persentase = $this->input->post('persentase');

        if($realisasi != NULL OR $realisasi != ""){
            if($real == NULL){
                $real_now = $realisasi;
            }else{
                $real_now = $real+$realisasi;
            }
            
        }else{
            $real_now = $real;
        }
        $output = $this->input->post('output');
        if($output){
            $output_now = $output;
        }else{
            $output_now = $add['keterangan'];
        }

        $me = $this->session->id_pengawas;

        if($status == 'n'){
            $data = array('status_laporan'=>'y','approve_pengawas'=>$me);
           

            $data1 = array('keterangan'=>$output_now,'capaian_output'=>$persentase,'realisasi'=>$real_now);

        }else{
            $data = array('status_laporan'=>'y','approve_pengawas'=>$me);

            $data1 = array('keterangan'=>$output_now,'capaian_output'=>$persentase,'realisasi'=>$real_now,'status'=>'y');

            
        }

        $this->model_app->update('persentase_add',$data,array('id_pa'=>$id_pa));
        $this->model_app->update('alokasi_dana_desa',$data1,array('id_add'=>$id_add));

        echo base_url('pengawas/detailAlokasiDanaDesa?id=').$id_add;


    }
    function cancelPersentase(){
        $id_pa = $this->input->post('id');
        $this->model_app->update('persentase_add',array('status_laporan'=>'n','approve_pengawas'=>$this->session->id_pengawas),array('id_pa'=>$id_pa));
        echo base_url('pengawas/approveADD');


    }
    function cekTahap(){
    $tahap = $this->input->post('id');
    $cek = $this->model_app->view_where('tahap_add',array('id_tahap'=>$tahap));
    if($cek->num_rows() > 0){
       echo base_url('pengawas/detailTahap?tahap=').$this->input->post('id');
    }else{
      echo false;
    }
    }
    function detailTahap(){
    $tahap = $this->input->get('tahap');
   
    $cek = $this->model_app->view_where('tahap_add',array('id_tahap'=>$tahap));
    if($cek->num_rows () > 0){
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            $data['id_sd'] = $this->encrypt->encode($cabang['id_sd'],$this->key);
            $row = $cek->row_array();
            $data['row']= $row;
            $data['back'] = base_url('pengawas/alokasiDanaDesa');
            $data['key'] = $this->key;
            $data['title'] = 'TAHAP '.$row['tahap'].' '.$row['tahun']. ' - '.title();
            $data['menu'] = 'ALOKASI DANA DESA <br>TAHAP '.$row['tahap'].' TAHUN '.$row['tahun'];
            $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_tahap_detail',$data);
       
    }else{
        $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
        redirect('pengawas/alokasiDanaDesa');
    }
  }
  function detailAlokasiDanaDesa(){
    $id = $this->input->get('id');
    $cek = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$id));
    if($cek->num_rows() > 0 ){
        $row = $cek->row_array();
        if($row['approve_pengawas'] == 'p'){
            redirect('pengawas/detailAlokasiDesa?id='.$row['id_add']);
        }else{
            $data['row'] = $row;
            $data['title']= $row['uraian_output'].' - '.title();
            $data['back'] = base_url('pengawas/detailTahap?tahap=').$row['id_tahap'];
            if(strlen($row['uraian_output']) > 50){
                $menu = substr($row['uraian_output'],0,50).'...';
            }else{
                $menu = $row['uraian_output'];
            }
            $data['menu'] =  $menu;
            $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_detail_add',$data);
        }
        

    }else{
        $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
        redirect($_SERVER['HTTP_REFERER']);

    }
  }
  function dataAlokasi(){
    $tahap = $this->input->post('tahap');
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];

    $data = $this->model_app->view_where_ordering('alokasi_dana_desa',array('id_sd'=>$id_sd,'id_tahap'=>$tahap,'id_parent'=>NULL),'kode_rekening','ASC');
    $output ='
         
        ';
    foreach($data->result_array() as $row){
      $output .= "<div class='col-12 mb-2 bg-light py-3 detail' data-id='".$row['id_add']."'>
                    <div class='row justify-content-center'>
                        <div class='col-11 '><h6 class='text-dark'>".$row['kode_rekening'].". ".$row['uraian']."</h6></div>
                       
                    </div>
                 </div>";
      $sub_parent = $this->model_app->view_where_ordering('alokasi_dana_desa',array('id_sd'=>$id_sd,'id_tahap'=>$tahap,'id_parent'=>$row['id_add'],'id_sub_parent'=>NULL),'kode_rekening','ASC');
      foreach($sub_parent->result_array() as $sRow){
        if($sRow['kode_rekening'] == null){
          if($sRow['status'] == 'y'){
              $sts = '<h2 class="text-success"><i class="ri-check-double-line text-success"></i></h2>';
          }else{
            $sts = "<h2>".$sRow['capaian_output']."%</h2>";
          }

          if($sRow['approve_pengawas'] == 'p'){
              $app = 'Menunggu approve pengawas';
          }else{
              $app = '';
          }
           $output .= "<div class='col-12 mb-2 bg-light p-3  detail' data-id='".$sRow['id_add']."'>
                    <div class='row justify-content-center'>
                        <div class='col-1'><i class='ri-arrow-right-s-line'></i></div>
                        <div class='col-8 '><h6 class='text-dark mb-0'>".$sRow['uraian']." </h6><small>".$app."</small></div>
                        <div class='col-2 '>".$sts."</div>
                    </div>
                 </div>";
          
          
          
         
        }else{
           $output .= "<div class='col-12 mb-2 bg-light p-3  detail' data-id='".$sRow['id_add']."' >
                    <div class='row justify-content-center'>
                        <div class='col-1'><i class='ri-arrow-right-s-line'></i></div>
                        <div class='col-8 '><h6 class='text-dark'>".$sRow['kode_rekening'].". ".$sRow['uraian']."</h6></div>
                        <div class='col-2 '></div>
                    </div>
                 </div>";
        }
         $child = $this->model_app->view_where_ordering('alokasi_dana_desa',array('id_sd'=>$id_sd,'id_tahap'=>$tahap,'id_parent'=>$row['id_add'],'id_sub_parent'=>$sRow['id_add']),'kode_rekening','ASC');
         foreach($child->result_array() as $cRow){
         
            if($cRow['status'] == 'y'){
                $stsC = '<h2 class="text-success"><i class="ri-check-double-line text-success"></i></h2>';
            }else{
              $stsC = "<h2>".$cRow['capaian_output']."%</h2>";
            }

            if($cRow['approve_pengawas'] == 'p'){
                $appC = 'Menunggu approve pengawas';
            }else{
                $appC = '';
            }
              $output .= "<div class='col-12 mb-2 bg-light p-3  detail' data-id='".$cRow['id_add']."'>
                    <div class='row justify-content-center'>
                    <div class='col-1'></div>
                        <div class='col-1'><i class='ri-arrow-right-s-line '></i></div>
                        <div class='col-7 '><h6 class='text-dark mb-0'>".$cRow['kode_rekening']." ".$cRow['uraian']." </h6><small>".$appC."</small></div>
                        <div class='col-2 '>".$stsC."</div>
                    </div>
                 </div>";
       }
      
    }
    }
    echo $output;
  }
     function dataTahap1(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $output = "";
    $year = $this->db->query("SELECT * FROM tahap_add WHERE id_sd = '".$id_sd."' GROUP BY tahun ORDER BY tahun DESC  ");
    if($year->num_rows() > 0 ){
        foreach($year->result_array() as $thn){
          $output.= "<div class='col-12 '><h3 class='text-left' style='color:#960001'>".$thn['tahun']."</h3></div>";
          $data = $this->model_app->view_where_ordering('tahap_add',array('tahun'=>$thn['tahun'],'id_sd'=>$id_sd),'tahap','ASC');
          $output .= "<div class='col-12 mb-2 '><div class='row '>";
          foreach($data->result_array() as $row){

            $output .= "<div class='col-12 bg-light my-1 tahap' data-id='".$row['id_tahap']."'>
                          <h5 class='p-2'>TAHAP ".$row['tahap']." ( ".strtoupper(terbilang1($row['tahap']))." )</h5>
                       </div>";
          }
          $output .= "</div></div>";
        }
    }else{
      $output = "<div class='col-12 py-3'><h5>Tidak ada alokasi dana desa</h5></div>";
    }

    echo $output;
  }
    function appAlokasiDanaDesa(){
        $id = $this->input->post('id_add');
        $data = array('uraian_output'=>$this->input->post('uraian_output'),'uraian'=>$this->input->post('uraian'),'volume_output'=>$this->input->post('volume_output'),'cara_pengadaan'=>$this->input->post('cara_pengadaan'),'anggaran'=>str_replace('.','',$this->input->post('anggaran')),'kegiatan'=>$this->input->post('kegiatan'),'approve_pengawas'=>'y');
        $where = array('id_add'=>$id);
        $this->model_app->update('alokasi_dana_desa',$data,$where);
        echo base_url('pengawas/detailAlokasiDanaDesa?id=').$id;
    }
    function cancelAlokasiDanaDesa(){
        $id= $this->input->post('id');
        $this->model_app->delete('alokasi_dana_desa',array('id_add'=>$id));
        echo base_url('pengawas/approveADD');

    }
    function alokasiDanaDesa(){
        $data['title'] = 'Alokasi Dana Desa - '.title();
        $data['back'] = base_url('pengawas');
        $data['menu'] = 'Alokasi Dana Desa';
        $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_all_tahap',$data);

    }
   function inputReport(){
     cek_session_pengawas();
          $data['title'] = "APLIKASI E-LAPKER";
          $jabatan = $this->session->jabatan;
          $data['jabatan'] = $jabatan;
          

          if($jabatan == 'admin'){
            if(isset($_POST['submit'])){
              
              $data['sub_bagian'] = $this->input->post('sub');
              $data['bagian'] =$this->input->post('bagian');
              if($data['sub_bagian'] =='all' AND $data['bagian'] =='all')
              {
                $data['peg'] = $this->model_app->view('pegawai');
              }
              elseif($data['sub_bagian'] == 'all'){
                $data['bagian'] = $this->input->post('bagian');
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian']));
              
              }else{
                $data['bagian'] = $this->input->post('bagian');
                $data['sub_bagian'] = $this->input->post('sub');
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian']));
              }
            }else
            {
              $data['bagian'] = 'all';
              $data['sub_bagian'] = 'all';
              $data['peg'] = $this->model_app->view('pegawai');
            }
          }else{
            //kepala bagian
            if($this->session->sub_bagian == 0){
              if(isset($_POST['submit'])){
                $data['sub_bagian'] = $this->input->post('sub');
                $data['bagian'] = $this->session->bagian;
              if($data['sub_bagian'] =='all')
              {
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian']));
              }
              else{
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian']));
              }
              }else{
                $data['bagian'] = $this->session->bagian;
                $data['sub_bagian'] = 'all';
                $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian']));
              }
              


            }
            // kepala sub bagian
            else{
              $data['bagian'] = $this->session->bagian;
              $data['sub_bagian'] = $this->session->sub_bagian;
              $data['peg'] = $this->model_app->view_where('pegawai',array('bagian'=>$data['bagian'],'sub_bagian'=>$data['sub_bagian']));
            }
          }
          $data['menu'] = 'TAMBAH REPORT';
          $data['back'] = base_url('pengawas/report');
           $this->template->load(base_theme().'/template-pengawasback',base_theme().'/pengawas/view_report_input',$data);
  }
  function do_report()
  {
    $judul = $this->input->post('judul_report');
    $tgl = $this->input->post('date');
    $start = $this->input->post('start');
    //$end = $this->input->post('end');
    $keterangan = $this->input->post('report');

    $date = date('Y-m-d',strtotime($tgl));
    $start = date('H:i:s',strtotime($start));
  
    $id = $this->input->post('id_pegawai');

     $data = [];
      $count = count($_FILES['files']['name']);
    
      for($i=0;$i<$count;$i++){
    
        if(!empty($_FILES['files']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
  
          $config['upload_path'] =  './asset/foto_report/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '20000';
          $config['encrypt_name'] = TRUE;
          $config['file_name'] = $_FILES['files']['name'][$i];
   
          $this->load->library('upload',$config); 
          $this->upload->do_upload('file');
        
          $data['totalFiles'][] = $images;
          $uploadData = $this->upload->data();
          $images[] = $uploadData['file_name'];
          }

   
      }
         $fileName = implode(';',$images);
            $foto = str_replace(' ','_',$fileName);
           
    
          if(trim($foto)!=''){
    
    $data = array('id_pegawai'=>$id,'judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'date'=>$date,'jam_kerja'=>'0','foto_masuk'=>$foto);
    $this->db->insert('report',$data);
    $this->session->set_flashdata('success','Report berhasil diinput!');
    redirect('pengawas/report');
    }else{
          $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('pengawas/report');
    }


   }
    function updatereport()
   {
      $judul = $this->input->post('judul_report');
    $tgl = $this->input->post('date');
    $start = $this->input->post('start');
    $end = $this->input->post('end');
    $keterangan = $this->input->post('report');
    $id = $this->input->post('id');

    $date = date('Y-m-d',strtotime($tgl));
    $start = date('H:i:s',strtotime($start));

  
  $end = date('H:i:s',strtotime($end));
       $s = new DateTime($start);
    $e = new DateTime($end);
    $interval = $s->diff($e);
    $hrs = $interval->d * 24 + $interval->h;
    $sel =  $hrs.".".$interval->format('%i'); 

     $data = [];
      $count = count($_FILES['files']['name']);
    
      for($i=0;$i<$count;$i++){
    
        if(!empty($_FILES['files']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
  
          $config['upload_path'] =  './asset/foto_report/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '20000';
          $config['encrypt_name'] = TRUE;
          $config['file_name'] = $_FILES['files']['name'][$i];
   
          $this->load->library('upload',$config); 
          $this->upload->do_upload('file');
        
          $data['totalFiles'][] = $images;
          $uploadData = $this->upload->data();
          $images[] = $uploadData['file_name'];
          }

   
      }
         $fileName = implode(';',$images);
            $foto = str_replace(' ','_',$fileName);
           
    
          if(trim($foto)!=''){
            $id_peg  = $this->input->post('id_pegawai');
            $tanggal = date('Y-m-d');
            $pe = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$date,'id_pegawai'=>$id_peg));
            if($pe->num_rows() > 0){
                $p = $pe->row_array();
              if($p['poin'] <= 1 ){
                
             
              $poin_now = $p['poin'];

              $poin = $poin_now+2;
            }else{
              $poin_now = $p['poin'];
              $poin = $poin_now+1;
            }

              $dp = array('poin'=>$poin);
              $wp = array('tanggal'=>$date,'id_pegawai'=>$id_peg);
             $this->model_app->update('poin_pegawai',$dp,$wp);
          }else{
            $datp = array('id_pegawai'=>$id_peg,'tanggal'=>$date,'poin'=>'2');
            $this->model_app->insert('poin_pegawai',$datp);
          }

           
           

            $data = array('judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'end'=>$end,'date'=>$date,'foto_keluar'=>$foto,'jam_kerja'=>$sel,'finish'=>'y');
            $where = array('id_report'=>$id);
             $this->model_app->update('report',$data,$where);
            $this->session->set_flashdata('success','Report berhasil diubah!');

            redirect('pengawas/report');
        

            
          }
          else{
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('pengawas/report');
             
          }
   }
   function detailreport(){
     $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('report',array('id_report'=>$id))->row_array();
    if($cek['finish'] == 'y')
    {
      $data['access'] ='n';
    }
    else{
      $data['access']='y';
    }
   $data['title'] = "APLIKASI E-LAPKER";
    $data['row'] = $cek;
    $this->load->view('pegawai/pengawas/view_report_detail',$data);

   }
  function fetch_report()
{
  $output = "";
 
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $bagian = $this->input->post('bagian');
  $sub = $this->input->post('sub');
  $cabang = $this->cabang;
  $data = $this->model_app->data_report_pen($bagian,$sub,$limit,$start,$cabang);
  

  if($data->num_rows() > 0){

      foreach($data->result_array() as $row){
              $cetak = substr($row['report'], 0, 100);
              if($row['finish']=='y'){
              $output .="  
               <div class='border border-secondary row p-2 text-center m-2' onClick='detailReport1(".$row['id_report'].")' style='width:100% !important'>
                 <div class='col-12'><h6>". strtoupper($row['judul_report'])."</h6></div>
                 <div class='col-12'><label>".$cetak."</label></div>
                 <div class='col-12 text-right'><label><b>".$row['nama_lengkap']."</b></label></div>
               </div>
          
                     

         
            ";
            }else{
              $output .="  
               <div class='border border-warning row p-2 text-center m-2' onClick='detailReport(".$row['id_report'].")'  style='width:100% !important'>
                 <div class='col-12'><h6>". strtoupper($row['judul_report'])."</h6></div>
                 <div class='col-12'><label>".$cetak."</label></div>
                   <div class='col-12 text-right'><label><b>".$row['nama_lengkap']."</b></label></div>
               </div>
          
                     

         
            ";
            }
            
      

  }
  }
  echo $output;
}
  function add_lembur(){
    $id_pegawai = $this->input->post('id_pegawai');
    $id_pengawas = $this->session->id_pengawas;
    $keterangan = $this->input->post('keterangan');
    $date = date('Y-m-d');
    //$data = array('id_pegawai'=>$id_pegawai,'id_pengawas'=>$id_pengawas,'keterangan'=>$keterangan,'date'=>$date);
  

    $data = array();
    foreach($id_pegawai as $peg => $row){
      $pegawai = explode('-',$row);
      $no_hp = $pegawai[1];
      $id = $pegawai[0];
      $sub = $pegawai[2];
      $nama = $pegawaip[3];
      $data = array('id_pegawai'=>$id,'id_pengawas'=>$id_pengawas,'keterangan'=>$keterangan,'date'=>$date);
       $this->model_app->insert('lembur',$data);

    $sub_bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE b.id_sub_bagian = $sub")->row_array();
     $nohp = $no_hp;
     $nohp = str_replace(" ","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace("(","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace(")","",$nohp);
     // kadang ada penulisan no hp 0811.239.345
     $nohp = str_replace(".","",$nohp);
 
     // cek apakah no hp mengandung karakter + dan 0-9
     if(!preg_match('/[^+0-9]/',trim($nohp))){
         // cek apakah no hp karakter 1-3 adalah +62
         if(substr(trim($nohp), 0, 3)=='62'){
             $hp = trim($nohp);
         }
         // cek apakah no hp karakter 1 adalah 0
         elseif(substr(trim($nohp), 0, 1)=='0'){
             $hp = '62'.substr(trim($nohp), 1);
         }
     }
     
     $pesan = "<h3>SURAT KERJA </h3><br>

Kepada : ".$nama."<br> 
Tanggal : ".format_indo($date)." <br>
Bagian : ".$sub_bag['nama_bagian']." 
Sub Bagian : ".$sub_bag['nama_sub_bagian']."<br><br>


Untuk : 
".$keterangan;
   
    $this->kirimWablas($hp,$pesan);
    } 

//    
   
    $this->session->set_flashdata('success','Data Surat Kerja Berhasil Ditambah');
  
    redirect('pengawas/pegawai');

  }
  function kirimWablas($phone,$msg)
{

        $link  =  "https://sambi.wablas.com//api/send-message";
        $data = [
        'phone' => $phone,
        'message' => $msg,
        ];
         
         
        $curl = curl_init();
        $token =  "04MQHjv6dy5mBRGgJf2eEIBzF6gXKF5Oz31wcvQF4YmfOe3ea8tBCGvCF1gNI5xO";
 
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl); 
        return $result;
}
  function fetch_lembur(){
    $output1 = "";
  
    $limit = $this->input->post('limit1');
    $start = $this->input->post('start1');
    $id = $this->session->id_pengawas;
    $data = $this->db->query("SELECT * FROM lembur a JOIN pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_pengawas = $id  ORDER BY id_lembur DESC LIMIT $start,$limit");
    if($data->num_rows() > 0){

            foreach($data->result_array() as $row){
              
               $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE id_sub_bagian = $row[sub_bagian]")->row_array();

                $output1 .="  
                <div class='border border row p-2 text-center m-2' onClick='detailLembur(".$row['id_lembur'].")' style='width:100% !important'>
              <div  class='col-12 text-left'><h6 >".format_indo($row['date'])."</h6></div>
                <div  class='col-12 text-left'><h6>".strtoupper($row['nama_lengkap'])."</h6></div>
              <div  class='col-12 text-left'><label class='' >".$bag['nama_bagian']." - ".$bag['nama_sub_bagian']."</label>
              </div>
             <div  class='col-12 text-left'><label class='' ><a href='".base_url('pengawas/downloadlembur/').sha1($row['id_lembur']).'/'.$row['id_lembur']."' class='text-info'>Download</a></label>
              </div>
             
             
              </div>
            
                ";
            
            }

    }
    echo $output1;
  }
  function downloadlembur(){
      $id = $this->uri->segment('4');
      $data['row'] = $this->db->query("SELECT * FROM lembur a JOIN pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_lembur = $id")->row_array();
      // $this->load->view('pegawai/pengawas/view_download_lembur',$data);

       $this->load->helper('dompdf');
            $html = $this->load->view('pegawai/pengawas/view_download_lembur',$data,true);
        
 
    //load content html
              
             
                // create pdf using dompdf
                $filename = 'SURAT TUGAS SEKDA';
                $paper = 'A4';
                $orientation = 'potrait';
                pdf_create($html, $filename, $paper, $orientation);
  }
  function fetch_form(){
      $limit = $this->input->post('limit');
      $start = $this->input->post('start');
      $sub_bagian = $this->input->post('sub_bagian');
      $bagian = $this->input->post('bagian');

     if($sub_bagian == 'all' AND $bagian == 'all'){
              $where = "";
            }elseif($sub_bagian == 'all'){
              $where = "WHERE b.bagian=".$bagian;
            }
            else{
              $where = "WHERE b.bagian=".$bagian." AND sub_bagian=".$sub_bagian;
            }

          $data = $this->db->query("SELECT *, b.status as status_pegawai, a.status as status FROM form_izin a JOIN pegawai b ON a.id_pegawai = b.id_pegawai $where ORDER BY id_form DESC  LIMIT $start,$limit ");

    $output = "";
    
  

    if($data->num_rows() > 0){

            foreach($data->result_array() as $row){
                      
               $tgl1 = strtotime($row['dari']); 
                $tgl2 = strtotime($row['sampai']); 

                $jarak = $tgl2 - $tgl1;

                $hari = $jarak / 60 / 60 / 24+1;
                 $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE id_sub_bagian = $row[sub_bagian]")->row_array();

              
              if($row['approved'] == 'tidak'){
                 $output .="  
              <div class='border border-danger row p-2 text-center m-2' onClick='detailFormPeng(".$row['id_form'].")' style='width:100% !important'>
              <div  class='col-12 text-left'><h6 >".strtoupper($row['status'])."</h6></div>
                <div  class='col-12 text-left'><h6>".strtoupper($row['nama_lengkap'])."</h6></div>
                  <div  class='col-12 text-left'><label class='' >".$bag['nama_bagian']." - ".$bag['nama_sub_bagian']."</label></div>
              <div  class='col-12 text-left'><label class='' >".strtoupper(format_indo_w($row['dari']))." -  ".strtoupper(format_indo_w($row['sampai']))." (". $hari. " hari)</label>
              </div>
              <div  class='col-12 text-left'><label>".$row['keterangan']." </label></div>

              <div  class='col-12 text-right'><label>Ditolak</label></div>
             
             
              </div>
              
            
            ";
              }
              elseif($row['approved']=='proses'){
              $output .="  
              <div class='border border-warning row p-2 text-center m-2' onClick='detailFormPeng(".$row['id_form'].")' style='width:100% !important'>
              <div  class='col-12 text-left'><h6 >".strtoupper($row['status'])."</h6></div>
                <div  class='col-12 text-left'><h6>".strtoupper($row['nama_lengkap'])."</h6></div>
                  <div  class='col-12 text-left'><label class='' >".$bag['nama_bagian']." - ".$bag['nama_sub_bagian']."</label></div>
              <div  class='col-12 text-left'><label class='' >".strtoupper(format_indo_w($row['dari']))." -  ".strtoupper(format_indo_w($row['sampai']))." (". $hari. " hari)</label>
              </div>
              <div  class='col-12 text-left'><label>".$row['keterangan']." </label></div>
             <div  class='col-12 text-right'><label>Proses</label></div>
              </div>
              
            
            ";
            }else{
                $output .="  
             <div class='border border-success row p-2 text-center m-2' onClick='detailFormPeng(".$row['id_form'].")' style='width:100% !important'>
              <div  class='col-12 text-left'><h6 >".strtoupper($row['status'])."</h6></div>
                <div  class='col-12 text-left'><h6>".strtoupper($row['nama_lengkap'])."</h6></div>
                  <div  class='col-12 text-left'><label class='' >".$bag['nama_bagian']." - ".$bag['nama_sub_bagian']."</label></div>
              <div  class='col-12 text-left'><label class='' >".strtoupper(format_indo_w($row['dari']))." -  ".strtoupper(format_indo_w($row['sampai']))." (". $hari. " hari)</label>
              </div>
              <div  class='col-12 text-left'><label>".$row['keterangan']." </label></div>
             <div  class='col-12 text-right'><label>Disetujui</label></div>
              </div>
              
            
            ";
            }
            
            

    }
    }
    echo $output;
  }
  function detailform(){
    $id = $this->uri->segment('3');
     
    $data['row'] = $this->db->query("SELECT *, b.status as status_pegawai, a.status as status FROM form_izin a JOIN pegawai b ON a.id_pegawai = b.id_pegawai WHERE id_form = $id ")->row_array();
      $data['title'] = "APLIKASI E-LAPKER";
      $data['judul'] = "Detail Form";
      $this->load->view('pegawai/pengawas/view_form_detail',$data);

  }


  function approv(){
     $id = $this->uri->segment('4');
     $status = $this->uri->segment('3');
     $id_peg = $this->uri->segment('5');
     $where = array('id_form'=>$id);
     $data = array('approved'=>$status);
     $this->model_app->update('form_izin',$data,$where);

    if($status == 'tidak'){
      $sts = "Ditolak";
    }else{
      $sts = "Disetujui";
    }
    $row = $this->model_app->view_where('form_izin',array('id_form'=>$id))->row_array();
       $tgl1 = strtotime($row['dari']); 
    $tgl2 = strtotime($row['sampai']); 

    $jarak = $tgl2 - $tgl1;

      $hari = $jarak / 60 / 60 / 24+1;
    $peg = $this->model_app->view_where('pegawai',array('id_pegawai'=>$id_peg))->row_array();
    $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$peg['bagian']))->row_array();
    $sub_bag = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$peg['sub_bagian']))->row_array();
  

             $nohp = $peg['no_hp'];
     $nohp = str_replace(" ","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace("(","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace(")","",$nohp);
     // kadang ada penulisan no hp 0811.239.345
     $nohp = str_replace(".","",$nohp);
 
     // cek apakah no hp mengandung karakter + dan 0-9
     if(!preg_match('/[^+0-9]/',trim($nohp))){
         // cek apakah no hp karakter 1-3 adalah +62
         if(substr(trim($nohp), 0, 3)=='62'){
             $hp = trim($nohp);
         }
         // cek apakah no hp karakter 1 adalah 0
         elseif(substr(trim($nohp), 0, 1)=='0'){
             $hp = '62'.substr(trim($nohp), 1);
         }
     }
     
     $pesan = "<h3>FORMULIR IZIN/SAKIT </h3><br>

Nama : ".$peg['nama_lengkap']."<br> 
No KTP : ".$peg['no_ktp']." <br>
Bagian : ".$bag['nama_bagian']." 
Sub Bagian : ".$sub_bag['nama_sub_bagian']."<br><br>
Tugas Pokok : ".$peg['tugas_pokok']."

Mengajukan ".ucfirst($row['status'])." Dengan Alasan : 
".$row['keterangan']."

Selama : ".$hari." Hari
Dari : ".format_indo($row['dari'])."
Sampai : ".format_indo($row['sampai'])."



Telah ".$sts."

";
   
   $this->kirimWablas($hp,$pesan);
     $this->session->set_flashdata('success','Form Berhasil diproses');
     redirect('pengawas/pegawai');
  }
    function login()
    {
        if(isset($_POST['login']))
        {
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();

            $username = strip_tags($this->input->post('a'));
                $password = hash("sha512", md5(strip_tags($this->input->post('b'))));
                $cek = $this->db->query("SELECT * FROM pengawas where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
                $row = $cek->row_array();
                $total = $cek->num_rows();
                if ($total > 0){
                  if($row['id_sd'] == $cabang['id_sd']){
                    $this->session->set_userdata(array('id_pengawas'=>$row['id_pengawas'],'level'=>'pengawas','jabatan'=>$row['jabatan'],'bagian'=>$row['bagian'],'sub_bagian'=>$row['sub_bagian'],'nama_lengkap'=>$row['nama_lengkap'],'username'=>$row['username']));
        
                
                    $referred_from = $this->session->userdata('referred_from');
                    redirect('pengawas/');
                  }else{
                     $data['title'] = "APLIKASI E-LAPKER";
                    $this->session->set_flashdata('message', 'Maaf, Akun ini tidak terdaftar pada kelurahan/desa ini!');
                    $this->load->view('pegawai/view_login_pengawas',$data);
                  }
                    
                
                
                }else{
                    $data['title'] = "APLIKASI E-LAPKER";
                    $this->session->set_flashdata('message', 'Maaf, Username atau password salah!');
                    $this->load->view('pegawai/view_login_pengawas',$data);

                    
                }
        }else{
            $data['title'] = "APLIKASI E-LAPKER";
            $this->load->view('pegawai/view_login_pengawas',$data);
        }
    }
    function getBagian(){
    $id_sd = $this->input->post('id_sd');
    $output = "<option value='all'>Semua</option>";
    $data = $this->model_app->view_where_ordering('bagian',array('id_sd'=>$id_sd),'id_bagian','ASC');
    foreach($data->result_array() as $row){
        $output  .= "<option value='".$row['id_bagian']."'>".$row['nama_bagian']."</option>";
    }
    echo $output;
  }
    function peringkat(){
          cek_session_pengawas();
          $data['title'] = "APLIKASI E-LAPKER";
          $jabatan = $this->session->jabatan;
          $data['jabatan'] = $jabatan;
           $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           $data['id_sd']= $cabang['id_sd'];
            if($cabang['status']  != 'kelurahan'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
            $data['status'] = $cabang['status'];
            $data['kelurahan'] = $cabang['kelurahan'];
            $data['kabupaten'] = $cabang['kabupaten'];
            $data['kecamatan'] = $cabang['kecamatan'];

          if($jabatan == 'admin'){
            if(isset($_POST['submit'])){
              $data['cabang'] = $this->input->post('cabang');
              $data['bulan'] = $this->input->post('bulan');
              
              $data['sub_bagian'] = $this->input->post('sub');
              $data['bagian'] =$this->input->post('bagian');
              
            }else
            {
                if($cabang['status'] == 'kelurahan'){
                    $data['cabang'] = $cabang['id_sd'];
                }else{
                    $data['cabang'] = 'all';
                }
                $data['bagian'] = 'all';
                $data['sub_bagian'] = 'all';
                $data['bulan'] = date('m');
            }
          }else{
            //kepala bagian
            if($this->session->sub_bagian == 0){
              if(isset($_POST['submit'])){
                 $data['bulan'] = $this->input->post('bulan');
                $data['sub_bagian'] = $this->input->post('sub');
                $data['bagian'] = $this->session->bagian;
              $data['cabang'] = $this->input->post('cabang');

             
              }else{
                $data['bagian'] = $this->session->bagian;
                $data['sub_bagian'] = 'all';
                 $data['bulan'] = date('m');
                  if($cabang['status'] == 'kelurahan'){
                    $data['cabang'] = $cabang['id_sd'];
                    }else{
                        $data['cabang'] = 'all';
                    }
              
              }
              


            }
            // kepala sub bagian
            else{
              if(isset($_POST['submit'])){
                 $data['bulan'] = $this->input->post('bulan');
                $data['cabang'] = $this->input->post('cabang');
               }else{
                 $data['bulan'] = date('m');
                  if($cabang['status'] == 'kelurahan'){
                    $data['cabang'] = $cabang['id_sd'];
                    }else{
                        $data['cabang'] = 'all';
                    }

               }
              $data['bagian'] = $this->session->bagian;
              $data['sub_bagian'] = $this->session->sub_bagian;
             
            }
          }
          $this->load->view('pegawai/pengawas/view_peringkat',$data);
    }
    function fetch_peringkat()
{
  $output = "";
  // $data['m'] =  date('Y-m-d');
  // $month = date('m',strtotime($data['m']));
  $month = $this->input->post('bulan');
  $sub = $this->input->post('sub');
  $bagian = $this->input->post('bagian');
  
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $cabang = $this->cabang;
  if($cabang == 'all'){
    if($sub =='all' AND $bagian =='all')
              {
                  $data = $this->model_app->get_rank_all($month,$start,$limit);
              }
              elseif($sub == 'all'){
               
                $data = $this->model_app->get_rank_bag($month,$bagian,$start,$limit);
              
              }else{
                 $data = $this->model_app->get_rank_bag_sub($month,$bagian,$sub,$start,$limit);
              }
  }else{
    if($sub =='all' AND $bagian =='all')
              {
                  $data = $this->model_app->get_rank_all_c($month,$start,$limit,$cabang);
              }
              elseif($sub == 'all'){
               
                $data = $this->model_app->get_rank_bag_c($month,$bagian,$start,$limit,$cabang);
              
              }else{
                 $data = $this->model_app->get_rank_bag_sub_C($month,$bagian,$sub,$start,$limit,$cabang);
              }
  }
            


  
  if($data->num_rows() > 0){
      $rank = 1;
      foreach($data->result_array() as $row){
        $rank = $row['rank'] ;
         $foto = $row['foto_profile'];
         if (!file_exists("asset/foto_user/$foto") OR $foto==''){
          $pp = base_url('asset/foto_user/blank.png');
         }else{
          $pp = base_url('asset/foto_user/').$foto;
         }
       $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE b.id_sub_bagian = $row[sub_bagian]")->row_array();
              $output .="  
              <div class='col-1' onclick=detailKinerja(".$row['id_pegawai'].")><h3 class='mt-2'>".$rank."</h3></div>
            <div class='col-2 mr-1' onclick=detailKinerja(".$row['id_pegawai'].")><img src='".$pp."' class='rounded-circle' alt='Cinque Terre' style='width: 50px;height: 50px;'></div>
            <div></div>
            <div class='col-7' onclick=detailKinerja(".$row['id_pegawai'].")><h6>". ucfirst($row['nama_lengkap'])."</h6><label style='font-size:12px;'>".$bag['nama_sub_bagian']."</label></div>
            <div class='col-1 text-left'><h6 class='mt-2' onclick=detailKinerja(".$row['id_pegawai'].")>". round($row['tot_poin'],2) ."</h6></div>
            <div class='col-12' onclick=detailKinerja(".$row['id_pegawai'].")><hr style='border-top: 1px solid #960001;'></div>
              
            ";
          $rank+= $rank;
      }

  }
  echo $output;
}
function detailKinerja(){
   cek_session_pengawas();
   $data['title'] = "DETAIL KINERJA";
  $id = $this->uri->segment('3');
        $now = date('Y-m-d');
      $start = date('Y-m-01');
      $d = date('j');
      $m = date('m');
      $y = date('Y');

      $data['bulan'] = bulan($m);
      $data['month'] = $m;
      $cek = $this->db->query("SELECT * FROM harikerja  WHERE tanggal <= '$d' AND bulan = '$m' AND tahun = '$y' AND status = 'kerja'");
      $bolos = 0;
      $telat = 0;
      $pulang =0;
      $kerja =0;
      $tot_poin = 0;
      foreach ($cek->result_array() as $row) {
        $tgl = $row['tanggal'];
        $bln = $row['bulan'];
        $thn = $row['tahun'];
        $all = $thn.'-'.$bln.'-'.$tgl;
        $date = date('Y-m-d',strtotime($all));
      
        
        $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $id");
        $absen = $abs->row_array();
        if($abs->num_rows() > 0){
          $bolos += 0;
          $kerja +=1;
        }else{
          $bolos += 1;
          $kerja+=0;
        }

        if($absen['telat']=='y'){
          $telat +=1;
        }else{
          $telat +=0;
        }
        if($absen['pulang_awal']=='y'){
          $pulang +=1;
        }else{
          $pulang +=0;
        }

        $pp = $this->db->query("SELECT * FROM poin_pegawai WHERE id_pegawai = $id AND tanggal = '$date' "  )->row_array();
        $poin += $pp['poin'];


        
        
      }
      

      $data['alpha']=$bolos;
      $data['telat'] = $telat;
      $data['pulang'] = $pulang;
      $data['harikerja'] = $cek->num_rows();
      $data['kerja'] = $kerja;

      $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);


      if($persentase >= 100 AND $persentase <= 90 ){
        $data['status'] = "Sangat Baik";
      }elseif($persentase>= 89 AND $persentase<= 89){
        $data['status'] = "Baik";
      }elseif($persentase>= 70 AND $persentase<= 79){
        $data['status'] = "Cukup";
      }elseif($persentase>= 60 AND $persentase<= 69){
        $data['status'] = "Kurang";
      }elseif($persentase>= 0 AND $persentase<= 59){
        $data['status'] = "Sangat Kurang";
      }
      $per = ceil(($poin / (10 * $data['harikerja']) ) * 100); 


      $data['kinerja'] = $per;
      
      $data['persentase'] = $persentase;
      $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$m' AND MONTH(sampai) = $m ");
      $selisih = 0;
      $selisih_i = 0;
      foreach($form->result_array() as $frm){
        $dari = date('Ymd',strtotime($frm['dari']));
        $sampai = date('Ymd',strtotime($frm['sampai']));
        if($frm['status']=='Sakit'){
        if($sampai == $dari){
          $sel = 1;
        }else{
          $sel = ($sampai - $dari)+1;
        }
        $selisih = $selisih + $sel;
        }else{
            if($sampai == $dari){
              $sel = 1;
            }else{
              $sel = ($sampai - $dari)+1;
            }
            $selisih_i = $selisih_i + $sel;
        }
      }
      $data['sakit'] = $selisih;
      $data['izin'] = $selisih_i;

      $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE MONTH(date)=$m AND id_pegawai = $id")->row_array();

      $data['jumlah_kerja'] = $rep['tot'];
      $data['lama_kerja'] = $rep['tot_jam'];


      $data['row'] = $this->db->query("SELECT * FROM pegawai  WHERE id_pegawai = $id")->row_array();
      
        
      $this->load->view('pegawai/pengawas/view_kinerja',$data);
    
 
    //load content html
        
       
        
}
    function logout(){
        
        $this->session->sess_destroy();
        redirect('pengawas/login');
    }


function fetch_kk()
{
  $output = "";

  $sub = $this->input->post('sub_bagian');
  $bagian = $this->input->post('bagian');
  
  $limit = $this->input->post('limit2');
  $start = $this->input->post('start2');
  $filter = $this->input->post('filter');
  $hari = date('Y-m-d');
  $bulan = date('m');
  $tahun = date('Y');

            if($sub =='all' AND $bagian =='all')
              {
                  $where = "";
              }
              elseif($sub == 'all'){
               
                $where = "AND a.bagian = ".$bag;
              
              }else{
                 $where = "AND a.bagian = ".$bag."  AND b.sub_bagian =".$sub;
              }


              

              $data = $this->db->query("SELECT * FROM pegawai a JOIN kartukeluarga b ON a.id_pegawai = b.created_by WHERE a.aktif = 'y' $where  LIMIT $start,$limit");



  
  if($data->num_rows() > 0){
   
      foreach($data->result_array() as $row){
      
            $prov = $this->model_app->view_where('provinsi',array('id_prov'=>$row['provinsi']))->row_array();
            $kab =$this->model_app->view_where('kabupaten',array('id_kab'=>$row['kabupaten']))->row_array();
            $kec = $this->model_app->view_where('kecamatan',array('id_kec'=>$row['kecamatan']))->row_array();
            $kel = $this->model_app->view_where('kelurahan',array('id_kel'=>$row['kelurahan']))->row_array();
              $output .="  
                <div class='col-11 p-3 m-3 border border-secondary' onClick=detailKK('".$row['no_kk']."')>
                <div class='row'>
                  <div class='col-4 form-group'>
                    <label class='resposivelabel'>No KTP</label>
                    <h6 class='responsivetext'>".$row['no_ktp']."</h6>
                  </div>
                  <div class='col-8 form-group'>
                    <label class='resposivelabel'>Nama Kepala Keluarga</label>
                    <h6 class='responsivetext'>".$row['nama_kepala_keluarga']."</h6>
                  </div>
                  <div class='col-12 form-group'>
                     <label class='resposivelabel'>Alamat</label>
                     <h6 class='responsivetext'>".strtoupper($row['alamat'].' /'.$row['kode_pos'].' RT/RW'.$row['rt'].'/'.$row['rw'].'  <br>   '.$prov['nama'].'/'.$kab['nama'].'/'.$kec['nama'].'/'.$kel['nama'])."</h6>
                  </div>
                  <div class='col-12 text-right'>
                    <label class='resposivelabel'>by ".$row['nama_lengkap']."</label>
                  </div>
                </div>
              </div>
            ";
     
      }

  }
  echo $output;
}
function detailkk(){
   $no_kk = $this->uri->segment(3);
  $row = $this->model_app->view_where('kartukeluarga',array('no_kk'=>$no_kk));
  if($row->num_rows() == 0 OR $no_kk == "" OR $no_kk == NULL){
    $this->session->set_flashdata('message','Data KK Tidak Ditemukan');
    redirect('pengawas/');
  }else{
    $data['row'] = $row->row_array();
    $data['anggota'] = $this->model_app->view_where('anggota_keluarga',array('no_kk'=>$no_kk));
     $data['title'] = "APLIKASI E-LAPKER";
     $data['menu'] = "Detail Kartu Keluarga";
     $data['judul'] = "Kartu Keluarga";
    
     
    

     $data['pekerjaan'] = $this->model_app->view_ordering('jenis_pekerjaan','nama','ASC');
     $this->template->load(base_theme().'/template-pengawas',base_theme().'/pengawas/view_detailkk',$data);
  }
}
function detail_anggotakeluarga()
{
  $nik = $this->uri->segment(3);
  $no_kk = $this->uri->segment(4);
  $row = $this->model_app->view_where('anggota_keluarga',array('no_kk'=>$no_kk,'nik'=>$nik));
  if($row->num_rows() == 0 OR $no_kk == "" OR $no_kk == NULL OR $nik == "" OR $nik == NULL){
    $this->session->set_flashdata('message','Data Anggota Keluarga Tidak Ditemukan');
    redirect('pengawas');
  }else{
     $data['rows'] = $row->row_array();
     $data['row'] = $this->model_app->view_where('kartukeluarga',array('no_kk'=>$no_kk))->row_array();
     $data['title'] = "APLIKASI E-LAPKER";
     $data['menu'] = "Detail Anggota Keluarga";
     $data['judul'] = "Anggota Keluarga";
    
   
    

     $data['pekerjaan'] = $this->model_app->view_ordering('jenis_pekerjaan','nama','ASC');
     $this->template->load(base_theme().'/template-pengawas',base_theme().'/pengawas/view_detailanggotakeluarga',$data);
  }
}
  
}