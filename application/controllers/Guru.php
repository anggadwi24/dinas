<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guru extends CI_Controller {

function __construct() {
    parent::__construct();
     date_default_timezone_set('Asia/Makassar');
    
     
     
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
         $this->row = $cabang;
    $this->cabang = $cabang['id_sd'];
         if($cabang['status'] != 'sekolah'){
           exit();
         }
         $this->key = "aplikasidatakepegawaianENCRYPTION30224923912";
  // 
}
function login(){
  if($this->session->userdata('guru')){
    redirect('guru/');
  }else{
    if (isset($_POST['login'])){
   
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
       $no_ktp = strip_tags($this->input->post('a'));
       $password = $this->input->post('b');
       $cek = $this->db->query("SELECT * FROM guru where email='".$this->db->escape_str($no_ktp)."' AND id_sd = '".$cabang['id_sd']."'");
       if($cek->num_rows() > 0) {
  
       
         $row = $cek->row_array();
          $pwd= decode($row['password']);
          
  
         
            if(trim($pwd) == trim($password) ){
                $this->session->set_userdata(array('guru'=>array('id_guru'=>$row['id_guru'],'level'=>'guru','id_sd'=>$row['id_sd'])));
              
          
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from);
            }else{
           
              $data['title'] = 'Gagal Login';
              $this->session->set_flashdata('message','Password anda salah!');
              $this->load->view('guru/view_login',$data);
            }
          
        
        
           
       
       }else{
         $data['title'] = 'Gagal Login';
         $this->session->set_flashdata('message', 'Maaf, Email tidak ditemukan!');
         $this->load->view('guru/view_login',$data);
  
         
       }
   }else{
     $data['title'] = 'User Login';
     $this->load->view('guru/view_login',$data);
   }
  }

}
 function index(){
  $this->session->unset_userdata('referred_from');

  $this->session->set_userdata('referred_from', current_url()); 
  cek_session_cabang_guru($this->cabang);
  redirect('guru/home');
      
}
function cekSess(){
  var_dump($this->session->userdata['guru']['id_sd']);
}
function home(){
  $this->session->unset_userdata('referred_from');

  $this->session->set_userdata('referred_from', current_url()); 
  $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
  cek_session_cabang_guru($this->cabang);

$data['title'] = title();
$bulan = date('m');
$data['datakerja'] = $this->model_app->view_where('working_days',array('bulan'=>$bulan,'tahun'=>date('Y')));
$this->template->load(theme_base().'/template',theme_base().'/content',$data);
}
function downloadlembur(){
  $id = $this->uri->segment('4');
  $data['row'] = $this->db->query("SELECT * FROM lembur a JOIN guru b ON a.id_guru = b.id_guru WHERE a.id_lembur = $id")->row_array();
  // $this->load->view('guru/pengawas/view_download_lembur',$data);

   $this->load->helper('dompdf');
        $html = $this->load->view('guru/pengawas/view_download_lembur',$data,true);
    

//load content html
          
         
            // create pdf using dompdf
            $filename = 'SURAT TUGAS SEKDA';
            $paper = 'A4';
            $orientation = 'potrait';
            pdf_create($html, $filename, $paper, $orientation);
}
function dataCalendar(){

 $data = $this->model_app->view_where('working_days',array('tahun'=>date('Y')));

  $arr = array();
  if($data->num_rows() > 0){
      $status = true;
      foreach($data->result_array() as $row){
        $tgl  =$row['tahun'].'-'.$row['bulan'].'-'.$row['tanggal'];
        $date = date('Y-m-d',strtotime($tgl));
          if($row['status'] == "kerja"){
            $clr = "#08d26f"; 
            $h = date('w',strtotime($date));
            $h = hari_ini($h);
            $jamkerja = $this->model_app->view_where('working_hours',array('hari'=>$h));
            if($jamkerja->num_rows() > 0){
              $rowJ = $jamkerja->row_array();
              $title = 'Kerja | '.date('H:i',strtotime($rowJ['shift_masuk'])).' - '.date('H:i',strtotime($rowJ['shift_kelar'])); ;
              $start = $date.' '.$rowJ['shift_masuk'];
              $end = $date.' '.$rowJ['shift_keluar'];
            }else{
              $title = 'Kerja | Tidak ada jam kerja';
              $start = $date.' 00:00:00';
              $end = $date.' 23:59:59';
            }
           
          }
   
          elseif($row['status'] == 'libur'){
            $clr = "#ffb631"; 
            $title = 'Libur';
            $start = $date.' 00:00:00';
            $end = $date.' 23:59:59';

          }
        

          
          $arr[] = array('id'=>$row['id_wd'],
                    
                         'title'=>$title,
                         'description'=>null,
                         'start'=>date_format( date_create($start) ,"Y-m-d H:i:s"),
                         'end'=>date_format( date_create($end) ,"Y-m-d H:i:s"),
                         'color'=>$clr,
                         'allDay'=>true,

                  );


      }
  }else{
      $status = false;
  }
      
  echo json_encode(array('status'=>$status,'arr'=>$arr));

}
function kelas(){
  cek_session_cabang_guru($this->cabang);
  $data['title'] = title();
  $data['page'] = 'Kelas';
  $data['jenis'] = $this->row['jenis_sekolah'];
  $this->template->load(theme_base().'/kelas/template',theme_base().'/kelas/view_kelas',$data);

}
function detailKelas(){
  cek_session_cabang_guru($this->cabang);
  $class = decode($this->input->get('class'));
  $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$class,'rk_id_guru'=>$this->session->userdata['guru']['id_guru']));
  if($cek->num_rows() > 0){
    $row = $cek->row_array();
    $data['title'] = title();
    $data['row'] = $row;
    $data['back'] = base_url('guru/kelas');
    $data['judul'] = strtoupper($row['rk_title']);
    $data['jenis'] = $this->row['jenis_sekolah'];
    $this->template->load(theme_base().'/kelas/template-back',theme_base().'/kelas/view_detail',$data);
  }else{
    $this->session->set_flashdata('message','Kelas tidak ditemukan!');
    redirect('guru/kelas');
  }
}
function searchKelas(){
  if($this->input->method() =='post'){
    $output= null;
    if($this->session->userdata['guru']){
      $status = true;
      $msg = null;
      $keyword = $this->input->post('keyword');
      $data = $this->db->query("SELECT * FROM ruang_kelas WHERE rk_id_guru = '".$this->session->userdata['guru']['id_guru']."' AND rk_title LIKE '%".$keyword."%' OR rk_desc LIKE '%".$keyword."%' OR rk_kelas LIKE '%".$keyword."%'"); 
     
      if($data->num_rows() > 0){
        foreach($data->result_array() as $row){
          $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['rk_mapel']))->row_array();
          $output.= "<div class='col-12 form-group my-2 p-2 detail border border-light' data-href='".base_url('guru/detailKelas?class='.encode($row['rk_id']))."'>
                        <div class='row'>
                            <div class='col-3'>
                                <img src='".$row['rk_icon']."' class='img-fluid'>
                            </div>
                            <div class='col-9'>
                              <h6 class='mb-0'>".$row['rk_title']."</h6>
                              <span>".$mapel['mapel']." | ".$row['rk_kelas']."</span>
                            </div>
                        </div>
                     </div>";
        }
      }else{
        $output .= "<div class='col-12 form-group my-2 p-2'>
                      <h6>Keyword tidak ditemukan</h6>
                    </div>";
      }
    }else{
      $status = false;
      $msg ='Unauthorized';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function dataKelas(){
  if($this->input->method() =='post'){
    $output= null;
    if($this->session->userdata['guru']){
      $status = true;
      $msg = null;
      $data = $this->model_app->view_where_ordering('ruang_kelas',array('rk_id_guru'=>$this->session->userdata['guru']['id_guru']),'rk_id','DESC');
      if($data->num_rows() > 0){
        foreach($data->result_array() as $row){
          $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['rk_mapel']))->row_array();
          $output.= "<div class='col-12 form-group my-2 p-2 detail border border-light' data-href='".base_url('guru/detailKelas?class='.encode($row['rk_id']))."'>
                        <div class='row'>
                            <div class='col-3'>
                                <img src='".$row['rk_icon']."' class='img-fluid'>
                            </div>
                            <div class='col-9'>
                              <h6 class='mb-0'>".$row['rk_title']."</h6>
                              <span>".$mapel['mapel']." | ".$row['rk_kelas']."</span>
                            </div>
                        </div>
                     </div>";
        }
      }else{
        $output .= "<div class='col-12 form-group my-2 p-2'>
                      <h6>Belum ada kelas</h6>
                    </div>";
      }
    }else{
      $status = false;
      $msg ='Unauthorized';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function meeting(){
  if($this->input->method() == 'get'){
      $id = decode($this->input->get('meet'));
      $guru = $this->session->userdata['guru']['id_guru'];
      $cek = $this->db->query("SELECT * FROM ruang_kelas a JOIN ruang_kelas_meeting b ON a.rk_id = b.rkm_rk_id WHERE rk_id_guru = $guru AND rkm_id = $id");
      if($cek->num_rows() > 0){
        $row = $cek->row_array();
        $data['title'] = title();
        $data['row'] = $row;
        $data['back'] = base_url('guru/detailKelas?class=').encode($row['rk_id']);
        $data['judul'] = strtoupper($row['rk_title']);
        $data['jenis'] = $this->row['jenis_sekolah'];
        $this->template->load(theme_base().'/kelas/template-back',theme_base().'/kelas/view_meeting',$data);
      }else{
        $this->session->set_flashdata('message','Meeting tidak ditemukan!');
        redirect('guru/kelas');
      }
  }
}
function updatePartisipasiMeeting(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    $guru = $this->session->userdata['guru']['id_guru'];
    $cek = $this->db->query("SELECT * FROM ruang_kelas a JOIN ruang_kelas_meeting b ON a.rk_id = b.rkm_rk_id WHERE rk_id_guru = $guru AND rkm_id = $id");
    if($cek->num_rows() > 0){
      
      $siswa = $this->input->post('siswa');
      $count = count($siswa);
      if($count > 0){
        for($a=0;$a<$count;$a++){
          $sis = decode($siswa[$a]);

          $kehadiran = $this->input->post('kehadiran-'.$sis);
          if($kehadiran == 'y'){
              $cess = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$id,'rkmp_id_siswa'=>$sis));
              if($cess->num_rows() > 0){

              }else{
                $data = array('rkmp_rkm_id'=>$id,'rkmp_id_siswa'=>$sis);
                $this->model_app->insert('ruang_kelas_meeting_partisipasi',$data);
              }
             

          }else{
            $cess = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$id,'rkmp_id_siswa'=>$sis));
              if($cess->num_rows() > 0){
                $data = array('rkmp_rkm_id'=>$id,'rkmp_id_siswa'=>$sis);
                $this->model_app->delete('ruang_kelas_meeting_partisipasi',$data);
              }else{
                
              }
          }

        }
        $status = true;
        $msg = 'Absensi berhasil disimpan';
      }else{
        $status = false;
        $msg ='Tidak ada siswa';
      }
    }else{
      $status = false;
      $msg = 'Meeting tidak ditemukan!';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
}
function siswaKelas(){
  if($this->input->method() =='post'){
    $output= null;
    if($this->session->userdata['guru']){
      $id_guru = $this->session->userdata['guru']['id_guru'];
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id,'rk_id_guru'=>$id_guru));
      if($cek->num_rows() > 0){
        $status = true;
        $msg = null;
        $output .= "<div class='container'>";
        $output .= "<div class='row my-2'>";
        $output .= "<div class='col-12 form-group'><button type='button'  class='btn btn-danger btn-xs ' id='btnSiswa' data-type ='siswa'><i class='ri-add-line'></i></button></div>";
        $output .= "<div class='col-12 my-2' id='frmSiswa'></div>";
        $data =  $this->model_app->join_where_order('ruang_kelas_siswa','siswa','rks_id_siswa','id_siswa',array('rks_rk_id'=>$id,'rks_approved !='=>'n'),'rks_approved,nama_lengkap','DESC');
        if($data->num_rows() > 0){
          foreach($data->result_array() as $row ){
            if($row['rks_approved'] == 'y'){
              $sts = '<span>'.format_indo_w($row['rks_approved_on']).'</span>';
            }else if($row['rks_approved'] == 'p'){
                $sts ="<span class='btn btn-danger approved mr-1' data-acc = 'y' data-id='".encode($row['rks_id'])."'><i class='ri-check-line'></i></span>";
                $sts .="<span class='btn btn-danger approved' data-acc='n' data-id='".encode($row['rks_id'])."'><i class='ri-close-line'></i></span>";

            }else{
              $sts = '';
            }
              $output .= "<div class='col-12 my-2 border py-2 '>
                              <div class='row'>
                                <div class='col-2'>
                                  <img src='".$row['foto']."' class='img-fluid'>
                                </div>
                                <div class='col-6'>
                                    <h6 class='mb-0'>".$row['nama_lengkap']."</h6>
                                   
                                   
                                    
                                    

                                </div>
                                <div class='col-4 '>
                                   ".$sts."
                                </div>
                              </div>
                          </div>";
          }
        }else{
          $output .= "<div class='col-12'><h6>Belum ada siswa</h6></div>";
        }
        $output .= "</div>";
        $output .= "</div>";
      }else{
        $status = false;
        $msg ='Kelas tidak ditemukan';
      }
    }else{
      $status = false;
      $msg ='Unauthorized';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function acceptSiswa(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    $acc = $this->input->post('acc');
    $cek = $this->model_app->view_where('ruang_kelas_siswa',array('rks_id'=>$id));
    if($acc == 'y' OR $acc ='n'){
      if($cek->num_rows() > 0){
        $row = $cek->row_array();
        if($row['rks_approved'] == 'p'){
          $data = array('rks_approved'=>$acc,'rks_approved_on'=>date('Y-m-d H:i:s'));
          $where = array('rks_id'=>$id);
          $this->model_app->update('ruang_kelas_siswa',$data,$where);
          $status = true;
          if($acc == 'y'){
            $msg = 'Siswa berhasil disetujui';
          }else{
            $msg = 'Siswa berhasil ditolak';
          }
        }else if($row['rks_approved'] == 'y'){
          $status = false;
          $msg = 'Siswa sudah disetujui';
        }else {
          $status = false;
          $msg = 'Siswa sudah ditolak';
        }
      }else{
        $status = false;
        $msg = 'Siswa tidak ditemukan';
      }
    }else{
      $status = false;
      $msg = 'Invalid';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg));
    
  }
}
function materiKelas(){
  if($this->input->method() =='post'){
    $output= null;
    if($this->session->userdata['guru']){
      $id_guru = $this->session->userdata['guru']['id_guru'];
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id,'rk_id_guru'=>$id_guru));
      if($cek->num_rows() > 0){
        $status = true;
        $msg = null;
        $output .= "<div class='container'>";
        $output .= "<div class='row my-2'>";
        $output .= "<div class='col-12 form-group'><button type='button'  class='btn btn-danger btn-xs btnAdd' data-type ='materi'><i class='ri-add-line'></i></button></div>";
        $data = $this->model_app->view_where_ordering('ruang_kelas_materi',array('rke_rk_id'=>$id),'rke_id','DESC');
        if($data->num_rows() > 0){
          foreach($data->result_array() as $row ){
              $output .= "<div class='col-12 form-group my-2 py-2 border'>
                              <div class='row'>
                                <div class='col-9'>
                                    <h6 class='mb-0'>".$row['rke_title']."</h6>
                                    <p>".$row['rke_desc']."</p>
                                    <span class='my-0'><i class='ri-file-4-line'></i> ".$row['rke_file_name']."</span>
                                   
                                    
                                    

                                </div>
                                <div class='col-3 mt-3'>
                                    <button class='btn btn-danger btn-xs downloadMateri' data-file='".$row['rke_file']."'  ><i class='ri-download-line'></i></button>
                                </div>
                              </div>
                          </div>";
          }
        }else{
          $output .= "<div class='col-12'><h6>Belum ada materi</h6></div>";
        }
        $output .= "</div>";
        $output .= "</div>";
      }else{
        $status = false;
        $msg ='Kelas tidak ditemukan';
      }
    }else{
      $status = false;
      $msg ='Unauthorized';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function meetingKelas(){
  if($this->input->method() =='post'){
    $output= null;
    if($this->session->userdata['guru']){
      $id_guru = $this->session->userdata['guru']['id_guru'];
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id,'rk_id_guru'=>$id_guru));
      if($cek->num_rows() > 0){
        $status = true;
        $msg = null;
        $output .= "<div class='container'>";
        $output .= "<div class='row my-2'>";
        $output .= "<div class='col-12 form-group'><button type='button'  class='btn btn-danger btn-xs btnAdd' data-type ='meeting'><i class='ri-add-line'></i></button></div>";
        $data = $this->model_app->view_where_ordering('ruang_kelas_meeting',array('rkm_rk_id'=>$id),'rkm_id','DESC');
        if($data->num_rows() > 0){
          foreach($data->result_array() as $row ){
              $output .= "<div class='col-12 form-group my-2 py-2 border'>
                              <div class='row'>
                                <div class='col-8'>
                                    <h6>".$row['rkm_title']."</h6>
                                    <h6 ><i class='fa fa-calendar'></i> ".format_indo_1($row['rkm_date'])." </h6>
                                    <h6><i class='fa fa-clock'></i> ".date('H:i',strtotime($row['rkm_start']))." - ".date('H:i',strtotime($row['rkm_end']))."</h6>
                                    
                                    

                                </div>
                                <div class='col-4 mt-3'>
                                    <button class='btn btn-danger btn-xs meetDetail' data-href='".base_url('guru/meeting?meet=').encode($row['rkm_id'])."'  >DETAIL</button>
                                </div>
                              </div>
                          </div>";
          }
        }else{
          $output .= "<div class='col-12'><h6>Belum ada meeting</h6></div>";
        }
        $output .= "</div>";
        $output .= "</div>";
      }else{
        $status = false;
        $msg ='Kelas tidak ditemukan';
      }
    }else{
      $status = false;
      $msg ='Unauthorized';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function storeSiswa(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    $cek =$this->model_app->view_where('ruang_kelas',array('rk_id'=>$id,'rk_id_guru'=>$this->session->userdata['guru']['id_guru']));
    if($cek->num_rows() > 0){
        $siswa = $this->input->post('siswa');
        $count = count($siswa);
        if($count > 0){
            for($a = 0;$a<$count;$a++){
              $sis = decode($siswa[$a]);
              $cek = $this->model_app->view_where('ruang_kelas_siswa',array('rks_rk_id'=>$id,'rks_id_siswa'=>$sis));
              if($cek->num_rows() == 0){
                $data = array('rks_rk_id'=>$id,'rks_id_siswa'=>$sis,'rks_approved'=>'y','rks_joined_at'=>date('Y-m-d H:i:s'),'rks_approved_on'=>date('Y-m-d H:i:s'));
                $this->model_app->insert('ruang_kelas_siswa',$data);
              }
            }
            $status= true;
            $msg = 'Siswa berhasil ditambahkan';
        }else{
          $status = false;
          $msg = 'Tidak ada siswa yg dipilih';
        }
    }else{
      $status = false;
      $msg = 'Kelas tidak ditemukan';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
}
function updateKelas(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    $output = null;
    $cek =$this->model_app->view_where('ruang_kelas',array('rk_id'=>$id,'rk_id_guru'=>$this->session->userdata['guru']['id_guru']));
    if($cek->num_rows() > 0){
      $row = $cek->row_array();
      $status = true;
      $msg = null;
      $config['upload_path']          = './asset/upload_kelas/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 5000;
      $config['encrypt_name'] = TRUE;
      
      
    
      
     

      $this->load->library('upload', $config);


      if (! $this->upload->do_upload('file')){
     
        $icon = $row['rk_icon'];
      }else{
          $foto = $this->upload->data();
          
          $icon = base_url('asset/upload_kelas/').$foto['file_name'];
      }
      $data = array(
  
     
        'rk_title'=>$this->input->post('judul'),
        'rk_desc'=>$this->input->post('deskripsi'),
      
        'rk_icon'=>$icon,
        'rk_acc'=>$this->input->post('accept'),
    
      );
    $this->model_app->update('ruang_kelas',$data,array('rk_id'=>$id));
    }else{
      $status =false;
      $msg = 'Kelas tidak ditemukan!';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function settingKelas(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    $output = null;
    $cek =$this->model_app->view_where('ruang_kelas',array('rk_id'=>$id,'rk_id_guru'=>$this->session->userdata['guru']['id_guru']));
    if($cek->num_rows() > 0){
      $row = $cek->row_array();
      $status = true;
      $msg = null;
      $output .= "<div class='row'>
                    <div class='col-12 my-3 '><h3>Setting</h3></div>
                    <div class='col-12 border p-2'><h6>Kode Kelas : ".$row['rk_code']."</h6></div>

                    <div class='col-12 border p-2 btnAdd' data-type='edit' data-id='".encode($row['rk_id'])."'><h6 >Edit Kelas</h6></div>
                    <div class='col-12 border p-2 removeKelas' data-id='".encode($row['rk_id'])."'><h6>Hapus Kelas</h6></div>

                  </div>";
    }else{
      $status =false;
      $msg = 'Kelas tidak ditemukan!';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function formSiswa(){
  if($this->input->method() == 'post'){
    $output = null;
    $id = decode($this->input->post('id'));
    $kelas= $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id))->row_array();
      $siswa= $this->model_app->view_where('siswa',array('id_sd'=>$this->cabang,'kelas'=>$kelas['rk_kelas']));
      $status = true;
      $msg  = null;
      $output .= '
                        <form id="formSiswa">
                       
                              <div class="row">
                              <div class="col-12 form-group">
                                  <h6 for="">Siswa</h6>
                                  <select class="form-control" id="siswaSel" name="siswa[]" multiple  required style="min-width:100px">
                                ';
      if($siswa->num_rows() > 0){
        foreach($siswa->result_array() as $sis){
          $cek = $this->model_app->view_where('ruang_kelas_siswa',array('rks_rk_id'=>$id,'rks_id_siswa'=>$sis['id_siswa']));
          if($cek->num_rows() == 0){
          $output .="<option value='".encode($sis['id_siswa'])."'>".$sis['nama_lengkap']."</option>";

          }
        }
      }
      $output .='              </select>
                              </div>
                              <div class="col-12 form-group">
                              <button  class="btn btn-primary">Undang</button>
                              </div>
                             
                             
                              
                              <input type="hidden" name="id" id="id" value="'.encode($id).'">
                          </div>
                        </div>
                       
                          
                         
                       
                        </form>
                      ';    
                    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }

}
function modal(){
  if($this->input->method() == 'post'){
    $type = $this->input->post('type');
    $id = decode($this->input->post('id'));
    $output = null;
    if($type == 'meeting'){
      $status = true;
      $msg = null;
      $output .= '<div class="modal fade" id="modalMeeting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Meeting</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="formMeeting">
                        <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12 form-group">
                                  <label for="">Judul</label>
                                  <input type="text" name="judul" class="form-control" required="">
                              </div>
                              <div class="col-md-12 form-group">
                                  <label for="">Deskripsi</label>
                                  <input type="text" name="deskripsi" class="form-control" style="height:80px;">
                              </div>
                              <div class="col-md-4 form-group">
                                  <label for="">Tanggal</label>
                                  <input type="date" class="form-control" name="date" value="'.date('Y-m-d').'" required="">
                              </div>
                              <div class="col-md-4 form-group">
                                  <label for="">Start</label>
                                  <input type="time" class="form-control" name="start" value="07:00" required="">
                              </div>
                              <div class="col-md-4 form-group">
                                  <label for="">End</label>
                                  <input type="time" class="form-control" name="end" value="10:00" required="">
                              </div>
                              
                              <div class="col-md-12 form-group zoom">
                                  <label for="">URL</label>
                                  <input type="text" class="form-control" name="url"  >
                              </div>
                              <input type="hidden" name="id" id="id" value="'.encode($id).'">
                          </div>
                        </div>
                        <div class="modal-footer">
                          
                          <button  class="btn btn-primary">BUAT</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>';
                 
    }else if($type == 'materi'){
      $status = true;
      $msg  = null;
      $output .= '<div class="modal fade" id="modalMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="formMateri">
                        <div class="modal-body">
                              <div class="row">
                              <div class="col-md-12 form-group">
                                  <label for="">Title</label>
                                  <input type="text" name="judul" class="form-control" required="">
                              </div>
                              <div class="col-md-12 form-group">
                                  <label for="">Deskripsi</label>
                                  <input type="text" name="deskripsi" class="form-control" style="height:80px;">
                              </div>
                              <div class="col-md-12 form-group">
                                  <label for="">Materi</label>
                                  <input type="file" class="form-control" name="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" required="">
                              </div>
                              
                              <input type="hidden" name="id" id="id" value="'.encode($id).'">
                          </div>
                        </div>
                        <div class="modal-footer">
                          
                          <button  class="btn btn-primary">TAMBAH</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>';
    }else if($type == 'edit'){
      $kelas= $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
      if($kelas->num_rows() > 0){
        $row = $kelas->row_array();
        $status = true;
        $msg  = 'Kelas berhasil diupdate';
        if($row['rk_acc'] == 'y'){
          $selected= 'selected';
        }else{
          $selected = '';
        }
        if($row['rk_acc'] == 'n'){
          $selected1= 'selected';
        }else{
          $selected1 = '';
        }
        $output .= '<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form id="formEdit">
                          <div class="modal-body">
                                <div class="row">
                                <div class="col-12 form-group">
                                    <h6 for="">Judul</h6>
                                    <input type="text" class="form-control" name="judul" required value="'.$row['rk_title'].'">
                                </div>
                                <div class="col-12 form-group">
                                    <h6 for="">Deskripsi</h6>
                                    <input type="text" class="form-control" name="desc" required value="'.$row['rk_desc'].'" style="height:80px;">
                                </div>
                                <div class="col-12 form-group">
                                <label for="">Persetujuan join kelas</label>
                                  <select name="acc" id="acc" class="form-control" required>
                                      <option value="y" '.$selected.'>Perlu</option>
                                      <option value="n" '.$selected1.'>Tidak Perlu</option>
                                  </select>
                                </div>
                                <div class="col-12 form-group">
                                    <h6 for="">Icon</h6>
                                    <input type="file" class="form-control" name="file" accept="image/*">
                                </div>
                               
                               
                                
                                <input type="hidden" name="id" id="id" value="'.encode($id).'">
                            </div>
                          </div>
                          <div class="modal-footer">
                            
                            <button  class="btn btn-primary">SIMPAN</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>';
      }else{
        $status = false;
        $msg = 'Kelas tidak ditemukan';
      }
      
      
    }else{
      $status = false;
      $msg = 'Wrong type!';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
  }
}
function removeKelas(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    if($this->session->userdata['guru']){
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
      if($cek->num_rows() > 0){
          $row = $cek->row_array();
          if($row['rk_id_guru'] == $this->session->userdata['guru']['id_guru']){
            $this->model_app->delete('ruang_kelas',array('rk_id'=>$id));
         

            $status = true;
            $msg = 'Kelas berhasil dihapus';
          }else{
            $status = false;
            $msg = 'Anda tidak memiliki akses';
          }
      }else{
        $status = true;
        $msg = 'Kelas tidak ditemukan';
      }
    }else{
      $status = false;
      $msg = 'Unauthorize';
    }
   
    echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
}
function storeMateri(){
  if($this->input->method() == 'post'){
    $id = $this->session->userdata['guru']['id_guru'];

   
   
      $rk_id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$rk_id));
      $output = null;
      if($cek->num_rows() > 0){
        $config['upload_path']          = './asset/upload_kelas/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|excel|xls|xlsx|ppt|pptx';
        $config['max_size']             = 5000;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (! $this->upload->do_upload('file')){
          $msg = $this->upload->display_errors();
          $status = false;
        }else{
          $upload= $this->upload->data();
          $file = $upload['file_name'];
          $fileName = $_FILES['file']['name']; 

          $data =array('rke_rk_id'=>$rk_id,'rke_title'=>$this->input->post('judul'),'rke_desc'=>$this->input->post('deskripsi'),'rke_file'=>$file,'rke_file_name'=>$fileName,'rke_upload_level'=>'guru','rke_upload_by'=>$id);
          $this->model_app->insert('ruang_kelas_materi',$data);
          $status= true;
          $msg = 'Materi berhasil diupload!';
        }
      }else{
        $status = false;
        $msg= 'kelas tidak ditemukan!';
      }
   
   echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
}
function storeMeeting(){
  if($this->input->method() == 'post'){
    $id = decode($this->input->post('id'));
    $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
    if($cek->num_rows() > 0){
 
        $data = array('rkm_rk_id'=>$id,
        'rkm_title'=>$this->input->post('judul'),
        'rkm_desc'=>$this->input->post('deskripsi'),
        'rkm_date'=>date('Y-m-d',strtotime($this->input->post('date'))),
        'rkm_start'=>date('H:i:s',strtotime($this->input->post('start'))),
        'rkm_end'=>date('H:i:s',strtotime($this->input->post('end'))),
        'rkm_url'=>$this->input->post('url'),

       );
      
       
        $this->model_app->insert('ruang_kelas_meeting',$data);
        $status = true;
        $msg = 'Meeting Berhasil dibuat!';
    }else{
      $status = false;
      $msg = 'Kelas tidak ditemukan!';
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg));
  
  }
}
function storeClass(){
  
  if($this->input->method() == 'post'){
    if($this->session->userdata['guru']){
      $redirect = null;
        $this->form_validation->set_rules('kode','Kode Kelas','required|is_unique[ruang_kelas.rk_code]|max_length[10]');
      if($this->form_validation->run() === false){
            $msg = 'Kode Kelas sudah digunakan!';
            $status = false;
      }else{
        $config['upload_path']          = './asset/upload_kelas/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['encrypt_name'] = TRUE;
        
        
      
        
      

        $this->load->library('upload', $config);


        if (! $this->upload->do_upload('file')){
      
          $icon = base_url('asset/upload_kelas/blank.png');
        }else{
            $foto = $this->upload->data();
            
            $icon = base_url('asset/upload_kelas/').$foto['file_name'];
        }
        $data = array('rk_id_sd' =>$this->cabang,
                    'rk_code' =>$this->input->post('kode'),
                    'rk_kelas'=>$this->input->post('kelas'),
                    'rk_mapel'=>decode($this->input->post('mapel')),
                    'rk_title'=>$this->input->post('judul'),
                    'rk_desc'=>$this->input->post('deskripsi'),
                    'rk_id_guru'=>$this->session->userdata['guru']['id_guru'],
                    'rk_icon'=>$icon,
                    'rk_acc'=>$this->input->post('acc'),
                    'rk_created_by'=>$this->session->userdata['guru']['id_guru']
                    );
            $rk_id = $this->model_app->insert_id('ruang_kelas',$data);
            $status = true;
            $msg = 'Kelas Berhasil Ditambah';
            $redirect = base_url('guru/detailKelas?class='.encode($rk_id));

      }
    }else{
      $status = false;
      $msg = 'Unauthorized';
    }
    
    echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
  }
}
function absensi()
{
  $this->session->unset_userdata('referred_from');

  $this->session->set_userdata('referred_from', current_url()); 
    cek_session_cabang_guru($this->cabang);

    $data['title'] = title();
    $data['menu'] = 'Absensi';
    $d = date('j');
    $m = date('m');
    $y = date('Y');
    $tanggal = date('Y-m-d');
    $id = $this->session->userdata['guru']['id_guru'];
    $cek = $this->model_app->view_where('working_days',array('tanggal'=>$d,'bulan'=>$m,'tahun'=>$y))->row_array();
    $form = $this->db->query("SELECT * FROM `form_izin` WHERE ('$tanggal' BETWEEN dari AND sampai ) AND `id_pegawai` = $id AND approved='setuju' AND status_form = 'guru'  ")->num_rows();
    if($cek['status']=='libur'){
      $this->session->set_flashdata('message', 'Anda tidak bisa absen, hari ini hari libur!');
      $data['access'] = 'n';
    }elseif($form > 0){
      $this->session->set_flashdata('message', 'Form Ijin / Sakit anda masih berlaku!');
      $data['access'] ='n';
      

    }else{
      $hari= hari_ini(date('w'));
      $shift = $this->model_app->view_where('working_hours',array('hari'=>$hari))->row_array();
      $masuk = date('H:i:s',strtotime($shift['shift_masuk']));
      $keluar =  date('H:i:s',strtotime($shift['shift_keluar']));
      $jam = date('H:i:s');
      $bts = date('H:i:s',strtotime($shift['shift_masuk']."-120 Minutes"));
      if($bts <= $jam){
       $data['access'] = 'y';
      }else{
        $data['access'] = 'n';
      }
   
       

      $data['absen'] = $this->model_app->view_where('absensi',array('tanggal'=>$tanggal,'id_pegawai'=>$id,'status_absen'=>'guru'));
    

    }
  
    
    $this->template->load(theme_base().'/template-content',theme_base().'/absen/view_absensi',$data);
}
function fetch_absen()
{
  $output = "";
  $id = $this->session->userdata['guru']['id_guru'];
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $data = $this->model_app->view_where_ordering_limit('absensi',array('id_pegawai'=>$id,'status_absen'=>'guru'),'id_absensi','DESC',$start,$limit);
  if($data->num_rows() > 0){

      foreach($data->result_array() as $row){
         if($row['absen_keluar'] == ""){
                $out = "-- : -- ";
              }else{
                $out = date('H:i',strtotime($row['absen_keluar']));
              }
              if($row['foto_keluar']==""){
                  $foto_out =  "Tidak Ada";
              }else{
                  $foto_out = "<a href='". base_url('asset/foto_absen/').$row['foto_keluar']."' target='_BLANK'>Buka</a>";
              }
               if($row['ket'] == 'dinas'){
                $ket = 'DL';
               }elseif($row['ket']=='tugas'){
                $ket = 'TL';
               }elseif($row['ket'] == 'wfh'){
                $ket = "WFH";
               }else{
                $ket ="ABSEN";
               }   

              $hari = date('w',strtotime($row['tanggal']));
              $h = date('d',strtotime($row['tanggal']));
              $bulan = date('m',strtotime($row['tanggal']));
              $tahun = date('Y',strtotime($row['tanggal']));

              $output .="  
              <div onClick='detailAbsen(".$row['id_absensi'].")' class='col-3 text-center'><h1>".$h."</h1><label class='ml-2'>".strtoupper(getBulan($bulan))."</label></div>
              <div  onClick='detailAbsen(".$row['id_absensi'].")' class='col-9 mt-1'><h3><b>".strtoupper(hari_ini($hari))."</b></h3><label class='mt-2'>".$ket." || ". date('H:i',strtotime($row['absen_masuk']))." - ".$out." </label></div>
              <div  onClick='detailAbsen(".$row['id_absensi'].")' class='col-12'><hr style='border-top: 1px solid #960001;'></div>
              
            
            ";
            
      }

  }
  echo $output;
}
function detailabsen()
{
  cek_session_cabang_guru($this->cabang);

  $id = $this->uri->segment('3');
  $data['row'] = $this->model_app->view_where('absensi',array('id_absensi'=>$id))->row_array();
  $data['title'] = title();
  $data['judul'] = "Detail Absensi";
  $this->load->view('guru/absen/view_absensi_detail',$data);
}
function inputabsen()
{
  cek_session_cabang_guru($this->cabang);
   
    $id = $this->session->userdata['guru']['id_guru'];
    $location = $this->model_app->view_where('location_absen',array('loc_id_sd'=>$this->cabang));
    $peg = $this->model_app->view_where('guru',array('id_guru'=>$id))->row_array();
    if($location->num_rows() == 0){
      $this->session->set_flashdata('message','Sekolah belum menentukan titik lokasi absen!');
      redirect('guru/absensi');
    }else{
        $sub = $location->row_array();
        if($sub['loc_latitude'] == "" OR $sub['loc_longitude']==""){
          $this->session->set_flashdata('message','Lokasi Absensi Sub Kegiatan belum ditentukan!');
          redirect('guru/absensi');
        }else{

        $data['target_lat'] = $sub['loc_latitude'];
        $data['target_long'] = $sub['loc_longitude'];
        $data['title'] = title();
        $data['judul'] = "Absensi";
        $tanggal = date('Y-m-d');
        $data['absen'] = $this->model_app->view_where('absensi',array('tanggal'=>$tanggal,'id_pegawai'=>$id,'status_absen'=>'guru'));
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("https://ipinfo.io/$ip/json"));
        $loc =  $details->loc; // -> "Mountain View"
        $lok =explode(',', $loc);
        $data['lat'] = $lok[0];
        $data['long'] = $lok[1];
        $this->template->load(theme_base().'/template-back',theme_base().'/absen/view_do_absen',$data);
      }
    }

  
}
function do_absen()
{
  $status = $this->input->post('status');

  if($status == 'masuk')
  {             $tgl = date('Y-m-d');
                $id_peg = $this->session->userdata['guru']['id_guru'];
                $abs_cek = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $id_peg AND tanggal = '$tgl' ANd status_absen = 'guru' ")->num_rows();
                if($abs_cek > 0){
                  $this->session->set_flashdata('message','Anda Sudah Absen Hari Ini!');
                  redirect('guru/absensi');
                }else{
                $config['upload_path']          = './asset/foto_absen/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 20000;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto')){
                
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('guru/absensi');
                }else{
                  $foto = $this->upload->data();
                  $h = hari_ini(date('w'));
                  $cek = $this->model_app->view_where('working_hours',array('hari'=>$h))->row_array();
                  $time = date('H:i:s');

                  if($time <= $cek['shift_masuk']){
                    $telat ='n';
                    $poin = 1;
                    $this->session->set_flashdata('success','Absensi Berhasil');
                  }else{
                    $telat ='y';
                    $poin = 0;
                    $this->session->set_flashdata('message','Anda terlambat!');
                  }

                  $ip      = $_SERVER['REMOTE_ADDR'];
                $tanggal = date("Y-m-d");
                $data = array('id_pegawai'=>$this->session->userdata['guru']['id_guru'],
                        'tanggal'=>$tanggal,
                        'absen_masuk'=>$time,
                        
                        'ip'=>$ip,
                        'longitude_in'=>$this->input->post('long'),
                        'latitude_in'=>$this->input->post('lat'),
                        'foto_masuk'=>base_url('asset/foto_absen/').$foto['file_name'],
                        'telat'=>$telat,
                        'pulang_awal'=>'n',
                        'ket'=>$this->input->post('ket'),
                        'status_absen'=>'guru'
                     );
                $this->model_app->insert('absensi',$data);

                $poin = array('id_pegawai'=>$this->session->userdata['guru']['id_guru'],'tanggal'=>$tanggal,'poin'=>$poin,'status_poin'=>'guru');
                $this->model_app->insert('poin_pegawai',$poin);
                redirect('guru/absensi');
                }
              }
  }else{

        $config['upload_path']          = './asset/foto_absen/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 20000;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto')){
                
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('guru/absensi');
                }else{
                  $foto = $this->upload->data();
                  $h = hari_ini(date('w'));
                  $cek = $this->model_app->view_where('working_hours',array('hari'=>$h))->row_array();
                  $ip      = $_SERVER['REMOTE_ADDR'];
                $tanggal = date("Y-m-d");
                $time = date('H:i:s');
                  


                  
                    if($time >= $cek['shift_keluar']){
                      $pulang ='n';
                      
                      $this->session->set_flashdata('success','Absensi Berhasil');

                  
                    }else{
                      $pulang ='y';
                  
                      $this->session->set_flashdata('message','Anda pulang mendahului jadwal kerja!');
                    }

                    
                  $data = array('id_pegawai'=>$this->session->userdata['guru']['id_guru'],
                          'tanggal'=>$tanggal,
                          'absen_keluar'=>$time,
                      
                          'ip'=>$ip,
                          'foto_keluar'=>base_url('asset/foto_absen/').$foto['file_name'],
                           'longitude_out'=>$this->input->post('long'),
                            'latitude_out'=>$this->input->post('lat'),
                          'pulang_awal'=>$pulang,
                       );
                  $where = array('id_absensi'=>$this->input->post('id_absen'));
                  $this->model_app->update('absensi',$data,$where);


                  redirect('guru/absensi');
            
          }
  }
}

function form()
{
  $this->session->unset_userdata('referred_from');

  $this->session->set_userdata('referred_from', current_url()); 
  cek_session_cabang_guru($this->cabang);

  $data['title'] = title();
    $data['menu'] = 'Form Ijin/Sakit';
    $id = $this->session->userdata['guru']['id_guru'];
     
    $this->template->load(theme_base().'/template-content',theme_base().'/form/view_form',$data);
}

function inputform()
{
  cek_session_cabang_guru($this->cabang);

  $data['title'] = title();
  $data['judul'] = "Ajukan Form";
  $tanggal = date('Y-m-d');
 
  $this->template->load(theme_base().'/template-back',theme_base().'/form/view_form_add',$data);

}
function detailform()
{
  cek_session_cabang_guru($this->cabang);

  $id = $this->uri->segment('3');
  $data['row'] = $this->model_app->view_where('form_izin',array('id_form'=>$id))->row_array();
  $data['title'] = title();
  $data['judul'] = "Detail Form";
  $this->load->view('guru/form/view_form_detail',$data);

}
function fetch_form()
{
  $output = "";
  $id = $this->session->userdata['guru']['id_guru'];
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
   $data = $this->model_app->view_where_ordering_limit('form_izin',array('id_pegawai'=>$id,'status_form'=>'guru'),'id_form','DESC',$start,$limit);

  if($data->num_rows() > 0){

      foreach($data->result_array() as $row){
              

            
              if($row['approved'] == 'tidak'){
                 $output .="  
              <div class='border border-danger row p-2 text-center m-2' onClick='detailForm(".$row['id_form'].")' style='width:100% !important'>
              <div onClick='detailForm(".$row['id_form'].")' class='col-12 text-left'><h2 style='margin-bottom:-5px!important'>".strtoupper($row['status'])."</h2><label class='' >".strtoupper(format_indo_w($row['dari']))." -  ".strtoupper(format_indo_w($row['sampai']))."</label></div>
              
              <div  onClick='detailForm(".$row['id_form'].")' class='col-12 text-left'><label>".$row['keterangan']." </label></div>
             
              </div>
              
            
            ";
              }
              elseif($row['approved']=='proses'){
              $output .="  
              <div class='border border-warning row p-2 text-center m-2' onClick='detailForm(".$row['id_form'].")' style='width:100% !important'>
              <div onClick='detailForm(".$row['id_form'].")' class='col-12 text-left'><h2 style='margin-bottom:-5px!important'>".strtoupper($row['status'])."</h2><label class='' >".strtoupper(format_indo_w($row['dari']))." -  ".strtoupper(format_indo_w($row['sampai']))."</label></div>
              
              <div  onClick='detailForm(".$row['id_form'].")' class='col-12 text-left'><label>".$row['keterangan']." </label></div>
             
              </div>
              
            
            ";
            }else{
                $output .="  
              <div class='border border-success row p-2 text-center m-2' onClick='detailForm(".$row['id_form'].")' style='width:100% !important'>
              <div onClick='detailForm(".$row['id_form'].")' class='col-12 text-left'><h2 style='margin-bottom:-5px!important'>".strtoupper($row['status'])."</h2><label class='' >".strtoupper(format_indo_w($row['dari']))." -  ".strtoupper(format_indo_w($row['sampai']))."</label></div>
              
              <div  onClick='detailForm(".$row['id_form'].")' class='col-12 text-left'><label>".$row['keterangan']." </label></div>
             
              </div>
              
            
            ";
            }
            
      

  }
  }
  echo $output;
}

function fetch_report()
{
  $output = "";
  $id = $this->session->userdata['guru']['id_guru'];
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $date = $this->input->post('date');
    $data = $this->model_app->view_where_ordering_limit('report',array('id_pegawai'=>$id,'date'=>$date,'status_report'=>'guru'),'id_report','DESC',$start,$limit);
  

  if($data->num_rows() > 0){

      foreach($data->result_array() as $row){
              $cetak = substr($row['report'], 0, 100);
              if($row['finish']=='y'){
              $output .="  
               <div class='border border-secondary row p-2 text-center m-2' onClick='detailReport(".$row['id_report'].")' style='width:100% !important'>
                 <div class='col-12'><h6>". strtoupper($row['judul_report'])."</h6></div>
                 <div class='col-12'><label>".$cetak."</label></div>
               </div>
          
                     

         
            ";
            }else{
              $output .="  
               <div class='border border-warning row p-2 text-center m-2' onClick='detailReport(".$row['id_report'].")'  style='width:100% !important'>
                 <div class='col-12'><h6>". strtoupper($row['judul_report'])."</h6></div>
                 <div class='col-12'><label>".$cetak."</label></div>
               </div>
          
                     

         
            ";
            }
            
      

  }
  }
  echo $output;
}
function do_form(){
  $status = $this->input->post('status');
  if($status == 'sakit'){
   $data = [];
   
      $count = count($_FILES['files']['name']);
    
      for($i=0;$i<$count;$i++){
    
        if(!empty($_FILES['files']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
  
          $config['upload_path'] =  './asset/foto_form/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '20000';
          $config['encrypt_name'] = TRUE;
          $config['file_name'] = $_FILES['files']['name'][$i];
   
          $this->load->library('upload',$config); 
          $this->upload->do_upload('file');
        
          // $data['totalFiles'][] = $images;
          $uploadData = $this->upload->data();
          $images[] = $uploadData['file_name'];
          }

   
      }
         $fileName = implode(';',$images);
            $foto = str_replace(' ','_',$fileName);
           
    
          if(trim($foto)!=''){
              
          
             $id = $this->session->userdata['guru']['id_guru'];
            $dari = date('Y-m-d',strtotime($this->input->post('dari')));
            $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
            $data = array('id_pegawai'=>$id,'keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'),'foto'=>base_url('asset/foto_form/').$foto,'approved'=>'proses','status_form'=>'guru');
            $this->db->insert('form_izin',$data);
            $this->session->set_flashdata('success','Formulir berhasil diinput!');
        

            
          }else{
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             
             
          }
        }else{
              $id = $this->session->userdata['guru']['id_guru'];
            $dari = date('Y-m-d',strtotime($this->input->post('dari')));
            $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
            $data = array('id_pegawai'=>$id,'keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'),'approved'=>'proses','status_form'=>'guru');
            $this->db->insert('form_izin',$data);
            $this->session->set_flashdata('success','Formulir berhasil diinput!');
          }
     $tgl1 = strtotime($dari); 
    $tgl2 = strtotime($sampai); 

    $jarak = $tgl2 - $tgl1;

      $hari = $jarak / 60 / 60 / 24+1;
    $peg = $this->model_app->view_where('guru',array('id_guru'=>$id))->row_array();
    $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$peg['bagian']))->row_array();
    $sub_bag = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$peg['sub_bagian']))->row_array();
    $peng = $this->model_app->view_where('pengawas',array('sub_bagian'=>$peg['sub_bagian']))->row_array();

             $nohp = $peng['no_hp'];
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

Mengajukan ".ucfirst($status)." Dengan Alasan : 
".$this->input->post('keterangan')."

Selama : ".$hari." Hari
Dari : ".format_indo($dari)."
Sampai : ".format_indo($sampai);
   
   $this->kirimWablas($hp,$pesan);


            redirect('guru/form');
        
          
           
       
  
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
  function report()
  {
    $this->session->unset_userdata('referred_from');

    $this->session->set_userdata('referred_from', current_url()); 
    $data['title'] = title();
    $data['menu'] = "Report";
    $id = $this->session->userdata['guru']['id_guru'];
    $tgl = date('Y-m-d');
    if($this->uri->segment('3') == "")
    {
      $data['tanggal'] = date('d');
      $data['bulan'] = date('m');
      $data['tahun'] = date('Y');
    }else{
      $data['tanggal'] = $this->uri->segment('3');
      $data['bulan'] = $this->uri->segment('4');
      $data['tahun'] = $this->uri->segment('5');
    }
    
  
    $this->template->load(theme_base().'/template-content',theme_base().'/report/view_report',$data);
  

  }
        
function inputreport()
{
$data['title'] = title();
  $data['judul'] = "TAMBAH REPORT";
  $id = $this->session->userdata['guru']['id_guru'];
    $tgl = date('Y-m-d');
    $cek = $this->model_app->view_where('absensi',array('tanggal'=>$tgl,'id_pegawai'=>$id,'status_absen'=>'guru'));
  if($cek->num_rows() > 0){
    $this->template->load(theme_base().'/template-back',theme_base().'/report/view_report_add',$data);
    }else{
       $this->session->set_flashdata('message','Anda Belum Absen!');
    redirect('guru/absensi');
    }
 

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
  
    $id = $this->session->userdata['guru']['id_guru'];

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
        
          // $data['totalFiles'][] = $images;
          $uploadData = $this->upload->data();
          $images[] = $uploadData['file_name'];
          }

   
      }
         $fileName = implode(';',$images);
            $foto = str_replace(' ','_',$fileName);
           
    
          if(trim($foto)!=''){
    
    $data = array('id_pegawai'=>$id,'judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'date'=>$date,'jam_kerja'=>'0','foto_masuk'=>base_url('asset/foto_report/').$foto,'status_report'=>'guru');
    $this->db->insert('report',$data);
    $this->session->set_flashdata('success','Report berhasil diinput!');
    redirect('guru/report');
    }else{
          $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('guru/report');
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
        
          // $data['totalFiles'][] = $images;
          $uploadData = $this->upload->data();
          $images[] = $uploadData['file_name'];
          }

   
      }
         $fileName = implode(';',$images);
            $foto = str_replace(' ','_',$fileName);
           
    
          if(trim($foto)!=''){
            $id_peg  = $this->session->userdata['guru']['id_guru'];
            $tanggal = date('Y-m-d');
            $p = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$date,'id_pegawai'=>$id_peg,'status_poin'=>'guru'))->row_array();
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
           

            $data = array('judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'end'=>$end,'date'=>$date,'foto_keluar'=>base_url('asset/foto_report/').$foto,'jam_kerja'=>$sel,'finish'=>'y');
            $where = array('id_report'=>$id);
             $this->model_app->update('report',$data,$where);
            $this->session->set_flashdata('success','Report berhasil diubah!');

            redirect('guru/report');
        

            
          }
          else{
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('guru/report');
             
          }
   }

   function detailreport()
   {
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('report',array('id_report'=>$id))->row_array();
    if($cek['finish'] == 'y')
    {
      $data['access'] ='n';
    }
    else{
      $data['access']='y';
    }
   $data['title'] = title();
    $data['row'] = $cek;
    $this->load->view('guru/report/view_report_detail',$data);


    
   }
  function download()
  {

    $status = $this->uri->segment('3');
    $id = $this->session->userdata['guru']['id_guru'];
    if($status == 'harian'){
      $data['row'] = $this->db->query("SELECT * FROM guru a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_guru = $id")->row_array();
        $this->load->helper('dompdf');
      $html = $this->load->view('guru/download/download_pdf',$data,true);
    $data['title'] = title();
 
    //load content html
        
       
          // create pdf using dompdf
          $filename = 'LEMBAR-KERJA-HARIAN-NON-ASN';
          $paper = 'A4';
          $orientation = 'potrait';
          pdf_create($html, $filename, $paper, $orientation);
    }elseif($status == 'bulanan'){

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
      $poin = 0;
      foreach ($cek->result_array() as $row) {
        $tgl = $row['tanggal'];
        $bln = $row['bulan'];
        $thn = $row['tahun'];
        $all = $thn.'-'.$bln.'-'.$tgl;
        $date = date('Y-m-d',strtotime($all));
      
        
        $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_guru = $id");
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

        $pp = $this->db->query("SELECT * FROM poin_guru WHERE id_guru = $id AND tanggal = '$date' "  )->row_array();
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
      $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$m' AND MONTH(sampai) = '$m' AND YEAR(dari) = '$y' AND YEAR(sampai) = '$y' AND id_guru = $id ");
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

      $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE MONTH(date)=$m AND id_guru = $id")->row_array();

      $data['jumlah_kerja'] = $rep['tot'];
      $data['lama_kerja'] = $rep['tot_jam'];


      $data['row'] = $this->db->query("SELECT * FROM guru a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_guru = $id")->row_array();
      
        $this->load->helper('dompdf');
      $html = $this->load->view('guru/download/download_pdf_m',$data,true);
    
 
    //load content html
        
       
          // create pdf using dompdf
          $filename = 'LEMBAR-KERJA-BULAN-'.strtoupper(bulan($m)).'-NON-ASN';
          $paper = 'A4';
          $orientation = 'potrait';
          pdf_create($html, $filename, $paper, $orientation);


    }elseif($status =='tahunan'){


      $now = date('Y-m-d');
      $start = date('Y-m-01');
      $d = date('j');
      $m = date('m');
      $y = date('Y');

      $data['bulan'] = bulan($m);
      $data['month'] = $m;
      $cek = $this->db->query("SELECT * FROM harikerja  WHERE  tahun = '$y' AND status = 'kerja'");
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
      
        
        $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_guru = $id");
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
        
      }
      $data['alpha']=$bolos;
      $data['telat'] = $telat;
      $data['pulang'] = $pulang;
      $data['harikerja'] = $cek->num_rows();
      $data['kerja'] = $kerja;

      $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);

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
      $data['persentase'] = $persentase;
        $form = $this->db->query("SELECT * FROM form_izin WHERE YEAR(dari) = '$y' AND YEAR(sampai) = $y AND id_guru = $id");
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

      $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE YEAR(date)=$y AND id_guru = $id")->row_array();

      $data['jumlah_kerja'] = $rep['tot'];
      $data['lama_kerja'] = $rep['tot_jam'];
      
        $data['row'] = $this->db->query("SELECT * FROM guru a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_guru = $id")->row_array();
      
       
      
       $this->load->helper('dompdf');
      $html = $this->load->view('guru/download/download_pdf_y',$data,true);
    
 
    //load content html
        
       
          // create pdf using dompdf
          $filename = 'LEMBAR-KERJA-TAHUN-'.$y.'-NON-ASN';
          $paper = 'A4';
          $orientation = 'potrait';
          pdf_create($html, $filename, $paper, $orientation);


    }else{


    $data['title'] = title();
    $data['menu'] = "Download";
    
    $this->template->load(theme_base().'/template-content',theme_base().'/download/view_download',$data);
    }
  }

  function peringkat(){
  $data['title'] = title();
    $data['menu'] = "Peringkat";
    
    
    
    $data['bulan'] = date('m');
    
  
    $this->load->view('guru/peringkat/view_peringkat',$data);
  }

function fetch_peringkat()
{
  $output = "";
  $data['m'] =  date('Y-m-d');
  $month = date('m',strtotime($data['m']));
  $cabang = $this->cabang;
  
  
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $data = $this->model_app->get_rank_guru($month,$cabang,$start,$limit);
  
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
       
              $output .="  
              <div class='col-1'><h3 class='mt-2'>".$rank."</h3></div>
            <div class='col-2 mr-1'><img src='".$pp."' class='rounded-circle' alt='Cinque Terre' style='width: 50px;height: 50px;'></div>
            <div></div>
            <div class='col-7'><h6>". ucfirst($row['nama_guru'])."</h6><label>".$row['email']."</label></div>
            <div class='col-1 text-left'><h6 class='mt-2'>". round($row['tot_poin'],2) ."</h6></div>
            <div class='col-12'><hr style='border-top: 1px solid #960001;'></div>
              
            ";
          $rank+= $rank;
      }

  }
  echo $output;
}
function pengaduan()
{
  if(isset($_POST['submit'])){

    $date = date('Y-m-d',strtotime($this->input->post('tanggal')));
    $ket =  $this->input->post('keterangan');
    $id = $this->session->userdata['guru']['id_guru'];
    if(!empty($_FILES['file']['name'])){

                  $config['upload_path'] =  './asset/foto_pengaduan/'; 
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['max_size'] = '20000';
                  $config['encrypt_name'] = TRUE;
                  $this->load->library('upload',$config); 
                  if ($this->upload->do_upload('file'))
                    {
                      $uploadData = $this->upload->data();
                      $file = $uploadData['file_name'];
                    

                   
                  }else{
                       $error = array('error' => $this->upload->display_errors());
                     $this->session->set_flashdata('message',$error['error']);
                     redirect('guru/pengaduan/');
                  }
                 
    }
    else{
      $file = "";
    }
    $data = array('id_guru'=>$id,'tanggal'=>$date,'keluhan'=>$ket,'foto'=>$file);
    $this->model_app->insert('pengaduan',$data);
    $this->session->set_flashdata('success','Pengaduan Berhasil Ditambah');
   redirect('guru/pengaduan/');

  

  }else{
      $data['title'] = title();
      $data['menu'] = "Pengaduan";
      $data['judul'] = "Pengaduan";
      $this->template->load(theme_base().'/template-back',theme_base().'/pengaduan/view_pengaduan',$data);
  }
}
  function lokasi()
  {
      $this->load->library('googlemaps');

      $lat = $this->input->post('lat');
      $long = $this->input->post('long');
            $config=array();
            $config['center']=$lat.",".$long;
            $config['zoom']=17;
            $config['map_height']="400px";
            $this->googlemaps->initialize($config);
            $marker=array();
            $marker['position']=$lat.",".$long;
            $this->googlemaps->add_marker($marker);
            $map=$this->googlemaps->create_map();
            

            echo $map['js'];
  }
  function chat(){
         $data['title'] =title();
      $data['menu'] = "Obrolan";
      $data['judul'] = "Obrolan";
      $this->load->view('guru/chat/view_chat',$data);
  }

function fetch_chat()
{

  $id = $this->session->userdata['guru']['id_guru'];
  $data = $this->db->query("SELECT * FROM chat a JOIN users b ON a.username = b.username WHERE a.id_guru = $id ORDER BY created_at ASC")->result();
  $update = $this->model_app->update('chat',array('read'=>'y'),array('alur'=>'admin-guru','id_guru'=>$id));
 

  

  
  echo json_encode($data);
}
function sendchat(){
  $id = $this->session->userdata['guru']['id_guru'];
  $chat = $this->input->post('chat');
  $tgl = date('Y-m-d');
  $time = date('H:i:s');
  $data = array('id_guru'=>$id,'username'=>'admin','chat'=>$chat,'tanggal'=>$tgl,'waktu'=>$time,'alur'=>'guru-admin','read'=>'n');
  $this->model_app->insert('chat',$data);
}
 function sub(){
    $id_bagian = $this->input->post('id_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian' => $id_bagian),'id_sub_bagian','DESC');
    $this->load->view('guru/view_sub_bagian',$data);    
  }
  function logout(){
    // cek_session_cabang();
    $this->session->set_userdata('referred_from', base_url('guru/home')); 
    $this->session->unset_userdata('guru');
    redirect('guru/login');
  }



    function kabupaten(){

    $id_prov = $this->input->post('id_prov');
    $data['kabupaten'] = $this->model_app->view_where_ordering('kabupaten',array('id_prov' => $id_prov),'id_kab','DESC');
    $this->load->view('guru/view_kabupaten',$data);    
  
  }
  function kabupaten1(){
  $data['id_kab'] = $this->input->post('id_kab');
    $id_prov = $this->input->post('id_prov');
    $data['kabupaten'] = $this->model_app->view_where_ordering('kabupaten',array('id_prov' => $id_prov),'id_kab','DESC');
    $this->load->view('guru/view_kabupaten1',$data);    
  
  }
  function kecamatan(){

    $id_kab = $this->input->post('id_kab');
    $data['kecamatan'] = $this->model_app->view_where_ordering('kecamatan',array('id_kab' => $id_kab),'id_kec','DESC');
    $this->load->view('guru/view_kecamatan',$data);    
  
  }
  function kelurahan(){

    $id_kec = $this->input->post('id_kec');
    $data['kelurahan'] = $this->model_app->view_where_ordering('kelurahan',array('id_kec' => $id_kec),'id_kel','DESC');
    $this->load->view('guru/view_kelurahan',$data);    
  
  }
  public function ajaxPro()
    {
        $query = $this->input->get('query');
        $this->db->select('*');
        $this->db->like('nama', $query);


        $hasil = $this->db->get("jenis_pekerjaan")->result();
         foreach ($hasil as $hsl)
            {
                
                  $data[] = array('nama' => $hsl->nama,
                         'id_pekerjaan' => $hsl->id_pekerjaan,
                
                );
            }
        echo json_encode($data);

        
    }
  function penerimaan_bpjs()
  {
  
    $data['record'] = $this->db->query("SELECT * FROM penerimaan_bpjs WHERE approved = 'n' AND approved_by = 0 ORDER BY id_pb DESC");
    $data['title'] = "PENERIMAAN BPJS YANG DIBAYARKAN - ".title();
    $data['judul'] = "PENERIMAAN BPJS YANG DIBAYARKAN";

   
    $this->template->load(theme_base().'/template-pelayanan',theme_base().'/kastem/view_penerimaan_bpjs',$data);
  }
    function detail_penerimaan_bpjs(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('penerimaan_bpjs',array('id_pb'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "PENERIMAAN BPJS YANG DIBAYARKAN -".title();
      $data['judul'] = "PENERIMAAN BPJS YANG DIBAYARKAN";
      $data['back']= base_url('guru/penerimaan_bpjs');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/kastem/view_detail_penerimaan_bpjs',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/datakastem');
    }
  }
  function datakastem()
  {
    if(isset($_POST['filter'])){
      $data['keyword'] = $this->input->post('keyword');
      
    }else{
      $data['keyword'] = "all";
     
    }
    $data['record'] = $this->model_app->data_kastem_no($data['keyword']);
    $data['title'] = "PENGAJUAN KASTEM, ANAK PUTUS SEKOLAH, DISABILITAS, DAN LANSIA - ".title();
    $data['judul'] = "PENGAJUAN KASTEM, ANAK PUTUS SEKOLAH, DISABILITAS, DAN LANSIA";

   
    $this->template->load(theme_base().'/template-pelayanan',theme_base().'/kastem/view_kastem',$data);
  }
  function detail_kastem(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('kastem',array('id_kastem'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL ASTEM, ANAK PUTUS SEKOLAH, DISABILITAS, DAN LANSIA - ".title();
      $data['judul'] = "DETAIL ASTEM, ANAK PUTUS SEKOLAH, DISABILITAS, DAN LANSIA";
      $data['back']= base_url('guru/datakastem');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/kastem/view_detail_kastem',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/datakastem');
    }
  }
     function pelayanan(){
   
        
   
         $data['title'] = 'PELAYANAN - '.title();
        $data['judul'] = 'PELAYANAN';
        $data['pelayanan'] = $this->model_app->view_ordering('pelayanan','pelayanan','ASC');
        //$this->template->load('user/template','user/pelayanan/view_pelayanan',$data); 
        $this->template->load(theme_base().'/template-pelayanan',theme_base().'/pelayanan/view_pelayanan',$data);
     
    
      

    }
   function sub_pelayanan(){
    $id_pelayanan = $this->input->post('id_pelayanan');
    $row = $this->model_app->view_where_ordering('sub_pelayanan',array('id_pelayanan'=>$id_pelayanan),'sub_pelayanan','ASC');
    if($row->num_rows() > 0){
      $data['record'] = $row;
      $this->load->view('guru/sub_pelayanan',$data);
    }else{
      $this->load->view('guru/submit_pelayanan');
    }
  }
  function approve()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('guru/pelayanan');
  }
  function disapprove()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('guru/pelayanan');
  }
  function approvebpjs()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('guru/penerimaan_bpjs');
  }
  function disapprovebpjs()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('guru/penerimaan_bpjs');
  }
  function approvekastem()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('guru/datakastem');
  }
  function disapprovekastem()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('guru/datakastem');
  }
   function approve_child()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);

     $data1 = array('approved'=>'y','approved_by'=>$peg);
    $where1 = array('id_parent'=>$id);
    $this->model_app->update($db,$data1,$where1);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('guru/pelayanan');
  }
  function disapprove_child()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);

    $data1 = array('approved'=>'n','approved_by'=>$peg);
    $where1 = array('id_parent'=>$id);
    $this->model_app->update($db,$data1,$where1);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('guru/pelayanan');
  }

  function jampersal()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN JAMPERSAL";
    $data['record'] = $this->db->query("SELECT * FROM jampersal WHERE approved = 'n' AND approved_by = 0 ORDER BY id_jampersal DESC");
    $this->load->view('guru/pelayanan/view_jampersal',$data);
  }
  function detail_jampersal(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('jampersal',array('id_jampersal'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL JAMPERSAL - ".title();
      $data['judul'] = "DETAIL JAMPERSAL";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_jampersal',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function ekonomi_lemah()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN EKONOMI LEMAH";
    $data['record'] = $this->db->query("SELECT * FROM ekonomi_lemah WHERE approved = 'n' AND approved_by = 0 ORDER BY id_el DESC");
    $this->load->view('guru/pelayanan/view_ekonomi_lemah',$data);
  }
  function detail_ekonomi_lemah(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('ekonomi_lemah',array('id_el'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL EKONOMI LEMAH - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN EKONOMI LEMAH";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_ekonomi_lemah',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function bpjs()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN TIDAK MAMPU";
    $data['record'] = $this->db->query("SELECT * FROM bpjs WHERE approved = 'n' AND approved_by = 0 AND id_parent = 0 ORDER BY id_bpjs DESC");
    $this->load->view('guru/pelayanan/view_bpjs',$data);
  }
  function detail_bpjs(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('bpjs',array('id_bpjs'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN KETERANGAN TIDAK MAMPU - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN TIDAK MAMPU";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_bpjs',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
 
  function izin_nikah()
  {
    $data['judul'] = "PENGAJUAN PENGANTAR NIKAH";
    $data['record'] = $this->db->query("SELECT * FROM izin_nikah WHERE approved = 'n' AND approved_by = 0  ORDER BY id_in DESC");
    $this->load->view('guru/pelayanan/view_izin_nikah',$data);
  }
  function detail_izin_nikah(){
    $id = $this->uri->segment('3');
    $cek = $this->db->query("SELECT * FROM izin_nikah a JOIN izin_orangtua b ON a.id_in = b.id_in WHERE a.id_in = ".$id." ");
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['yang_mengajukan'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN PENGANTAR NIKAH - ".title();
      $data['judul'] = "DETAIL PENGAJUAN PENGANTAR NIKAH";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_izin_nikah',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function belum_menikah()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN BELUM NIKAH";
    $data['record'] = $this->db->query("SELECT * FROM belum_menikah WHERE approved = 'n' AND approved_by = 0  ORDER BY id_bm DESC");
    $this->load->view('guru/pelayanan/view_belum_menikah',$data);
  }
   function detail_belum_menikah(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('belum_menikah',array('id_bm'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN BELUM MENIKAH - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN BELUM MENIKAH";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_belum_menikah',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
    function izin_mertua()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN IZIN MERTUA";
    $data['record'] = $this->db->query("SELECT * FROM izin_mertua WHERE approved = 'n' AND approved_by = 0  ORDER BY id_im DESC");
    $this->load->view('guru/pelayanan/view_izin_mertua',$data);
  }
   function detail_izin_mertua(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('izin_mertua',array('id_im'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['mertua'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN IZIN MERTUA - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN IZIN MERTUA";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_izin_mertua',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function wali_pernikahan()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN IZIN WALI";
    $data['record'] = $this->db->query("SELECT * FROM izin_wali WHERE approved = 'n' AND approved_by = 0  ORDER BY id_iw DESC");
    $this->load->view('guru/pelayanan/view_wali_pernikahan',$data);
  }
   function detail_izin_wali(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('izin_wali',array('id_iw'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['mempelai'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN IZIN WALI - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN IZIN WALI";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_izin_wali',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function domisili_usaha()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN DOMISILI USAHA ";
    $data['record'] = $this->db->query("SELECT * FROM usaha_dom  a JOIN usaha b ON a.id_usaha = b.id_usaha WHERE a.approved = 'n' AND a.approved_by = 0  AND b.approved = 'y' ORDER BY id_usaha_dom DESC");
    $this->load->view('guru/pelayanan/view_keterangan_dom_usaha',$data);
  }
   function detail_domisili_usaha(){
    $id = $this->uri->segment('3');
    $cek = $this->db->query("SELECT * FROM usaha_dom  a JOIN usaha b ON a.id_usaha = b.id_usaha WHERE  id_usaha_dom = ".$id."");
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN KETERANGAN DOMISILI USAHA - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN DOMISILI USAHA";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_dom_usaha',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
    function keterangan_usaha()
  {
     $data['judul'] = "PENGAJUAN KETERANGAN DOMISILI USAHA ";
    $data['record'] =$this->db->query("SELECT * FROM usaha WHERE approved = 'n' AND approved_by = 0  ORDER BY id_usaha DESC");
    $this->load->view('guru/pelayanan/view_keterangan_usaha',$data);
  }
   function detail_keterangan_usaha(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('usaha',array('id_usaha'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN KETERANGAN USAHA - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN USAHA";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_usaha',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
  function usaha_tidakberjalan()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN  USAHA ";
    $data['record'] = $this->db->query("SELECT * FROM usaha_tidak  a JOIN usaha b ON a.id_usaha = b.id_usaha WHERE a.approved = 'n' AND a.approved_by = 0  AND b.approved = 'y' ORDER BY id_ut DESC");
    $this->load->view('guru/pelayanan/view_keterangan_usaha_tidak',$data);
  }
   function detail_keterangan_usaha_tidak(){
    $id = $this->uri->segment('3');
    $cek =  $this->db->query("SELECT * FROM usaha_tidak  a JOIN usaha b ON a.id_usaha = b.id_usaha WHERE  id_ut = ".$id."");
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
      $data['title'] = "DETAIL PENGAJUAN KETERANGAN USAHA - ".title();
      $data['judul'] = "DETAIL PENGAJUAN KETERANGAN USAHA";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_usaha_tidak',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function approve_usaha()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);

    $data1 = array('status'=>'tidak');
    $where1 = array('id_usaha'=>$id);
    $this->model_app->update('usaha',$data1,$where1);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('guru/pelayanan');
  }
  function disapprove_usah()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['guru']['id_guru'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('guru/pelayanan');
  }
   function surat_kelahiran()
  {
     $data['judul'] = "PENGAJUAN SURAT KELAHIRAN ";
    $data['record'] =$this->db->query("SELECT * FROM surat_kelahiran WHERE approved = 'n' AND approved_by = 0  ORDER BY id_sk DESC");
    $this->load->view('guru/pelayanan/view_surat_kelahiran',$data);
  }
   function detail_surat_kelahiran(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('surat_kelahiran',array('id_sk'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
       
      $data['title'] = "DETAIL PENGAJUAN SURAT KELAHIRAN - ".title();
      $data['judul'] = "DETAIL PENGAJUAN SURAT KELAHIRAN";
      $data['back']= base_url('guru/pelayanan');
      $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_surat_kelahiran',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function surat_kematian()
  {
     $data['judul'] = "PENGAJUAN SURAT KEMATIAN ";
    $data['record'] =$this->db->query("SELECT * FROM surat_kematian WHERE approved = 'n' AND approved_by = 0  ORDER BY id_sk DESC");
    $this->load->view('guru/pelayanan/view_surat_kematian',$data);
  }
   function detail_surat_kematian(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('surat_kematian',array('id_sk'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN SURAT KEMATIAN - ".title();
        $data['judul'] = "DETAIL PENGAJUAN SURAT KEMATIAN";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_surat_kematian',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
  function keterangan_domisili(){

    $data['judul'] = "PENGAJUAN KETERANGAN DOMISILI ";
    $data['record'] =$this->db->query("SELECT * FROM keterangan_domisili WHERE approved = 'n' AND approved_by = 0  ORDER BY id_kd DESC");
    $this->load->view('guru/pelayanan/view_keterangan_domisili',$data);
  }
   function detail_keterangan_domisili(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('keterangan_domisili',array('id_kd'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN KETERANGAN DOMISILI- ".title();
        $data['judul'] = "DETAIL PENGAJUAN KETERANGAN DOMISILI";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_keterangan_domisili',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function surat_pindah_penduduk(){

    $data['judul'] = "PENGAJUAN KETERANGAN PINDAH PENDUDUK ";
    $data['record'] =$this->db->query("SELECT * FROM surat_pindah WHERE approved = 'n' AND approved_by = 0 AND id_parent = 0 ORDER BY id_sp DESC");
    $this->load->view('guru/pelayanan/view_surat_pindah_penduduk',$data);
  }
   function detail_surat_pindah_penduduk(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('surat_pindah',array('id_sp'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN KETERANGAN PINDAH PENDUDUK - ".title();
        $data['judul'] = "DETAIL PENGAJUAN KETERANGAN PINDAH PENDUDUK";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_surat_penduduk',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }

   function bepergian(){

    $data['judul'] = "PENGAJUAN KETERANGAN BEPERGIAN ";
    $data['record'] =$this->db->query("SELECT * FROM bepergian WHERE approved = 'n' AND approved_by = 0 ORDER BY id_bp DESC");
    $this->load->view('guru/pelayanan/view_bepergian',$data);
  }
   function detail_bepergian(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('bepergian',array('id_bp'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN KETERANGAN BEPERGIAN - ".title();
        $data['judul'] = "DETAIL PENGAJUAN KETERANGAN BEPERGIAN";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_bepergian',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function kehilangan(){

    $data['judul'] = "PENGAJUAN KETERANGAN HILANG/TERCECER ";
    $data['record'] =$this->db->query("SELECT * FROM kehilangan WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kehilangan DESC");
    $this->load->view('guru/pelayanan/view_kehilangan',$data);
  }
   function detail_kehilangan(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('kehilangan',array('id_kehilangan'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN KETERANGAN HILANG/TERCECER - ".title();
        $data['judul'] = "DETAIL PENGAJUAN KETERANGAN HILANG/TERCECER";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_kehilangan',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function kelakuan_baik(){

    $data['judul'] = "PENGAJUAN PENGANTAR KELAKUAN BAIK ";
    $data['record'] =$this->db->query("SELECT * FROM kelakuan_baik WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kb DESC");
    $this->load->view('guru/pelayanan/view_kelakuan_baik',$data);
  }
   function detail_kelakuan_baik(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('kelakuan_baik',array('id_kb'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN PENGANTAR KELAKUAN BAIK - ".title();
        $data['judul'] = "DETAIL PENGAJUAN PENGANTAR KELAKUAN BAIK";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_kelakuan_baik',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function penghasilan_ortu(){

    $data['judul'] = "PENGAJUAN PENGHASILAN ORANG TUA ";
    $data['record'] =$this->db->query("SELECT * FROM penghasilan_ortu WHERE approved = 'n' AND approved_by = 0 ORDER BY id_po DESC");
    $this->load->view('guru/pelayanan/view_penghasilan_ortu',$data);
  }
   function detail_penghasilan_ortu(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('penghasilan_ortu',array('id_po'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGHASILAN ORANG TUA - ".title();
        $data['judul'] = "DETAIL PENGHASILAN ORANG TUA";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_penghasilan_ortu',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
 function pindah_belajar(){

    $data['judul'] = "PENGAJUAN KETERANGAN PINDAH BELAJAR ";
    $data['record'] =$this->db->query("SELECT * FROM pindah_belajar WHERE approved = 'n' AND approved_by = 0 ORDER BY id_pb DESC");
    $this->load->view('guru/pelayanan/view_pindah_belajar',$data);
  }
   function detail_pindah_belajar(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('pindah_belajar',array('id_pb'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN KETERANGAN PINDAH BELAJAR - ".title();
        $data['judul'] = "DETAIL PENGAJUAN KETERANGAN PINDAH BELAJAR";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_pindah_belajar',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function keterangan_terlantar(){

    $data['judul'] = "PENGAJUAN KETERANGAN TERLANTAR ";
    $data['record'] =$this->db->query("SELECT * FROM keterangan_terlantar WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kt DESC");
    $this->load->view('guru/pelayanan/view_keterangan_terlantar',$data);
  }
   function detail_keterangan_terlantar(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('keterangan_terlantar',array('id_kt'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN KETERANGAN TERLANTAR - ".title();
        $data['judul'] = "DETAIL PENGAJUAN KETERANGAN TERLANTAR";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_keterangan_terlantar',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
   function keberatan_warga(){

    $data['judul'] = "PENGAJUAN PERNYATAAN KEBERATAN WARGA ";
    $data['record'] =$this->db->query("SELECT * FROM keberatan_warga WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kw DESC");
    $this->load->view('guru/pelayanan/view_keberatan_warga',$data);
  }
   function detail_keberatan_warga(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('keberatan_warga',array('id_kw'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
        $n = $row['nik'];
        $nik = explode("_", $n);
          if(isset($nik[1])){
              $warga = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
              $data['warga'] = $warga;
              $data['pekerjaan'] = $warga['pekerjaan'];
          }else{
              $warga = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
              $data['warga'] = $warga;
              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
              $data['pekerjaan'] = $per['pekerjaan'];
          }
        $data['title'] = "DETAIL PENGAJUAN PERNYATAAN KEBERATAN WARGA - ".title();
        $data['judul'] = "DETAIL PENGAJUAN PERNYATAAN KEBERATAN WARGA";
        $data['back']= base_url('guru/pelayanan');
        $this->template->load(theme_base().'/template_kembali',theme_base().'/pelayanan/view_detail_keberatan_warga',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('guru/pelayanan');
    }
  }
  function alokasiDanaDesa(){
    $data['title'] = title();
    $data['menu'] = 'ALOKASI DANA DESA';
    $data['sub']= 'TAHAP ALOKASI DANA DESA';
    
    $this->template->load(theme_base().'/template-new',theme_base().'/add/view_tahap',$data);
    
        

   
        
       
       
       

    

  }
  function dataTahap(){
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

            $output .= "<div class='col-12 bg-light my-1 tahap' data-id='".$this->encrypt->encode($row['id_tahap'],$this->key)."'>
                          <h5 class='p-2'>TAHAP ".$row['tahap']." ( ".strtoupper($row['tahap'])." )</h5>
                       </div>";
          }
          $output .= "</div></div>";
        }
    }else{
      $output = "<div class='col-12 py-3'><h5>Tidak ada alokasi dana desa</h5></div>";
    }

    echo $output;
  }
  function cekTahap(){
    $tahap = $this->encrypt->decode($this->input->post('id'),$this->key);
    $cek = $this->model_app->view_where('tahap_add',array('id_tahap'=>$tahap));
    if($cek->num_rows() > 0){
       echo base_url('guru/detailAlokasiDanaDesa?tahap=').$this->input->post('id');
    }else{
      echo false;
    }
  }
  function detailAlokasiDanaDesa(){
    $tahap = $this->input->get('tahap');
    $tahap = $this->encrypt->decode($tahap,$this->key);
    $cek = $this->model_app->view_where('tahap_add',array('id_tahap'=>$tahap));
    if($cek->num_rows () > 0){
            $row = $cek->row_array();
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            $data['id_sd'] = $this->encrypt->encode($cabang['id_sd'],$this->key);
            $data['row']= $row;
            $data['back'] = base_url('guru/alokasiDanaDesa');
            $data['key'] = $this->key;
            $data['title'] = 'TAHAP '.$row['tahap'].' '.$row['tahun']. ' - '.title();
            $data['menu'] = 'ALOKASI DANA DESA <br>TAHAP '.$row['tahap'].' TAHUN '.$row['tahun'];
            $this->template->load(theme_base().'/template-newback',theme_base().'/add/view_tahap_detail',$data);
       
    }else{
        $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
        redirect('guru/alokasiDanaDesa');
    }
  }
  function addAlokasiDanaDesa(){
     $thp = $this->input->get('tahap');
    $tahap = $this->encrypt->decode($thp,$this->key);
    $data['tahap'] = $thp;
    $cek = $this->model_app->view_where('tahap_add',array('id_tahap'=>$tahap));
    if($cek->num_rows () > 0){
            $row = $cek->row_array();
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            $data['id_sd'] = $cabang['id_sd'];
            $data['row']= $row;
            $data['back'] = base_url('guru/detailAlokasiDanaDesa?tahap=').$thp;
            $data['key'] = $this->key;
            $data['status'] = $this->input->get('status');
            $data['id_parent'] = $this->input->get('id_parent');
            $data['id_sub_parent'] = $this->input->get('id_sub_parent');

            $data['title'] = 'TAHAP '.$row['tahap'].' '.$row['tahun']. ' - '.title();
            $data['menu'] = 'ALOKASI DANA DESA <br>TAHAP '.$row['tahap'].' TAHUN '.$row['tahun'];
            $data['bidang'] = $this->model_app->view_where_ordering('kode_rekening',array('status'=>'bidang'),'kode_rekening','ASC');
            $this->template->load(theme_base().'/template-newback',theme_base().'/add/view_add_alokasi',$data);
       
    }else{
        $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
        redirect('guru/alokasiDanaDesa');
    }
  }

  function doAddAlokasiDanaDesa(){

    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $status = $this->input->post('status');
    $parent = $this->input->post('id_parent');
    $id_parent = $this->encrypt->decode($parent,$this->key);

    $thp = $this->input->post('id_tahap');
    $tahap = $this->encrypt->decode($thp,$this->key);
    $kode_rekening= $this->input->post('kode_rekening');
    $me = $this->session->userdata['guru']['id_guru'];
    $cek= $this->model_app->view_where('alokasi_dana_desa',array('id_sd'=>$id_sd,'id_tahap'=>$tahap,'kode_rekening'=>$kode_rekening));
    if($cek->num_rows() > 0){
      $sts = false;
    }else{

      $sts = true;
      if($status == 'parent'){

        $data = array('id_tahap'=>$tahap,'id_sd'=>$id_sd,'kode_rekening'=>$kode_rekening,'kegiatan'=>'parent','approve_pengawas'=>'y','created_by'=>$me,'uraian'=>$this->input->post('uraian'));
      }else if($status == 'sub_parent'){
          if($kode_rekening =='null'){
            $data = array('id_tahap'=>$tahap,'id_parent'=>$id_parent,'id_sd'=>$id_sd,'kode_rekening'=>NULL,'kegiatan'=>$this->input->post('kegiatan'),'approve_pengawas'=>'p','created_by'=>$me,'uraian_output'=>$this->input->post('uraian_output'),'uraian'=>$this->input->post('uraian'),'volume_output'=>$this->input->post('volume_output'),'cara_pengadaan'=>$this->input->post('cara_pengadaan'),'anggaran'=>str_replace('.','',$this->input->post('anggaran')),'status'=>'p');
          }else{
             $data = array('id_tahap'=>$tahap,'id_parent'=>$id_parent,'id_sd'=>$id_sd,'kode_rekening'=>$kode_rekening,'kegiatan'=>'parent','approve_pengawas'=>'y','created_by'=>$me,'uraian'=>$this->input->post('uraian'));
          }
      }else{
        if($kode_rekening == 'null'){
            $korek = null;
        }else{
          $korek = $kode_rekening;
        }
         $data = array('id_tahap'=>$tahap,'id_parent'=>$id_parent,'id_sd'=>$id_sd,'kode_rekening'=>$korek,'kegiatan'=>$this->input->post('kegiatan'),'approve_pengawas'=>'p','created_by'=>$me,'uraian_output'=>$this->input->post('uraian_output'),'uraian'=>$this->input->post('uraian'),'volume_output'=>$this->input->post('volume_output'),'cara_pengadaan'=>$this->input->post('cara_pengadaan'),'anggaran'=>str_replace('.','',$this->input->post('anggaran')),'id_sub_parent'=>$this->encrypt->decode($this->input->post('id_sub_parent'),$this->key),'status'=>'p');
        
        
      }
      $this->model_app->insert('alokasi_dana_desa',$data);
    } 
    echo $sts;

  }
  function selectBidang(){
    $id_tahap = $this->encrypt->decode($this->input->post('id_tahap'),$this->key);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];

    $data =  $this->model_app->view_where_ordering('kode_rekening',array('status'=>'bidang'),'kode_rekening','ASC');
    foreach($data->result_array() as $row){
                    $cek = $this->model_app->view_where('alokasi_dana_desa',array('id_tahap'=>$id_tahap,'id_sd'=>$id_sd,'kode_rekening'=>$row['kode_rekening']));
                      if($cek->num_rows() > 0){

                      }else{
                         echo "<option value='".$row['kode_rekening']."' data-text='".$row['keterangan']."' style='font-size:12px'>".$row['keterangan']."</option>";
                      }
    }
  }
  function selectSubParent(){
    $id_tahap = $this->encrypt->decode($this->input->post('id_tahap'),$this->key);
    $id_parent =$this->input->post('id_parent');
    $id_sub_parent =$this->encrypt->decode($this->input->post('id_sub_parent'),$this->key);

    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $output = "";
    $data = $this->model_app->view_where('alokasi_dana_desa',array('id_tahap'=>$id_tahap,'id_sd'=>$id_sd,'id_parent'=>$id_parent,'id_sub_parent'=>NULL,'kode_rekening !='=>NULL));
    foreach($data->result_array() as $row){
          $idParent = $this->encrypt->encode($row['id_add'],$this->key);
          
            $output .= "<option value='".$row['id_add']."' data-text='".$row['uraian']."' data-kode ='".$row['kode_rekening']."' style='font-size:12px'>".$row['uraian']."</option>";
          
          
                      
    }
    $arr = array('id_sub_parent'=>$id_sub_parent,'output'=>$output);
    echo json_encode($arr);
  }
  function selectParent(){
    $id_tahap = $this->encrypt->decode($this->input->post('id_tahap'),$this->key);
    $id_parent =$this->encrypt->decode($this->input->post('id_parent'),$this->key);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $output = "";
    $data = $this->model_app->view_where('alokasi_dana_desa',array('id_tahap'=>$id_tahap,'id_sd'=>$id_sd,'id_parent'=>NULL,'id_sub_parent'=>NULL,'kegiatan'=> 'parent'));
    foreach($data->result_array() as $row){
          $idParent = $this->encrypt->encode($row['id_add'],$this->key);
          
            $output .= "<option value='".$row['id_add']."' data-text='".$row['uraian']."' data-kode ='".$row['kode_rekening']."' style='font-size:12px'>".$row['uraian']."</option>";
          
          
                      
    }
    $arr = array('id_parent'=>$id_parent,'output'=>$output);
    echo json_encode($arr);
  }
  function selectKodeRekening(){
    $id_parent = $this->input->post('id_parent');
    $id_tahap = $this->encrypt->decode($this->input->post('id_tahap'),$this->key);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $data = $this->db->query("SELECT * FROM kode_rekening WHERE kode_rekening LIKE '".$id_parent."%' AND status ='sub_bidang' ORDER BY kode_rekening ASC ");
    echo "<option value='null' style='font-size:12px'>Tidak Ada</option>";
    foreach($data->result_array() as $row){
       $cek = $this->model_app->view_where('alokasi_dana_desa',array('id_tahap'=>$id_tahap,'id_sd'=>$id_sd,'kode_rekening'=>$row['kode_rekening']));
                      if($cek->num_rows() > 0){

                      }else{
                        echo "<option value='".$row['kode_rekening']."' data-token='".$this->encrypt->encode($row['kode_rekening'],$this->key)."' style='font-size:12px' data-text='".$row['keterangan']."'>".$row['kode_rekening']." - ".$row['keterangan']."</option>";
                      }
      
    }
  }
  function selectKodeRekening1(){
    $id_parent = $this->input->post('id_sub_parent');
    $id_tahap = $this->encrypt->decode($this->input->post('id_tahap'),$this->key);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $data = $this->db->query("SELECT * FROM kode_rekening WHERE kode_rekening LIKE '".$id_parent."%' AND status ='sub_kegiatan' ORDER BY kode_rekening ASC ");
    echo "<option value='null' style='font-size:12px'>Tidak Ada</option>";
    foreach($data->result_array() as $row){
       $cek = $this->model_app->view_where('alokasi_dana_desa',array('id_tahap'=>$id_tahap,'id_sd'=>$id_sd,'kode_rekening'=>$row['kode_rekening']));
                      if($cek->num_rows() > 0){

                      }else{
                        echo "<option value='".$row['kode_rekening']."' data-token='".$this->encrypt->encode($row['kode_rekening'],$this->key)."' style='font-size:12px' data-text='".$row['keterangan']."'>".$row['kode_rekening']." - ".$row['keterangan']."</option>";
                      }
      
    }
  }

  function dataAlokasi(){
    $tahap = $this->encrypt->decode($this->input->post('tahap'),$this->key);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];

    $data = $this->model_app->view_where_ordering('alokasi_dana_desa',array('id_sd'=>$id_sd,'id_tahap'=>$tahap,'id_parent'=>NULL),'kode_rekening','ASC');
    $output ='
          <div class="col-12 mb-3"> <button class="btn btn-outline-info btnAdd"><i class="ri-add-line"></i> TAMBAH BIDANG</button></div>
        ';
    foreach($data->result_array() as $row){
      $output .= "<div class='col-12 mb-2 bg-light p-3'>
                    <div class='row justify-content-center'>
                        <div class='col-9 '><h6 class='text-dark'>".$row['kode_rekening'].". ".$row['uraian']."</h6></div>
                        <div class='col-2 '><button class='float-right btn btn-outline-info btnAddSP' data-status='sub-parent' data-parent='".$this->encrypt->encode($row['id_add'],$this->key)."'><i class='ri-add-line'></i></button></div>
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
           $output .= "<div class='col-12 mb-2 bg-light p-3 addProses' data-id='".$this->encrypt->encode($sRow['id_add'],$this->key)."' data-tahap='".$this->encrypt->encode($sRow['id_tahap'],$this->key)."'>
                    <div class='row justify-content-center'>
                        <div class='col-1'><i class='ri-arrow-right-s-line'></i></div>
                        <div class='col-8 '><h6 class='text-dark mb-0'>".$sRow['uraian']." </h6><small>".$app."</small></div>
                        <div class='col-2 '>".$sts."</div>
                    </div>
                 </div>";
          
          
          
         
        }else{
           $output .= "<div class='col-12 mb-2 bg-light p-3'>
                    <div class='row justify-content-center'>
                        <div class='col-1'><i class='ri-arrow-right-s-line'></i></div>
                        <div class='col-8 '><h6 class='text-dark'>".$sRow['kode_rekening'].". ".$sRow['uraian']."</h6></div>
                        <div class='col-2 '><button class='float-right btn btn-outline-info btnAddChild' data-status='sub-parent' data-parent='".$this->encrypt->encode($row['id_add'],$this->key)."' data-subparent='".$this->encrypt->encode($sRow['id_add'],$this->key)."'><i class='ri-add-line'></i></button></div>
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
              $output .= "<div class='col-12 mb-2 bg-light p-3 addProses' data-id='".$this->encrypt->encode($cRow['id_add'],$this->key)."' data-tahap='".$this->encrypt->encode($cRow['id_tahap'],$this->key)."'>
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
  function detailADD(){
      $id = $this->input->get('id');
      $id_add= $this->encrypt->decode($id,$this->key);
      $tahap = $this->encrypt->decode($this->input->get('tahap'),$this->key);
     $id_tahap = $this->encrypt->encode($tahap,$this->key);
      $cek = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$id_add,'approve_pengawas'=>'y'));
      if($cek->num_rows() > 0){
        $row = $cek->row_array();
        $data['row'] = $cek->row_array();
        $data['id'] = $id;
        $data['tahap'] = $id_tahap;
        $data['key'] = $this->key;
        $data['title'] = $row['uraian_output'].' - '.title();
        $data['menu'] = strtoupper($row['uraian_output']);
        $data['back'] = base_url('guru/detailAlokasiDanaDesa?tahap='.$id_tahap);
        $this->template->load(theme_base().'/template-newback',theme_base().'/add/view_proses_add',$data);

      }else{
       
        $this->session->set_flashdata('message','Alokasi Dana Desa Belum Disetujui');
        redirect('guru/detailAlokasiDanaDesa?tahap='.$id_tahap);
      }
  }
  function dataProses(){
    $id = $this->input->post('id_add');
    $id_add =$this->encrypt->decode($id,$this->key);
    $data = $this->model_app->view_where('persentase_add',array('id_add'=>$id_add));
    $output = "<div class='col-12 p-2'>
                      <div class='row'>
                          <div class='col-2'><h6 class='text-dark' style='font-size:0.7rem'>PERSENTASE</h6></div>
                          <div class='col-5'><h6 class='text-dark' style='font-size:0.7rem'>KETERANGAN</h6></div>
                          <div class='col-3'><h6 class='text-dark' style='font-size:0.7rem'>guru</h6></div>
                          <div class='col-2'><h6 class='text-dark' style='font-size:0.7rem'>STATUS</h6></div>


                      </div>
                  </div>";
    foreach($data->result_array() as $row){
      $peg = $this->model_app->view_where('guru',array('id_guru'=>$row['id_guru']))->row_array();
      if($row['status_laporan'] == 'y'){
        $status = '<i class="ri-check-double-line"></i>';
        $text = 'text-success';
      }elseif($row['status_laporan'] =='p'){
        $status = '<i class="ri-timer-line"></i>';
        $text = 'text-warning';

      }else{
        $status = '<i class="ri-close-line"></i>';
        $text = 'text-danger';

      }
      $output .= "<div class='col-12 p-2'>
                      <div class='row'>
                          <div class='col-2'><h3 class='".$text."'>".$row['persentase']."%</h3></div>
                          <div class='col-5'><h6 class='".$text."'>".$row['keterangan']."</h6></div>
                          <div class='col-3'><h6 class='".$text."'>".$peg['nama_panggilan']."</h6></div>
                          <div class='col-2'><h3 class='".$text."'>".$status."</h3></div>


                      </div>
                  </div>";
    }
    echo $output;
  }
  function doAddProses(){
    $id_add = $this->encrypt->decode($this->input->post('id_add'),$this->key);
    $keterangan = $this->input->post('keterangan');
    $persentase = $this->input->post('persentase');
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    $id_sd = $cabang['id_sd'];
    $me = $this->session->userdata['guru']['id_guru'];
    $kegiatan = $this->input->post('kegiatan');
    if($kegiatan == 'fisik'){
    $config['upload_path']          = './asset/foto_proses/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 20000;
    $config['encrypt_name'] = TRUE;
                
    $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('file')){
          echo false;

      }else{
         echo true;

         $f = $this->upload->data();
         $realisasi = $this->input->post('realisasi');
         $output = $this->input->post('output');
          if($output){
          $output_q = $output;
         }else{
          $output_q = NULL;
         }
         if($realisasi){
          $real = str_replace('.','',$realisasi);
         }else{
          $real = NULL;
         }

         $foto = $f['file_name'];
         $data = array('id_add'=>$id_add,'id_sd'=>$id_sd,'id_guru'=>$me,'keterangan'=>$keterangan,'foto_laporan'=>$foto,'approve_pengawas'=>NULL,'status_laporan'=>'p','persentase'=>$persentase,'realisasi'=>$real,'output'=>$output_q);
         $this->model_app->insert('persentase_add',$data);

      }
    }else{
      $config['upload_path']          = './asset/foto_proses/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 20000;
    $config['encrypt_name'] = TRUE;
                
    $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('file')){
         $foto = null;

      }else{
         

         $f = $this->upload->data();
         
         $foto = $f['file_name'];
        

      }
      $realisasi = $this->input->post('realisasi');
         if($realisasi){
          $real = str_replace('.','',$realisasi);
         }else{
          $real = NULL;
         }
         $output = $this->input->post('output');
          if($output){
          $output_q = $output;
         }else{
          $output_q = NULL;
         }
 $data = array('id_add'=>$id_add,'id_sd'=>$id_sd,'id_guru'=>$me,'keterangan'=>$keterangan,'foto_laporan'=>$foto,'approve_pengawas'=>NULL,'status_laporan'=>'p','persentase'=>$persentase,'realisasi'=>$real,'output'=>$output_q);
         $this->model_app->insert('persentase_add',$data);
         echo true;
    }
  }
}
