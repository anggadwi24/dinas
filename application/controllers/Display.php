<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Display extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
         $this->key = "aplikasidatakepegawaianENCRYPTION30224923912";
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
         $this->cabang = $cabang['id_sd'];
         if($cabang['status'] != 'sekolah'){
           exit();
         }
       
    }

    function index(){
	 	
	 
		$data['title'] = 'APLIKASI KELURAHAN DARMA';
	
		$this->template->load('user/template','user/content',$data);
	}
  function seeSiswa(){
    $output = null;
    
   
    $data = $this->db->query("SELECT * FROM siswa WHERE id_sd =".$this->cabang." ORDER BY kelas ASC ");
    foreach($data->result_array() as $row){
      $output .= "<div class='col-12  mb-2'>
      <div class='row'>
          <div class='col-4'>
          <img src='".$row['foto']."' class='img-fluid rounded-circle' style='width:80px;height:80px' alt=>
             
          </div>
          <div class='col-8 mt-1'>
              <h6 class='text-left mb-0'>".ucfirst($row['nama_lengkap'])."</h6>
              <span class='text-left' style='font-size:12px;font-weight:300'>NISN ".strtoupper($row['nisn'])."</span>

              <span class='text-left d-block' style='font-size:12px;font-weight:300'>Kelas ".strtoupper($row['kelas'])."</span>
             
          </div>
      </div>
 </div>";
    }
    echo $output;
  }
  function searchSiswa(){
    $key = $this->input->post('key');
    $data = $this->db->query("SELECT * FROM siswa WHERE active = 'y' AND  id_sd =".$this->cabang." AND ( nama_lengkap LIKE '%".$key."%'  OR nisn LIKE '%".$key."%')  " );
    if($data->num_rows() ){
      foreach($data->result_array() as $row){
        $output .= "<div class='col-12  mb-2'>
        <div class='row'>
            <div class='col-4'>
            <img src='".$row['foto']."' class='img-fluid rounded-circle' style='width:80px;height:80px' alt=>
               
            </div>
            <div class='col-8 mt-1'>
                <h6 class='text-left mb-0'>".ucfirst($row['nama_lengkap'])."</h6>
                <span class='text-left' style='font-size:12px;font-weight:300'>NISN ".strtoupper($row['nisn'])."</span>

                <span class='text-left' style='font-size:12px;font-weight:300'>Kelas ".strtoupper($row['kelas'])."</span>
               
            </div>
        </div>
   </div>";
      }
      echo $output;
    }
  }
  function siswa(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $data['title'] = "Siswa - ".$cabang['nama_cabang'];
    $data['judul'] = 'DATA Siswa ';
    $data['cabang'] = $cabang;

    $this->template->load('user/template2','user/view_siswa',$data);
  }
  function seeTeacher(){
    $output = null;
    $kepsek = $this->model_app->view_where('kepala_sekolah',array('kepsek_id_sd'=>$this->cabang));
    if($kepsek->num_rows() > 0){
      $kRow = $kepsek->row_array();
      $output .= " <div class='col-12 mb-3'>
                    <div class='row'>
                        <div class='col-12'>
                        <center><img src='".base_url('asset/upload_sklh/blank.png')."' class='img-fluid rounded-circle' style='width:80px;height:80px' alt=></center>
                          
                        </div>
                        <div class='col-12 mt-1'>
                            <h5 class='text-center mb-0'>".ucfirst($kRow['kepsek_name'])."</h5>
                            <h5 class='text-center mb-0'>".$kRow['kepsek_email']."</h5>

                            <h6 class='text-center' style='font-size:12px;'>Kepala Sekolah</h6>
                        </div>
                    </div>
              </div>";
    }

    $output .= "<div class='col-12'><hr></div>";
    $data = $this->db->query("SELECT * FROM guru WHERE status = 'active' AND id_sd = ".$this->cabang." ORDER BY id_guru DESC");
    foreach($data->result_array() as $row){
      $output .= "<div class='col-12  mb-2'>
      <div class='row'>
          <div class='col-4'>
          <img src='".$row['foto']."' class='img-fluid rounded-circle' style='width:80px;height:80px' alt=>
             
          </div>
          <div class='col-8 mt-1'>
              <h6 class='text-left mb-0'>".ucfirst($row['nama_guru'])."</h6>

              <h6 class='text-left mb-0'>".$row['email']."</h6>
              <span class='text-left' style='font-size:12px;font-weight:300'>".strtoupper($row['jenis_ptk'])."</span>
              <span class='text-left d-block' style='font-size:12px;font-weight:300'>".$row['hp']."</span>
          </div>
      </div>
 </div>";
    }
    echo $output;
  }
  function searchTeacher(){
    $key = $this->input->post('key');
    $data = $this->db->query("SELECT * FROM guru WHERE status = 'active' AND id_sd = ".$this->cabang."  AND nama_guru LIKE '%".$key."%' OR jenis_ptk LIKE '%".$key."%' " );
    if($data->num_rows() ){
      foreach($data->result_array() as $row){
        $output .= "<div class='col-12  mb-2'>
        <div class='row'>
            <div class='col-4'>
            <img src='".$row['foto']."' class='img-fluid rounded-circle' style='width:80px;height:80px' alt=>
               
            </div>
            <div class='col-8 mt-1'>
                <h6 class='text-left mb-0'>".ucfirst($row['nama_guru'])."</h6>
                 <h6 class='text-left mb-0'>".$row['email']."</h6>

                <span class='text-left d-block' style='font-size:12px;font-weight:300'>".strtoupper($row['jenis_ptk'])."</span>
                <span class='text-left d-block' style='font-size:12px;font-weight:300'>".$row['hp']."</span>
            </div>
        </div>
   </div>";
      }
      echo $output;
    }
  }
  function guru(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $data['title'] = "Guru - ".$cabang['nama_cabang'];
    $data['judul'] = 'DATA GURU ';
    $data['cabang'] = $cabang;

    $this->template->load('user/template2','user/view_guru',$data);
  }
  function profile(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $data['judul'] = "Profile ".$cabang['nama_cabang'];
    $data['title'] = 'Profile '.$cabang['nama_cabang'];
    $data['cabang'] = $cabang;

    $this->template->load('user/template1','user/view_profile_desa',$data);
  }
   function wisata(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $data['judul'] = "Wisata ".$cabang['nama_cabang'];
    $data['title'] = 'Wisata '.$cabang['nama_cabang'];
    $data['cabang'] = $cabang;

    $this->template->load('user/template1','user/view_wisata',$data);
  }
  function hasilbumi(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $data['judul'] = "Hasil Bumi ".$cabang['nama_cabang'];
    $data['title'] = 'Hasil Bumi '.$cabang['nama_cabang'];
    $data['cabang'] = $cabang;

    $this->template->load('user/template1','user/view_hasil_bumi',$data);
  }
  function luaswilayah(){
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $data['judul'] = "Luas Wilayah ".$cabang['nama_cabang'];
    $data['title'] = 'Luas Wilayah '.$cabang['nama_cabang'];
    $data['cabang'] = $cabang;

    $this->template->load('user/template1','user/view_luas',$data);
  }
   function tutorial()
    {
         $data['title'] = "Tutorial ";
        
         $this->template->load('user/template1','user/view_tutorial_sep',$data);
    }
    function detail(){
     $id = trim($this->uri->segment('3'));
     $cek = $this->model_app->view_where('tutorial',array('id_tutorial'=>$id));
     if($cek->num_rows() > 0){
          $this->db->where('id_tutorial', $id);
          $this->db->set('view', 'view+1', FALSE);
          $this->db->update('tutorial');
          $data['row'] = $cek->row_array();
          $data['title'] = "Detail Tutorial - Seraphina";
          $this->template->load('user/template1','user/view_tutorial_detail',$data);


     }else{
          $this->session->set_flashdata('message','Tutorial Tidak Ditemukan');
          redirect('tutorial');
     }
    }
    function dataTutorial(){
          $limit = $this->input->post('limit');
          $start = $this->input->post('start');
          $output = "";
             $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $data = $this->db->query("SELECT * FROM tutorial WHERE status = 'y' AND id_sd ='".$cabang['id_sd']."' ORDER BY id_tutorial DESC LIMIT $start,$limit");
          if($data->num_rows() > 0){
               foreach($data->result_array() as $row){
                   
                         $adm = $this->model_app->view_where('users',array('username'=>$row['created_by']))->row_array();
                         $nama = $adm['nama_lengkap'];
                         $pp = $adm['foto'];
                  

                         if (!file_exists("asset/foto_user/$pp") OR $pp==''){
                             $foto = "blank.png";
                          }else{
                            $foto = $pp;
                          }

                    $output .= "<div class='col-12 mb-2 embed-responsive embed-responsive-9by16' onClick='detailVid(".$row['id_tutorial'].")' >
                                     <video
                                                                 onplay='stopOtherMedia(this)'
                                                                id='my-video'
                                                                class='embed-responsive-item'
                                                                controls
                                                                preload='auto'
                                                                width='800'
                                                                height='auto'
                                                               poster='".base_url('asset/images/unl.jpg')."'
                                                                data-setup='{}'
                                                              >
                                                                <source src='". base_url('asset/tutorial/').$row['file']."' type='video/mp4' />
                                                                   
                                                              </video>
                                </div>
                                <div class='col-2'  onClick='detailVid(".$row['id_tutorial'].")'><img src='".base_url('asset/foto_user/').$foto."' class='lazyload rounded-circle' style='width:50px;height:50px'></div>
                                <div class='col-10'  onClick='detailVid(".$row['id_tutorial'].")'><h6 class='text-dark'>".$row['judul']."</h6> <label class='text-muted' style='font-size:13px;'>".ucfirst($nama)." · ".$row['view']." Views · ".time_elapsed_string($row['created_at'])."</label></div> 
                                <div class='col-12 mb-4'></div>
                                ";

               }
          }else{
               $output = "";
          }
          echo $output;
    }
  function pelayanan(){
   
        
   
         $data['title'] = 'PELAYANAN - '.title();
        $data['judul'] = 'PELAYANAN';
        $data['pelayanan'] = $this->model_app->view_ordering('pelayanan','pelayanan','ASC');
        $this->template->load('user/template','user/pelayanan/view_pelayanan',$data); 
   
     
    
      

  }
  function keterangan_usaha(){
    $this->load->view('user/pelayanan/view_keterangan_usaha');
  }
  function add_keterangan_usaha(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }
    $datau = array('nik'=>$nik,'nama_usaha'=>$this->input->post('nama_usaha'),'jenis_usaha'=>$this->input->post('jenis_usaha'),'alamat_usaha'=>$this->input->post('alamat_usaha'),'tanggal_berdiri'=>date('Y-m-d',strtotime($this->input->post('tanggal_berdiri'))),'status'=>'aktif','keperluan'=>$this->input->post('keperluan'));
    $this->model_app->insert('usaha',$datau);
    redirect('home');
  }
   function add_keterangan_usaha_dom(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }
     if($this->input->post('id_usaha') == NULL){


    $datau = array('nik'=>$nik,'nama_usaha'=>$this->input->post('nama_usaha'),'jenis_usaha'=>$this->input->post('jenis_usaha'),'alamat_usaha'=>$this->input->post('alamat_usaha'),'tanggal_berdiri'=>date('Y-m-d',strtotime($this->input->post('tanggal_berdiri'))),'status'=>'aktif','keperluan'=>$this->input->post('keperluan'));
     $id_usaha = $this->model_app->insert_id('usaha',$datau);

     $dataut = array('id_usaha'=>$id,'keperluan'=>$this->input->post('keperluan'));
     $this->model_app->insert('usaha_dom',$dataut);
    }else{
      $id = $this->input->post('id_usaha');
       $dataut = array('id_usaha'=>$id,'keperluan'=>$this->input->post('keperluan'));
     $this->model_app->insert('usaha_dom',$dataut);

     
    }
    redirect('home');
  }
  function add_keterangan_usaha_tidak(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }
    if($this->input->post('id_usaha') == NULL){


    $datau = array('nik'=>$nik,'nama_usaha'=>$this->input->post('nama_usaha'),'jenis_usaha'=>$this->input->post('jenis_usaha'),'alamat_usaha'=>$this->input->post('alamat_usaha'),'tanggal_berdiri'=>date('Y-m-d',strtotime($this->input->post('tanggal_berdiri'))),'status'=>'aktif','keperluan'=>$this->input->post('keperluan'));
     $id_usaha = $this->model_app->insert_id('usaha',$datau);

     $dataut = array('id_usaha'=>$id_usaha,'tanggal_berhenti'=>date('Y-m-d',strtotime($this->input->post('tanggal_berdiri'))));
     $this->model_app->insert('usaha_tidak',$dataut);
    }else{
      $id = $this->input->post('id_usaha');
      $this->model_app->update('usaha',array('status'=>'tidak'),array('id_usaha'=>$id));
       $dataut = array('id_usaha'=>$id,'tanggal_berhenti'=>date('Y-m-d',strtotime($this->input->post('tanggal_berdiri'))));
     $this->model_app->insert('usaha_tidak',$dataut);

     
    }
    redirect('home');
  }
  function izin_nikah(){
     $this->load->view('user/pelayanan/view_izin_nikah');
  }
  function add_izin_nikah(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'status_perkawinan'=>$this->input->post('status'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }

      $nik_c = $this->input->post('nik_c');
      $cek_c = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_c));
      if($cek_c->num_rows() > 0) {
        $nik_c = $nik_c;
      }else{
        $data_c = array('nik'=>$this->input->post('nik_c'),'nama_lengkap'=>$this->input->post('nama_c'),'jenis_kelamin'=>$this->input->post('jeniskelamin_c'),'tempat_lahir'=>$this->input->post('tempatlahir_c'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_c'))),'agama'=>$this->input->post('agama_c'),'pekerjaan'=>$this->input->post('pekerjaan_c'),'alamat'=>$this->input->post('alamat_c'),'status_perkawinan'=>$this->input->post('status_c'));

        $this->model_app->insert('anggota_keluarga_temp',$data_c);
        $nik_c = $nik_c.'_temp';
      }

      $nik_ayah = $this->input->post('nik_ayah');
      $cek_ayah = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_ayah));
      if($cek_ayah->num_rows() > 0) {
        $nik_ayah = $nik_ayah;
      }else{
        $data_ayah = array('nik'=>$this->input->post('nik_ayah'),'nama_lengkap'=>$this->input->post('nama_ayah'),'jenis_kelamin'=>$this->input->post('jeniskelamin_ayah'),'tempat_lahir'=>$this->input->post('tempatlahir_ayah'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_ayah'))),'agama'=>$this->input->post('agama_ayah'),'pekerjaan'=>$this->input->post('pekerjaan_ayah'),'alamat'=>$this->input->post('alamat_ayah'),'status_perkawinan'=>$this->input->post('status_ayah'));

        $this->model_app->insert('anggota_keluarga_temp',$data_ayah);
        $nik_ayah = $nik_ayah.'_temp';
      }

      $nik_ibu = $this->input->post('nik_ibu');
      $cek_ibu = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_ibu));
      if($cek_ibu->num_rows() > 0) {
        $nik_ibu = $nik_ibu;
      }else{
        $data_ibu = array('nik'=>$this->input->post('nik_ibu'),'nama_lengkap'=>$this->input->post('nama_ibu'),'jenis_kelamin'=>$this->input->post('jeniskelamin_ibu'),'tempat_lahir'=>$this->input->post('tempatlahir_ibu'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_ibu'))),'agama'=>$this->input->post('agama_ibu'),'pekerjaan'=>$this->input->post('pekerjaan_ibu'),'alamat'=>$this->input->post('alamat_ibu'),'status_perkawinan'=>$this->input->post('status_ibu'));

        $this->model_app->insert('anggota_keluarga_temp',$data_ibu);
        $nik_ibu = $nik_ibu.'_temp';
      }

      if($this->input->post('statusTTD') == 'suami'){
        $suami = $nik;
      }else{
        $istri = $nik;
      }

      if($this->input->post('statusTo') == 'suami'){
        $suami = $nik_c;
      }else{
        $istri = $nik_c;
      }

      $datain = array('yang_mengajukan'=>$nik,'suami'=>$suami ,'istri'=>$istri,'waktu_nikah'=>date('Y-m-d H:i:s',strtotime($this->input->post('waktu_nikah'))),'tempat_nikah'=>$this->input->post('tempat_nikah'));
      $id_in = $this->model_app->insert_id('izin_nikah',$datain);
      $izin = $this->input->post('izin');
      if($izin == 'wali'){
         $nik_wali = $this->input->post('nik_wali');
          $cek_wali = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_wali));
          if($cek_wali->num_rows() > 0) {
            $nik_wali = $nik_wali;
          }else{
            $data_wali = array('nik'=>$this->input->post('nik_wali'),'nama_lengkap'=>$this->input->post('nama_wali'),'jenis_kelamin'=>$this->input->post('jeniskelamin_wali'),'tempat_lahir'=>$this->input->post('tempatlahir_wali'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_wali'))),'agama'=>$this->input->post('agama_wali'),'pekerjaan'=>$this->input->post('pekerjaan_wali'),'alamat'=>$this->input->post('alamat_wali'),'status_perkawinan'=>$this->input->post('status_wali'));

            $this->model_app->insert('anggota_keluarga_temp',$data_wali);
            $nik_wali = $nik_wali.'_temp';
          }
      }else{
        $nik_wali = NULL;
      }

      $dataio = array('id_in'=>$id_in,'ayah'=>$nik_ayah,'ibu'=>$nik_ibu,'wali'=>$nik_wali,'menantu'=>$nik_c,'izin'=>$izin);
      $this->model_app->insert('izin_orangtua',$dataio);
      redirect('home');

  }

  function belum_menikah(){
     $this->load->view('user/pelayanan/view_belum_menikah');
  }
   function add_belum_menikah(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }
    $datau = array('nik'=>$nik,'keperluan'=>$this->input->post('keperluan'));
    $this->model_app->insert('belum_menikah',$datau);
    redirect('home');
  }
  function izin_mertua(){
     $this->load->view('user/pelayanan/view_izin_mertua');
  }
  function add_izin_mertua(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }
    $nik1 = $this->input->post('nik1');
    $cek1 = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik1));
    if($cek1->num_rows() > 0) {
      $nik1 = $nik1;
    }else{
      $data1 = array('nik'=>$this->input->post('nik1'),'nama_lengkap'=>$this->input->post('nama1'),'jenis_kelamin'=>$this->input->post('jeniskelamin1'),'tempat_lahir'=>$this->input->post('tempatlahir1'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir1'))),'agama'=>$this->input->post('agama1'),'pekerjaan'=>$this->input->post('pekerjaan1'),'alamat'=>$this->input->post('alamat1'));

      $this->model_app->insert('anggota_keluarga_temp',$data1);
      $nik = $nik.'_temp';
    }
    $datau = array('mertua'=>$nik,'menantu'=>$nik1);
    $this->model_app->insert('izin_mertua',$datau);
    redirect('home');
  }
  function wali_pernikahan(){
     $this->load->view('user/pelayanan/view_wali_pernikahan');
  }
   function add_wali_pernikahan(){
    $nik = $this->input->post('nik');
    $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
    if($cek->num_rows() > 0) {
      $nik = $nik;
    }else{
      $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

      $this->model_app->insert('anggota_keluarga_temp',$data);
      $nik = $nik.'_temp';
    }
    $nik1 = $this->input->post('nik1');
    $cek1 = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik1));
    if($cek1->num_rows() > 0) {
      $nik1 = $nik1;
    }else{
      $data1 = array('nik'=>$this->input->post('nik1'),'nama_lengkap'=>$this->input->post('nama1'),'jenis_kelamin'=>$this->input->post('jeniskelamin1'),'tempat_lahir'=>$this->input->post('tempatlahir1'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir1'))),'agama'=>$this->input->post('agama1'),'pekerjaan'=>$this->input->post('pekerjaan1'),'alamat'=>$this->input->post('alamat1'));

      $this->model_app->insert('anggota_keluarga_temp',$data1);
      $nik = $nik.'_temp';
    }
    $datau = array('mempelai'=>$nik,'wali'=>$nik1,'hubungan'=>$this->input->post('hubungan'));
    $this->model_app->insert('izin_wali',$datau);
    redirect('home');
  }
  function surat_kelahiran(){
    $this->load->view('user/pelayanan/view_surat_kelahiran');
  }
  function add_surat_kelahiran(){
      $nik_ayah = $this->input->post('nik_ayah');
      $cek_ayah = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_ayah));
      if($cek_ayah->num_rows() > 0) {
        $nik_ayah = $nik_ayah;
      }else{
        $data_ayah = array('nik'=>$this->input->post('nik_ayah'),'nama_lengkap'=>$this->input->post('nama_ayah'),'jenis_kelamin'=>$this->input->post('jeniskelamin_ayah'),'tempat_lahir'=>$this->input->post('tempatlahir_ayah'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_ayah'))),'agama'=>$this->input->post('agama_ayah'),'pekerjaan'=>$this->input->post('pekerjaan_ayah'),'alamat'=>$this->input->post('alamat_ayah'),'status_perkawinan'=>$this->input->post('status_ayah'));

        $this->model_app->insert('anggota_keluarga_temp',$data_ayah);
        $nik_ayah = $nik_ayah.'_temp';
      }

      $nik_ibu = $this->input->post('nik_ibu');
      $cek_ibu = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_ibu));
      if($cek_ibu->num_rows() > 0) {
        $nik_ibu = $nik_ibu;
      }else{
        $data_ibu = array('nik'=>$this->input->post('nik_ibu'),'nama_lengkap'=>$this->input->post('nama_ibu'),'jenis_kelamin'=>$this->input->post('jeniskelamin_ibu'),'tempat_lahir'=>$this->input->post('tempatlahir_ibu'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_ibu'))),'agama'=>$this->input->post('agama_ibu'),'pekerjaan'=>$this->input->post('pekerjaan_ibu'),'alamat'=>$this->input->post('alamat_ibu'),'status_perkawinan'=>$this->input->post('status_ibu'));

        $this->model_app->insert('anggota_keluarga_temp',$data_ibu);
        $nik_ibu = $nik_ibu.'_temp';
      }

      $datas = array('ayah'=>$nik_ayah,'ibu'=>$nik_ibu,'tanggal'=>date('Y-m-d',strtotime($this->input->post('tanggal'))),'nama'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jk'),'anak'=>$this->input->post('anak'),'alamat'=>$this->input->post('alamat'));
      $this->model_app->insert('surat_kelahiran',$datas);
      redirect('home');
  }
  function surat_kematian(){
    $this->load->view('user/pelayanan/view_surat_kematian');
  }
  function add_surat_kematian(){
      $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
        $nik_ibu = $this->input->post('nik_ibu');
        $cek_ibu = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik_ibu));
        if($cek_ibu->num_rows() > 0) {
          $nik_ibu = $nik_ibu;
        }else{
          $data_ibu = array('nik'=>$this->input->post('nik_ibu'),'nama_lengkap'=>$this->input->post('nama_ibu'),'jenis_kelamin'=>$this->input->post('jeniskelamin_ibu'),'tempat_lahir'=>$this->input->post('tempatlahir_ibu'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir_ibu'))),'agama'=>$this->input->post('agama_ibu'),'pekerjaan'=>$this->input->post('pekerjaan_ibu'),'alamat'=>$this->input->post('alamat_ibu'),'status_perkawinan'=>$this->input->post('status_ibu'));

          $this->model_app->insert('anggota_keluarga_temp',$data_ibu);
          $nik_ibu = $nik_ibu.'_temp';
        }

        $dataa = array('nik'=>$nik,'tanggal'=>date('Y-m-d',strtotime($this->input->post('tanggal'))),'di'=>$this->input->post('di'),'karena'=>$this->input->post('karena'),'pelapor'=>$nik_ibu,'hubungan'=>$this->input->post('hubungan'));
        $this->model_app->insert('surat_kematian',$dataa);
        redirect('home');
  }
  function domisili_usaha(){
    $this->load->view('user/pelayanan/view_keterangan_dom_usaha');
  }
  function usaha_tidakberjalan(){
    $this->load->view('user/pelayanan/view_keterangan_usaha_tidak');
  }
  function surat_pindah_penduduk()
  {
    $data['provinsi'] = $this->model_app->view_ordering('provinsi','nama','ASC');
    $this->load->view('user/pelayanan/view_surat_pindah_penduduk',$data);
  }
  function add_surat_pindah_penduduk(){
     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'provinsi'=>$this->input->post('provinsi'),'kabupaten'=>$this->input->post('kabupaten'),'kecamatan'=>$this->input->post('kecamatan'),'kelurahan'=>$this->input->post('kelurahan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'id_parent'=>0,'tanggal'=>$this->input->post('tanggal'),'alasan'=>$this->input->post('alasan'),'alamat_pindah'=>$this->input->post('alamat_pindah'),'provinsi_pindah'=>$this->input->post('provinsi_pindah'),'kabupaten_pindah'=>$this->input->post('kabupaten_pindah'),'kecamatan_pindah'=>$this->input->post('kabupaten_pindah'),'kelurahan_pindah'=>$this->input->post('kelurahan_pindah'));
      $id_sp = $this->model_app->insert_id('surat_pindah',$datas);

      if($this->input->post('punya') == 'y'){
        redirect('home/surat_pindah_penduduk_child/'.$id_sp);
      }else{
         redirect('home');
      }
  }
   function surat_pindah_penduduk_child()
  {
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('surat_pindah',array('id_sp'=>$id));
    if($cek->num_rows() > 0){
        $data['title'] = 'PELAYANAN - '.title();
        $data['judul'] = 'TAMBAH ANGGOTA KELUARGA - PINDAH PENDUDUk';
      $row = $cek->row_array();

      $data['row'] = $row;
      $n = $row['nik'];
      $nik = explode("_", $n);
      if(isset($nik[1])){

        $data['parent'] = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
      }else{
        
        $data['parent'] = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
      }
     

      $data['loc'] =   $this->db->query("SELECT *,a.nama as nama_prov, b.nama as nama_kab, c.nama as nama_kec, d.nama as nama_kel FROM provinsi a JOIN kabupaten b ON a.id_prov = b.id_prov JOIN kecamatan c ON b.id_kab = c.id_kab JOIN kelurahan d ON c.id_kec = d.id_kec WHERE d.id_kel = ".$row['kelurahan_pindah']."")->row_array();
       $this->template->load('user/template','user/pelayanan/view_surat_pindah_penduduk_child',$data); 
    }else{
      $this->session->set_flashdata('message','Data not found!');
      redirect('home');
    }
    
  }
   function add_child_pindah_penduduk(){
   
      $id = $this->input->post('id_sp');
      $nik = $this->input->post('nik');
      $nama = $this->input->post('nama');
      $jk = $this->input->post('jeniskelamin');
      $tmp = $this->input->post('tempatlahir');
      $tgl_lahir = $this->input->post('tanggallahir');
      $agama = $this->input->post('agama');
      $peker = $this->input->post('pekerjaan');
      $alamat = $this->input->post('alamat');
      $sts = $this->input->post('status');
      $hub = $this->input->post('status_hubungan');
      $prov = $this->input->post('provinsi');
      $kab = $this->input->post('kabupaten');
      $kec = $this->input->post('kecamatan');
      $kel = $this->input->post('kelurahan');
      $alamat = $this->input->post('alamat');
      $tgl = $this->input->post('tanggal');
      $prov_pindah = $this->input->post('provinsi_pindah');
      $kab_pindah = $this->input->post('kabupaten_pindah');
      $kec_pindah =  $this->input->post('kecamatan_pindah');
      $kel_pindah = $this->input->post('kelurahan_pindah');
      $alasan = $this->input->post('alasan');
      $alamat_pindah = $this->input->post('alamat_pindah');
      $insert = array();
          

            for($i = 0; $i < count($nik); $i++)
            {
               $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik[$i]));
                if($cek->num_rows() > 0) {
                  $nik[$i] = $nik[$i];
                }else{
                  $data = array('nik'=>$nik[$i],'nama_lengkap'=>$nama[$i],'jenis_kelamin'=>$jk[$i],'tempat_lahir'=>$tmp[$i],'tanggal_lahir'=>$tgl_lahir[$i],'agama'=>$agama[$i],'pekerjaan'=>$peker[$i],'status_perkawinan'=>$sts[$i],'status_hubungan'=>$hub[$i],'alamat'=>$alamat,'provinsi'=>$prov,'kabupaten'=>$kab,'kecamatan'=>$kec,'kelurahan'=>$kel);

                  $this->model_app->insert('anggota_keluarga_temp',$data);
                  $nik[$i] = $nik[$i].'_temp';
                }
             
                $insert[] = array(
                    'id_parent' => $id,
                    'nik' => $nik[$i],
                    'tanggal'=>$tgl,
                    'alasan'=>$alasan,
                    'alamat_pindah'=>$alamat_pindah,
                    'kelurahan_pindah'=>$kel_pindah,
                    'kecamatan_pindah'=>$kec_pindah,
                    'kabupaten_pindah'=>$kab_pindah,
                    'provinsi_pindah'=>$prov_pindah,
                    
                    
                );
                // echo $this->input->post('expired_at')[$i];
               // echo $expired[$i];
              
            
                
            }

            $this->db->insert_batch('surat_pindah', $insert);
           redirect('home');
           
  }
  function keberatan_warga(){
    $this->load->view('user/pelayanan/view_keberatan_warga');
  }
  function add_keberatan_warga()
  {
      $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'pengajuan'=>$this->input->post('pengajuan'),'alasan'=>$this->input->post('alasan'));
      $this->model_app->insert('keberatan_warga',$datas);
      redirect('home');
  }
  function bepergian()
  {
     $data['provinsi'] = $this->model_app->view_ordering('provinsi','nama','ASC');
    $this->load->view('user/pelayanan/view_bepergian',$data);
  }
  function add_bepergian()
  {
      $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
         $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'provinsi'=>$this->input->post('provinsi'),'kabupaten'=>$this->input->post('kabupaten'),'kecamatan'=>$this->input->post('kecamatan'),'kelurahan'=>$this->input->post('kelurahan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'tujuan'=>$this->input->post('tujuan'),'maksud'=>$this->input->post('maksud'));
      $this->model_app->insert('bepergian',$datas);
      redirect('home');
  }
  function kehilangan()
  {
     $this->load->view('user/pelayanan/view_kehilangan');
  }
  function add_kehilangan()
  {
      $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
         $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'provinsi'=>$this->input->post('provinsi'),'kabupaten'=>$this->input->post('kabupaten'),'kecamatan'=>$this->input->post('kecamatan'),'kelurahan'=>$this->input->post('kelurahan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'kehilangan'=>$this->input->post('kehilangan'),'maksud'=>$this->input->post('maksud'));
      $this->model_app->insert('kehilangan',$datas);
      redirect('home');
  }
  function pindah_belajar(){
    $this->load->view('user/pelayanan/view_pindah_belajar');
  }
  function add_pindah_belajar(){
     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
         $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'status_perkawinan'=>$this->input->post('status'),'status_hubungan'=>'anak');

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $ortu = $this->input->post('nik');
      $cek_ortu = $this->model_app->view_where('anggota_keluarga',array('nik'=>$ortu));
      if($cek_ortu->num_rows() > 0) {
        $ortu = $ortu;
      }else{
         
      $data1 = array('nik'=>$this->input->post('nik1'),'nama_lengkap'=>$this->input->post('nama1'),'jenis_kelamin'=>$this->input->post('jeniskelamin1'),'tempat_lahir'=>$this->input->post('tempatlahir1'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir1'))),'agama'=>$this->input->post('agama1'),'pekerjaan'=>$this->input->post('pekerjaan1'),'alamat'=>$this->input->post('alamat1'),'status_hubungan'=>$this->input->post('status_hubungan'));


        $this->model_app->insert('anggota_keluarga_temp',$data1);
        $ortu = $ortu.'_temp';
      }
      $datas = array('nik'=>$nik,'selama'=>$this->input->post('selama'),'orang_tua'=>$ortu,'pindah_belajar'=>$this->input->post('pindah_belajar'));
      $this->model_app->insert('pindah_belajar',$datas);
      redirect('home');
  }
  function jampersal()
  {
    $this->load->view('user/pelayanan/view_jampersal');
  }
  function add_jampersal(){
     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'untuk'=>$this->input->post('untuk'));
      $this->model_app->insert('jampersal',$datas);
      redirect('home');
  }
   function bpjs()
  {
    $this->load->view('user/pelayanan/view_bpjs');
  }
  function add_child_bpjs(){
   
      $id = $this->input->post('id_bpjs');
      $nik = $this->input->post('nik');
      $nama = $this->input->post('nama');
      $jk = $this->input->post('jeniskelamin');
      $tmp = $this->input->post('tempatlahir');
      $tgl = $this->input->post('tanggallahir');
      $agama = $this->input->post('agama');
      $peker = $this->input->post('pekerjaan');
      $alamat = $this->input->post('alamat');
      $sts = $this->input->post('status');
      $hub = $this->input->post('status_hubungan');
      $insert = array();
          

            for($i = 0; $i < count($nik); $i++)
            {
               $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik[$i]));
                if($cek->num_rows() > 0) {
                  $nik[$i] = $nik[$i];
                }else{
                  $data = array('nik'=>$nik[$i],'nama_lengkap'=>$nama[$i],'jenis_kelamin'=>$jk[$i],'tempat_lahir'=>$tmp[$i],'tanggal_lahir'=>$tgl[$i],'agama'=>$agama[$i],'pekerjaan'=>$peker[$i],'alamat'=>$alamat[$i],'status_perkawinan'=>$sts[$i],'status_hubungan'=>$hub[$i]);

                  $this->model_app->insert('anggota_keluarga_temp',$data);
                  $nik[$i] = $nik[$i].'_temp';
                }
             
                $insert[] = array(
                  'id_parent' => $id,
                    'nik' => $nik[$i],
                    
                    
                );
                // echo $this->input->post('expired_at')[$i];
               // echo $expired[$i];
              
            
                
            }

            $this->db->insert_batch('bpjs', $insert);
           redirect('home');
           
  }
  function bpjs_child(){
        $data['title'] = 'PELAYANAN - '.title();
        $data['judul'] = 'TAMBAH ANGGOTA KELUARGA BPJS';
        $data['id_bpjs'] = $this->uri->segment('3');
        $data['bpjs'] = $this->model_app->view_where('bpjs',array('id_bpjs'=>$data['id_bpjs']))->row_array();
        $this->template->load('user/template','user/pelayanan/view_bpjs_child',$data); 

  }
   function add_bpjs(){
     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'status_hubungan'=>$this->input->post('status_hubungan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'id_parent'=>0);
      $id_bpjs = $this->model_app->insert_id('bpjs',$datas);
      if($this->input->post('punya') == 'y'){
        redirect('home/bpjs_child/'.$id_bpjs);
      }else{
         redirect('home');
      }
     
  
  }

  function ekonomi_lemah()
  {
     $this->load->view('user/pelayanan/view_ekonomi_lemah');
  }
  function add_ekonomi_lemah(){
     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'status_perkawinan'=>$this->input->post('status'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'untuk'=>$this->input->post('untuk'));
      $this->model_app->insert('ekonomi_lemah',$datas);
      redirect('home');
  }
  function keterangan_domisili()
  {
    $data['provinsi'] = $this->model_app->view_ordering('provinsi','nama','ASC');
    $this->load->view('user/pelayanan/view_keterangan_domisili',$data);
  }

  function add_keterengan_domisili(){
     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'provinsi'=>$this->input->post('provinsi'),'kabupaten'=>$this->input->post('kabupaten'),'kecamatan'=>$this->input->post('kecamatan'),'kelurahan'=>$this->input->post('kelurahan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik);
      $this->model_app->insert('keterangan_domisili',$datas);
      redirect('home');
  }
  function kelakuan_baik(){
     $this->load->view('user/pelayanan/view_kelakuan_baik');
  }
  function add_kelakuan_baik()
  {
      $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
          $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'status_perkawinan'=>$this->input->post('status'),'pendidikan'=>$this->input->post('pendidikan'));
        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'maksud'=>$this->input->post('maksud'));
      $this->model_app->insert('kelakuan_baik',$datas);
      redirect('home');
  }

  function penghasilan_ortu(){
    $this->load->view('user/pelayanan/view_penghasilan_ortu');
  }
  function add_penghasilan_ortu(){
    $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
          $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'status_perkawinan'=>$this->input->post('status'));
        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }

      $nik1 = $this->input->post('nik1');
      $cek1 = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik1));
      if($cek1->num_rows() > 0) {
        $nik1 = $nik1;
      }else{
          $data1 = array('nik'=>$this->input->post('nik1'),'nama_lengkap'=>$this->input->post('nama1'),'jenis_kelamin'=>'Laki-laki','tempat_lahir'=>'','tanggal_lahir'=>'0000-00-00','agama'=>'Islam','pekerjaan'=>'','alamat'=>'','status_perkawinan'=>'');
        $this->model_app->insert('anggota_keluarga_temp',$data1);
        $nik1 = $nik1.'_temp';
      }
      $datas = array('nik'=>$nik,'keperluan'=>$this->input->post('keperluan'),'penghasilan'=>$this->input->post('penghasilan'),'ortu_dari'=>$nik1);
      $this->model_app->insert('penghasilan_ortu',$datas);
      redirect('home');
  }
  function keterangan_terlantar(){
      $this->load->view('user/pelayanan/view_keterangan_terlantar');
  }
  function add_keterangan_terlantar(){
      $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
         $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $ortu = $this->input->post('nik');
      $cek_ortu = $this->model_app->view_where('anggota_keluarga',array('nik'=>$ortu));
      if($cek_ortu->num_rows() > 0) {
        $ortu = $ortu;
      }else{
         
      $data1 = array('nik'=>$this->input->post('nik1'),'nama_lengkap'=>$this->input->post('nama1'),'jenis_kelamin'=>$this->input->post('jeniskelamin1'),'tempat_lahir'=>$this->input->post('tempatlahir1'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir1'))),'agama'=>$this->input->post('agama1'),'pekerjaan'=>$this->input->post('pekerjaan1'),'alamat'=>$this->input->post('alamat1'));


        $this->model_app->insert('anggota_keluarga_temp',$data1);
        $ortu = $ortu.'_temp';
      }
      $datas = array('nik'=>$nik,'selama'=>$this->input->post('selama'),'ditumpangi'=>$ortu,'maksud'=>$this->input->post('maksud'));
      $this->model_app->insert('keterangan_terlantar',$datas);
      redirect('home');
  }
  function sub_pelayanan(){
    $id_pelayanan = $this->input->post('id_pelayanan');
    $row = $this->model_app->view_where_ordering('sub_pelayanan',array('id_pelayanan'=>$id_pelayanan),'sub_pelayanan','ASC');
    if($row->num_rows() > 0){
      $data['record'] = $row;
      $this->load->view('user/sub_pelayanan',$data);
    }else{
      $this->load->view('user/submit_pelayanan');
    }
  }
  function get_nik(){
    $nik = $this->input->post('nik');
    $data = $this->db->query("SELECT *,b.nama as nama_pekerjaan FROM anggota_keluarga a JOIN jenis_pekerjaan b ON a.jenis_pekerjaan = b.id_pekerjaan JOIN kartukeluarga c ON a.no_kk = c.no_kk WHERE a.nik = ".$nik." ")->result();
    
  
    echo json_encode($data);

  }
  function ajaxLoc()
  {
    $kel = $this->input->post('id_kel');
    $row = $this->db->query("SELECT *,a.nama as nama_prov, b.nama as nama_kab, c.nama as nama_kec, d.nama as nama_kel FROM provinsi a JOIN kabupaten b ON a.id_prov = b.id_prov JOIN kecamatan c ON b.id_kab = c.id_kab JOIN kelurahan d ON c.id_kec = d.id_kec WHERE d.id_kel = ".$kel."")->result();
    echo json_encode($row);
  }
  function detailUsaha(){
    $id = $this->input->post('id');
    $data = $this->model_app->view_where('usaha',array('id_usaha'=>$id))->result();
    echo json_encode($data);
  }
  function get_usaha(){
    $nik = $this->input->post('nik');
    $row = $this->db->query("SELECT * FROM usaha WHERE nik = ".$nik."");
    if($row->num_rows() > 0){
        $data = $row->result();
    }else{
        $data = 0;
    }
    echo json_encode($data);

  }
  function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->blog_model->search_blog($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->blog_title;
                echo json_encode($arr_result);
            }
        }
    }
  function musrenbang(){
    $data['title'] = 'MUSRENBANG - '.title();
        $data['judul'] = 'MUSRENBANG';
         if(isset($_POST['filter'])){
          $data['skpd'] = $this->input->post('skpd');
          $data['kecamatan'] = $this->input->post('kecamatan');
          $data['kelurahan'] = $this->input->post('kelurahan');
        }else{
          $data['skpd'] = 'all';
          $data['kecamatan'] ='all';
          $data['kelurahan'] ='all';
        }
        $data['skpdd'] = $this->model_app->view_where_ordering('skpd',array('status'=>'y'),'id_skpd','ASC');
        $data['kec'] = $this->model_app->view_where_ordering('kecamatan',array('id_kab'=>'7604'),'nama','ASC');
      
        $this->template->load('user/template','user/musrenbang/view_musrenbang',$data); 
  }
  function penerimaan_bpjs(){
    $data['provinsi'] = $this->model_app->view_ordering('provinsi','nama','ASC');
    $data['title'] = "PENERIMAAN BPJS YANG DIBAYARKAN - KELURAHAN DARMA";
    $data['judul'] =" PENERIMAAN BPJS YANG DIBAYARKAN";
    $this->template->load('user/template','user/kastem/view_penerimaan_bpjs',$data); 
  }
   function add_penerimaan_bpjs(){

     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'provinsi'=>$this->input->post('provinsi'),'kabupaten'=>$this->input->post('kabupaten'),'kecamatan'=>$this->input->post('kecamatan'),'kelurahan'=>$this->input->post('kelurahan'),'pendidikan'=>$this->input->post('pendidikan'),'status_perkawinan'=>$this->input->post('status_perkawinan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'no_bpjs'=>$this->input->post('no_bpjs'),'no_hp'=>$this->input->post('no_hp'));
      $this->model_app->insert('penerimaan_bpjs',$datas);
      $this->session->set_flashdata('success','Data berhasil diajukan');
      redirect('home/');
      
  
  }

  function data_kastem(){
    $data['provinsi'] = $this->model_app->view_ordering('provinsi','nama','ASC');
    $data['title'] = "DATA KASTEM, ANAK PUTUS SEKOLAH, DISABILITAS DAN LANSIA - KELURAHAN DARMA";
    $data['judul'] =" PENGAJUAN KASTEM, ANAK PUTUS SEKOLAH, DISABILITAS DAN LANSIA";
    $this->template->load('user/template','user/kastem/view_kastem',$data); 
  }



  function add_kastem(){

     $nik = $this->input->post('nik');
      $cek = $this->model_app->view_where('anggota_keluarga',array('nik'=>$nik));
      if($cek->num_rows() > 0) {
        $nik = $nik;
      }else{
        $data = array('nik'=>$this->input->post('nik'),'nama_lengkap'=>$this->input->post('nama'),'jenis_kelamin'=>$this->input->post('jeniskelamin'),'tempat_lahir'=>$this->input->post('tempatlahir'),'tanggal_lahir'=>date('Y-m-d',strtotime($this->input->post('tanggallahir'))),'agama'=>$this->input->post('agama'),'pekerjaan'=>$this->input->post('pekerjaan'),'alamat'=>$this->input->post('alamat'),'provinsi'=>$this->input->post('provinsi'),'kabupaten'=>$this->input->post('kabupaten'),'kecamatan'=>$this->input->post('kecamatan'),'kelurahan'=>$this->input->post('kelurahan'),'pendidikan'=>$this->input->post('pendidikan'),'status_perkawinan'=>$this->input->post('status_perkawinan'));

        $this->model_app->insert('anggota_keluarga_temp',$data);
        $nik = $nik.'_temp';
      }
      $datas = array('nik'=>$nik,'penyandang'=>$this->input->post('penyandang'),'catatan'=>$this->input->post('catatan'));
      $this->model_app->insert('kastem',$datas);
      $this->session->set_flashdata('success','Data berhasil diajukan');
      redirect('home/data_kastem');
      
  
  }

  function pengaduan(){
   
    $data['title'] = "PENGADUAN MASYARAKAT / PENYAMPAIAN ASPIRASI - KELURAHAN DARMA";
    $data['judul'] =" PENGADUAN MASYARAKAT / PENYAMPAIAN ASPIRASI";
    $this->template->load('user/template','user/pengaduan/view_pengaduan',$data); 
  }
  function add_pengaduan(){
    $config['upload_path']          = './asset/foto_pengaduan/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 10000;
    $config['encrypt_name'] = TRUE;
                
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('file')){
                
        $foto = "";
    }else{
        $fol = $this->upload->data();
        $foto = $fol['file_name'];
                       
    }

    $data = array('nik'=>$this->input->post('nik'),'pengaduan'=>$this->input->post('pengaduan'),'judul_laporan'=>$this->input->post('judul_laporan'),'isi_laporan'=>$this->input->post('isi_laporan'),'tanggal_laporan'=>$this->input->post('tanggal_laporan'),'foto_laporan'=>$foto);
    $this->model_app->insert('pengaduan_masyarakat',$data);
    $this->session->set_flashdata('success','Data berhasil diajukan');
    redirect('home');

  }
  
    function kelurahan(){

    $id_kec = $this->input->post('id_kec');
    $data['kelurahan'] = $this->model_app->view_where_ordering('kelurahan',array('id_kec' => $id_kec),'id_kel','DESC');
    $this->load->view('user/view_kelurahan',$data);    
  
  }
   function kecamatan(){

    $id_kab = $this->input->post('id_kab');
    $data['kecamatan'] = $this->model_app->view_where_ordering('kecamatan',array('id_kab' => $id_kab),'id_kec','DESC');
    $this->load->view('user/view_kecamatan',$data);    
  
  }
   function kabupaten(){

    $id_prov = $this->input->post('id_prov');
    $data['kabupaten'] = $this->model_app->view_where_ordering('kabupaten',array('id_prov' => $id_prov),'id_kab','DESC');
    $this->load->view('user/view_kabupaten',$data);    
  
  }
  function getMusrenbang(){
    $output = "";
    $skpd  = $this->input->post('skpd');
    $kecamatan = $this->input->post('kec');
    $kelurahan = $this->input->post('kel');
    $data= $this->model_app->data_musrenbang($skpd,$kecamatan,$kelurahan);

    if($data->num_rows() > 0){
        $output .= "<table class='table table-hovered'>
            <thead>
              <th width='5%'>No</th>
              <th width='45%'>SKPD</th>
              <th width='50%'>Kegiatan</th>
            </thead>
            <tfoot>
              <th width='5%'>No</th>
              <th width='45%'>SKPD</th>
              <th width='50%'>Kegiatan</th>
            </tfoot>
            <tbody>";
        $no =1;
        foreach ($data->result_array() as $row ) {
          $sk = $this->model_app->view_where('skpd',array('id_skpd'=>$row['kode_skpd']))->row_array();
          $output .= "<tr onclick='detailMusrenbang(".$row['id_musrenbang'].")'>
                <td>".$no."</td>
                <td>".$sk['skpd']." ( ".$sk['kode_skpd']." )</td>
                <td>".$row['kegiatan']."</td>
              </tr>";
         $no++;
        }
       
        $output .= "</tbody>
          </table>";
    }else{
      $output =  "Tidak Ada Data";
    }

    echo $output;
  }

  function detailMusrenbang(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('musrenbang',array('id_musrenbang'=>$id));
    if($cek->num_rows() > 0){
        $data['row'] = $cek->row_array();
        $data['judul'] = "DETAIL MUSRENBANG";
        $data['title'] = "Musrenbang - Kelurahan DARMA";
        $data['back'] = base_url('home/musrenbang');
         $this->template->load('user/template_back','user/musrenbang/view_musrenbang_detail',$data); 
    }else{
      $this->session->set_flashdata('message','Data Tidak Ditemukan!');
      redirect('home/musrenbang');
    }
  }

  function pencarian_pelayanan(){
      $data['title'] = 'CHECK PELAYANAN - '.title();
        $data['judul'] = 'CHECK PELAYANAN';
        $data['pelayanan'] = $this->model_app->view_ordering('pelayanan','pelayanan','ASC');
        $this->template->load('user/template','user/search/view_search',$data); 
  }
   function sub_pelayanan1(){
    $id_pelayanan = $this->input->post('id_pelayanan');
    $row = $this->model_app->view_where_ordering('sub_pelayanan',array('id_pelayanan'=>$id_pelayanan),'sub_pelayanan','ASC');

      $data['record'] = $row;
      $this->load->view('user/search/sub_pelayanan',$data);
   
  
  }
  function search_jampersal(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('jampersal',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('jampersal',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
                   $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
   function search_ekonomi_lemah(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('ekonomi_lemah',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('ekonomi_lemah',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
                   $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
   function search_bpjs(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('bpjs',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('bpjs',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
                   $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
  function search_izin_nikah(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('izin_nikah',array('yang_mengajukan'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('izin_nikah',array('yang_mengajukan'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['yang_mengajukan'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
                   $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
   function search_belum_menikah(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('belum_menikah',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('belum_menikah',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
                   $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
   function search_izin_mertua(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('izin_mertua',array('mertua'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('izin_mertua',array('mertua'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['mertua'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
                   $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }

   function search_wali_pernikahan(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('izin_wali',array('wali'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('izin_wali',array('wali'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['wali'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
    function search_domisili_usaha(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->db->query("SELECT * FROM usaha a JOIN usaha_dom b ON a.id_usaha = b.id_usaha WHERE nik = '".$nik."'");
   
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->db->query("SELECT * FROM usaha a JOIN usaha_dom b ON a.id_usaha = b.id_usaha WHERE nik = '".$n."'");
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($row['nama_usaha'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
    function search_keterangan_usaha(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('usaha',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('usaha',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($row['nama_usaha'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
            $no++;
        
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
  function search_usaha_tidakberjalan(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->db->query("SELECT * FROM usaha a JOIN usaha_tidak b ON a.id_usaha = b.id_usaha WHERE nik = '".$nik."'");
   
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->db->query("SELECT * FROM usaha a JOIN usaha_tidak b ON a.id_usaha = b.id_usaha WHERE nik = '".$n."'");
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($row['nama_usaha'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }
  function search_surat_kelahiran(){
    $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->db->query("SELECT * FROM surat_kelahiran WHERE ayah = '".$nik."' OR ibu = '".$nik."'");
   
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->db->query("SELECT * FROM surat_kelahiran WHERE ayah = '".$n."' OR ibu = '".$n."'");
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['ayah'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                   $i = $row['ibu'];
                  $nik_i = explode("_", $i);
                  if(isset($nik[1])){

                    $ibu = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik_i[0]))->row_array();
                  }else{
                    
                    $ibu = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$i."'  ")->row_array();
                  }
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])." & ".ucfirst($ibu['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])." & ". ucfirst($ibu['nama_lengkap'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($row['nama_usaha'])."</h6></div>
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }

    function search_surat_kematian(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('surat_kematian',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('surat_kematian',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }

   function search_keterangan_domisili(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('keterangan_domisili',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('keterangan_domisili',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }

   function search_surat_pindah_penduduk(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('surat_pindah',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('surat_pindah',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  }

   function search_bepergian(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('bepergian',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('bepergian',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 
   function search_kehilangan(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('kehilangan',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('kehilangan',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 

   function search_kelakuan_baik(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('kelakuan_baik',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('kelakuan_baik',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 

  function search_penghasilan_ortu(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('penghasilan_ortu',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('penghasilan_ortu',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 

    function search_pindah_belajar(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('pindah_belajar',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('pindah_belajar',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 

   function search_keterangan_terlantar(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('keterangan_terlantar',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('keterangan_terlantar',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 

    function search_keberatan_warga(){
   
   $nik = $this->input->post('nik');
    $html = "";
    $cek = $this->model_app->view_where('keberatan_warga',array('nik'=>$nik));
    if($cek->num_rows() > 0)
    {
      $data = $cek;
      $sts = 1;
    
    }else{
      $n = $nik.'_temp';
      $cek2 = $this->model_app->view_where('keberatan_warga',array('nik'=>$n));
      if($cek2->num_rows() > 0){
        $data = $cek2;
        $sts = 1;

      }else{
        $sts = 0;
       
      }
    }


    if($sts > 0){
      $no = 1;
      $html .= "  <div class='row'>";
       foreach($data->result_array() as $row){
                  if($row['approved'] == 'n' AND $row['approved_by'] != 0){
                    $status = "<i>Ditolak</i>";
                  }elseif($row['approved'] == 'n' AND $row['approved_by'] == 0){
                    $status = "<i>Diproses</i>";
                  }elseif($row['approved'] == 'y' AND $row['approved_by'] != 0){
                    $status = "<i>Disetejui</i>";
                  }
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
                 
                  $html .= "<div class='col-1'><h6>". $no.".</h6></div>
                  <div class='col-10'><h6>".ucfirst($war['nik'])."</h6></div>
                  <div class='col-12'><h6>". ucfirst($war['nama_lengkap'])."</h6></div>
               
                  <div class='col-12 text-left'><h6>".$status."</h6></div>";
         $no++;
      }
      $html .= "</div>";
    }else{
       $html = "<div class='col-12 text-center'><h3>Data Tidak Ditemukan</h3></div>";
    }



    echo $html;
  } 

}