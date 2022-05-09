<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pegawai extends CI_Controller {

function __construct() {
    parent::__construct();
     date_default_timezone_set('Asia/Makassar');
     $this->session->unset_userdata('referred_from');
     $this->session->set_userdata('referred_from', current_url()); 
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
         if($cabang['status'] != 'dinas'){
           exit();
         }
    $this->key = "aplikasidatakepegawaianENCRYPTION30224923912";
  cek_session_cabang($cabang['id_sd']);
}
 function index(){
 
  redirect('pegawai/home');
      
}
function cekSess(){
  var_dump($this->session->userdata['pegawai']['id_sd']);
}
function home(){
  $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
  cek_session_cabang($cabang['id_sd']);
$data['title'] = title();
$bulan = date('m');
$data['datakerja'] = $this->model_app->view_where('harikerja',array('bulan'=>$bulan,'tahun'=>date('Y')));
$this->template->load(base_theme().'/template',base_theme().'/content',$data);
}
function dataCalendar(){

  $data = $this->model_app->view_where('harikerja',array('tahun'=>date('Y')));
 
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
             $jamkerja = $this->model_app->view_where('shift',array('hari'=>$h));
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
         
 
           
           $arr[] = array('id'=>$row['id_harikerja'],
                     
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
function absensi()
{

    $data['title'] = title();
    $data['menu'] = 'Absensi';
    $d = date('j');
    $m = date('m');
    $y = date('Y');
    $tanggal = date('Y-m-d');
    $id = $this->session->userdata['pegawai']['id_pegawai'];
    $cek = $this->model_app->view_where('harikerja',array('tanggal'=>$d,'bulan'=>$m,'tahun'=>$y))->row_array();
    $form = $this->db->query("SELECT * FROM `form_izin` WHERE ('$tanggal' BETWEEN dari AND sampai ) AND `id_pegawai` = $id AND approved='setuju' AND status_form = 'guru'  ")->num_rows();
    
    if($cek['status']=='libur'){
      $this->session->set_flashdata('message', 'Anda tidak bisa absen, hari ini hari libur!');
      $data['access'] = 'n';
    }elseif($form > 0){
      $this->session->set_flashdata('message', 'Form Ijin / Sakit anda masih berlaku!');
      $data['access'] ='n';
      

    }else{
      $hari= hari_ini(date('w'));
      $shift = $this->model_app->view_where('shift',array('hari'=>$hari))->row_array();
      $masuk = date('H:i:s',strtotime($shift['shift_masuk']));
      $keluar =  date('H:i:s',strtotime($shift['shift_keluar']));
      $jam = date('H:i:s');
      $bts = date('H:i:s',strtotime($shift['shift_masuk']."-120 Minutes"));
      if($bts <= $jam){
       $data['access'] = 'y';
      }else{
        $data['access'] = 'n';
      }
   
       

      $data['absen'] = $this->model_app->view_where('absensi',array('tanggal'=>$tanggal,'id_pegawai'=>$id,'status_absen'=>'pegawai'));
    

    }
  
    
    $this->template->load(base_theme().'/template-content',base_theme().'/absen/view_absensi',$data);
}
function fetch_absen()
{
  $output = "";
  $id = $this->session->userdata['pegawai']['id_pegawai'];
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $data = $this->model_app->view_where_ordering_limit('absensi',array('id_pegawai'=>$id,'status_absen'=>'pegawai'),'id_absensi','DESC',$start,$limit);
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
  $id = $this->uri->segment('3');
  $data['row'] = $this->model_app->view_where('absensi',array('id_absensi'=>$id))->row_array();
  $data['title'] = title();
  $data['judul'] = "Detail Absensi";
  $this->load->view('pegawai/absen/view_absensi_detail',$data);
}
function inputabsen()
{
   
    $id = $this->session->userdata['pegawai']['id_pegawai'];
   
    $peg = $this->model_app->view_where('pegawai',array('id_pegawai'=>$id))->row_array();
    if($peg['sub_kegiatan'] == 0){
      $this->session->set_flashdata('message','Sub Kegiatan anda masih kosong!');
      redirect('pegawai/absensi');
    }else{
        $sub = $this->model_app->view_where('sub_kegiatan',array('id_sub_kegiatan'=>$peg['sub_kegiatan']))->row_array();
        if($sub['target_lat'] == "" OR $sub['target_long']==""){
          $this->session->set_flashdata('message','Lokasi Absensi Sub Kegiatan belum ditentukan!');
          redirect('pegawai/absensi');
        }else{

        $data['target_lat'] = $sub['target_lat'];
        $data['target_long'] = $sub['target_long'];
        $data['title'] = title();
        $data['judul'] = "Absensi";
        $tanggal = date('Y-m-d');
        $data['absen'] = $this->model_app->view_where('absensi',array('tanggal'=>$tanggal,'id_pegawai'=>$id,'status_absen'=>'pegawai'));
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("https://ipinfo.io/$ip/json"));
        $loc =  $details->loc; // -> "Mountain View"
        $lok =explode(',', $loc);
        $data['lat'] = $lok[0];
        $data['long'] = $lok[1];
        $this->template->load(base_theme().'/template-back',base_theme().'/absen/view_do_absen',$data);
      }
    }

  
}
function do_absen()
{
  $status = $this->input->post('status');

  if($status == 'masuk')
  {             $tgl = date('Y-m-d');
                $id_peg = $this->session->userdata['pegawai']['id_pegawai'];
                $abs_cek = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $id_peg AND tanggal = '$tgl'")->num_rows();
                if($abs_cek > 0){
                  $this->session->set_flashdata('message','Anda Sudah Absen Hari Ini!');
                  redirect('pegawai/absensi');
                }else{
                $config['upload_path']          = './asset/foto_absen/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 10000;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto')){
                
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('pegawai/absensi');
                }else{
                  $foto = $this->upload->data();
                  $h = hari_ini(date('w'));
                  $cek = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
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
                $data = array('id_pegawai'=>$this->session->userdata['pegawai']['id_pegawai'],
                        'tanggal'=>$tanggal,
                        'absen_masuk'=>$time,
                        
                        'ip'=>$ip,
                        'longitude_in'=>$this->input->post('long'),
                        'latitude_in'=>$this->input->post('lat'),
                        'foto_masuk'=>base_url('asset/foto_absen/').$foto['file_name'],
                        'telat'=>$telat,
                        'pulang_awal'=>'n',
                        'ket'=>$this->input->post('ket'),
                        'status_absen'=>'pegawai'
                     );
                $this->model_app->insert('absensi',$data);

                $poin = array('id_pegawai'=>$this->session->userdata['pegawai']['id_pegawai'],'tanggal'=>$tanggal,'poin'=>$poin);
                $this->model_app->insert('poin_pegawai',$poin);
                redirect('pegawai/absensi');
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
             redirect('pegawai/absensi');
                }else{
                  $foto = $this->upload->data();
                  $h = hari_ini(date('w'));
                  $cek = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
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

                    
                  $data = array('id_pegawai'=>$this->session->userdata['pegawai']['id_pegawai'],
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


                  redirect('pegawai/absensi');
            
          }
  }
}

function form()
{
  $data['title'] = title();
    $data['menu'] = 'Form Ijin/Sakit';
    $id = $this->session->userdata['pegawai']['id_pegawai'];
     
    $this->template->load(base_theme().'/template-content',base_theme().'/form/view_form',$data);
}

function inputform()
{
  $data['title'] = title();
  $data['judul'] = "Ajukan Form";
  $tanggal = date('Y-m-d');
 
  $this->template->load(base_theme().'/template-back',base_theme().'/form/view_form_add',$data);

}
function detailform()
{
  $id = $this->uri->segment('3');
    $data['row'] = $this->model_app->view_where('form_izin',array('id_form'=>$id))->row_array();
  $data['title'] = title();
  $data['judul'] = "Detail Form";
  $this->load->view('pegawai/form/view_form_detail',$data);

}
function fetch_form()
{
  $output = "";
  $id = $this->session->userdata['pegawai']['id_pegawai'];
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
   $data = $this->model_app->view_where_ordering_limit('form_izin',array('id_pegawai'=>$id,'status_form'=>'pegawai'),'id_form','DESC',$start,$limit);

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
  $id = $this->session->userdata['pegawai']['id_pegawai'];
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $date = $this->input->post('date');
    $data = $this->model_app->view_where_ordering_limit('report',array('id_pegawai'=>$id,'date'=>$date,'status_report'=>'pegawai'),'id_report','DESC',$start,$limit);
  

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
        
          $data['totalFiles'][] = $images;
          $uploadData = $this->upload->data();
          $images[] = $uploadData['file_name'];
          }

   
      }
         $fileName = implode(';',$images);
            $foto = str_replace(' ','_',$fileName);
           
    
          if(trim($foto)!=''){
              
          
             $id = $this->session->userdata['pegawai']['id_pegawai'];
            $dari = date('Y-m-d',strtotime($this->input->post('dari')));
            $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
            $data = array('id_pegawai'=>$id,'keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'),'foto'=>base_url('asset/foto_form/').$foto,'approved'=>'proses','status_form'=>'pegawai');
            $this->db->insert('form_izin',$data);
            $this->session->set_flashdata('success','Formulir berhasil diinput!');
        

            
          }else{
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             
             
          }
        }else{
              $id = $this->session->userdata['pegawai']['id_pegawai'];
            $dari = date('Y-m-d',strtotime($this->input->post('dari')));
            $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
            $data = array('id_pegawai'=>$id,'keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'),'approved'=>'proses','status_form'=>'pegawai');
            $this->db->insert('form_izin',$data);
            $this->session->set_flashdata('success','Formulir berhasil diinput!');
          }
     $tgl1 = strtotime($dari); 
    $tgl2 = strtotime($sampai); 

    $jarak = $tgl2 - $tgl1;

      $hari = $jarak / 60 / 60 / 24+1;
    $peg = $this->model_app->view_where('pegawai',array('id_pegawai'=>$id))->row_array();
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


            redirect('pegawai/form');
        
          
           
       
  
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
    $data['title'] = title();
    $data['menu'] = "Report";
   
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

    $this->template->load(base_theme().'/template-content',base_theme().'/report/view_report',$data);
   

  }
        
function inputreport()
{
$data['title'] = title();
  $data['judul'] = "TAMBAH REPORT";

  $id = $this->session->userdata['pegawai']['id_pegawai'];
  $tgl = date('Y-m-d');
  $cek  = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $id AND tanggal = '$tgl'");
  if($cek->num_rows() > 0){
    $this->template->load(base_theme().'/template-back',base_theme().'/report/view_report_add',$data);

  }else{
     $this->session->set_flashdata('message','Anda Belum Absen!');
  redirect('pegawai/absensi');
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
  
    $id = $this->session->userdata['pegawai']['id_pegawai'];

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
    
    $data = array('id_pegawai'=>$id,'judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'date'=>$date,'jam_kerja'=>'0','foto_masuk'=>base_url('asset/foto_report/').$foto,'status_report'=>'pegawai');
    $this->db->insert('report',$data);
    $this->session->set_flashdata('success','Report berhasil diinput!');
    redirect('pegawai/report');
    }else{
          $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('pegawai/report');
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
            $id_peg  = $this->session->userdata['pegawai']['id_pegawai'];
            $tanggal = date('Y-m-d');
            $p = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$date,'id_pegawai'=>$id_peg))->row_array();
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

            redirect('pegawai/report');
        

            
          }
          else{
                 $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('message',$error['error']);
             redirect('pegawai/report');
             
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
    $this->load->view('pegawai/report/view_report_detail',$data);


    
   }
  function download()
  {

    $status = $this->uri->segment('3');
    $id = $this->session->userdata['pegawai']['id_pegawai'];
    if($status == 'harian'){
      $data['row'] = $this->db->query("SELECT * FROM pegawai a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_pegawai = $id")->row_array();
        $this->load->helper('dompdf');
      $html = $this->load->view('pegawai/download/download_pdf',$data,true);
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
      $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$m' AND MONTH(sampai) = '$m' AND YEAR(dari) = '$y' AND YEAR(sampai) = '$y' AND id_pegawai = $id ");
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


      $data['row'] = $this->db->query("SELECT * FROM pegawai a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_pegawai = $id")->row_array();
      
        $this->load->helper('dompdf');
      $html = $this->load->view('pegawai/download/download_pdf_m',$data,true);
    
 
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
        $form = $this->db->query("SELECT * FROM form_izin WHERE YEAR(dari) = '$y' AND YEAR(sampai) = $y AND id_pegawai = $id");
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

      $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE YEAR(date)=$y AND id_pegawai = $id")->row_array();

      $data['jumlah_kerja'] = $rep['tot'];
      $data['lama_kerja'] = $rep['tot_jam'];
      
        $data['row'] = $this->db->query("SELECT * FROM pegawai a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_pegawai = $id")->row_array();
      
       
      
       $this->load->helper('dompdf');
      $html = $this->load->view('pegawai/download/download_pdf_y',$data,true);
    
 
    //load content html
        
       
          // create pdf using dompdf
          $filename = 'LEMBAR-KERJA-TAHUN-'.$y.'-NON-ASN';
          $paper = 'A4';
          $orientation = 'potrait';
          pdf_create($html, $filename, $paper, $orientation);


    }else{


    $data['title'] = title();
    $data['menu'] = "Download";
    
    $this->template->load(base_theme().'/template-content',base_theme().'/download/view_download',$data);
    }
  }

  function peringkat(){
  $data['title'] = title();
    $data['menu'] = "Peringkat";
    
    
    
    $data['bulan'] = date('m');
    
  
    $this->load->view('pegawai/peringkat/view_peringkat',$data);
  }

function fetch_peringkat()
{
  $output = "";
  $data['m'] =  date('Y-m-d');
  $month = date('m',strtotime($data['m']));
  // $sub = $this->session->sub_bagian;
  
  $limit = $this->input->post('limit');
  $start = $this->input->post('start');
  $data = $this->model_app->get_rank($month,$start,$limit);
  
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
              <div class='col-1'><h3 class='mt-2'>".$rank."</h3></div>
            <div class='col-2 mr-1'><img src='".$pp."' class='rounded-circle' alt='Cinque Terre' style='width: 50px;height: 50px;'></div>
            <div></div>
            <div class='col-7'><h6>". ucfirst($row['nama_lengkap'])."</h6><label style='font-size:12px;'>".$bag['nama_sub_bagian']."</label></div>
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
    $id = $this->session->userdata['pegawai']['id_pegawai'];
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
                     redirect('pegawai/pengaduan/');
                  }
                 
    }
    else{
      $file = "";
    }
    $data = array('id_pegawai'=>$id,'tanggal'=>$date,'keluhan'=>$ket,'foto'=>$file);
    $this->model_app->insert('pengaduan',$data);
    $this->session->set_flashdata('success','Pengaduan Berhasil Ditambah');
   redirect('pegawai/pengaduan/');

  

  }else{
      $data['title'] = title();
      $data['menu'] = "Pengaduan";
      $data['judul'] = "Pengaduan";
      $this->template->load(base_theme().'/template-back',base_theme().'/pengaduan/view_pengaduan',$data);
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
      $this->load->view('pegawai/chat/view_chat',$data);
  }

function fetch_chat()
{

  $id = $this->session->userdata['pegawai']['id_pegawai'];
  $data = $this->db->query("SELECT * FROM chat a JOIN users b ON a.username = b.username WHERE a.id_pegawai = $id ORDER BY created_at ASC")->result();
  $update = $this->model_app->update('chat',array('read'=>'y'),array('alur'=>'admin-pegawai','id_pegawai'=>$id));
 

  

  
  echo json_encode($data);
}
function sendchat(){
  $id = $this->session->userdata['pegawai']['id_pegawai'];
  $chat = $this->input->post('chat');
  $tgl = date('Y-m-d');
  $time = date('H:i:s');
  $data = array('id_pegawai'=>$id,'username'=>'admin','chat'=>$chat,'tanggal'=>$tgl,'waktu'=>$time,'alur'=>'pegawai-admin','read'=>'n');
  $this->model_app->insert('chat',$data);
}
 function sub(){
    $id_bagian = $this->input->post('id_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian' => $id_bagian),'id_sub_bagian','DESC');
    $this->load->view('pegawai/view_sub_bagian',$data);    
  }
  function logout(){
    // cek_session_cabang();
    $this->session->set_userdata('referred_from', base_url('pegawai/home')); 
    $this->session->unset_userdata('pegawai');
    redirect('auth/loginpegawai');
  }



    function kabupaten(){

    $id_prov = $this->input->post('id_prov');
    $data['kabupaten'] = $this->model_app->view_where_ordering('kabupaten',array('id_prov' => $id_prov),'id_kab','DESC');
    $this->load->view('pegawai/view_kabupaten',$data);    
  
  }
  function kabupaten1(){
  $data['id_kab'] = $this->input->post('id_kab');
    $id_prov = $this->input->post('id_prov');
    $data['kabupaten'] = $this->model_app->view_where_ordering('kabupaten',array('id_prov' => $id_prov),'id_kab','DESC');
    $this->load->view('pegawai/view_kabupaten1',$data);    
  
  }
  function kecamatan(){

    $id_kab = $this->input->post('id_kab');
    $data['kecamatan'] = $this->model_app->view_where_ordering('kecamatan',array('id_kab' => $id_kab),'id_kec','DESC');
    $this->load->view('pegawai/view_kecamatan',$data);    
  
  }
  function kelurahan(){

    $id_kec = $this->input->post('id_kec');
    $data['kelurahan'] = $this->model_app->view_where_ordering('kelurahan',array('id_kec' => $id_kec),'id_kel','DESC');
    $this->load->view('pegawai/view_kelurahan',$data);    
  
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

   
    $this->template->load(base_theme().'/template-pelayanan',base_theme().'/kastem/view_penerimaan_bpjs',$data);
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
      $data['back']= base_url('pegawai/penerimaan_bpjs');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/kastem/view_detail_penerimaan_bpjs',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/datakastem');
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

   
    $this->template->load(base_theme().'/template-pelayanan',base_theme().'/kastem/view_kastem',$data);
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
      $data['back']= base_url('pegawai/datakastem');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/kastem/view_detail_kastem',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/datakastem');
    }
  }
     function pelayanan(){
   
        
   
         $data['title'] = 'PELAYANAN - '.title();
        $data['judul'] = 'PELAYANAN';
        $data['pelayanan'] = $this->model_app->view_ordering('pelayanan','pelayanan','ASC');
        //$this->template->load('user/template','user/pelayanan/view_pelayanan',$data); 
        $this->template->load(base_theme().'/template-pelayanan',base_theme().'/pelayanan/view_pelayanan',$data);
     
    
      

    }
   function sub_pelayanan(){
    $id_pelayanan = $this->input->post('id_pelayanan');
    $row = $this->model_app->view_where_ordering('sub_pelayanan',array('id_pelayanan'=>$id_pelayanan),'sub_pelayanan','ASC');
    if($row->num_rows() > 0){
      $data['record'] = $row;
      $this->load->view('pegawai/sub_pelayanan',$data);
    }else{
      $this->load->view('pegawai/submit_pelayanan');
    }
  }
  function approve()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('pegawai/pelayanan');
  }
  function disapprove()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('pegawai/pelayanan');
  }
  function approvebpjs()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('pegawai/penerimaan_bpjs');
  }
  function disapprovebpjs()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('pegawai/penerimaan_bpjs');
  }
  function approvekastem()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('pegawai/datakastem');
  }
  function disapprovekastem()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('pegawai/datakastem');
  }
   function approve_child()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);

     $data1 = array('approved'=>'y','approved_by'=>$peg);
    $where1 = array('id_parent'=>$id);
    $this->model_app->update($db,$data1,$where1);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('pegawai/pelayanan');
  }
  function disapprove_child()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);

    $data1 = array('approved'=>'n','approved_by'=>$peg);
    $where1 = array('id_parent'=>$id);
    $this->model_app->update($db,$data1,$where1);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('pegawai/pelayanan');
  }

  function jampersal()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN JAMPERSAL";
    $data['record'] = $this->db->query("SELECT * FROM jampersal WHERE approved = 'n' AND approved_by = 0 ORDER BY id_jampersal DESC");
    $this->load->view('pegawai/pelayanan/view_jampersal',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_jampersal',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function ekonomi_lemah()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN EKONOMI LEMAH";
    $data['record'] = $this->db->query("SELECT * FROM ekonomi_lemah WHERE approved = 'n' AND approved_by = 0 ORDER BY id_el DESC");
    $this->load->view('pegawai/pelayanan/view_ekonomi_lemah',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_ekonomi_lemah',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function bpjs()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN TIDAK MAMPU";
    $data['record'] = $this->db->query("SELECT * FROM bpjs WHERE approved = 'n' AND approved_by = 0 AND id_parent = 0 ORDER BY id_bpjs DESC");
    $this->load->view('pegawai/pelayanan/view_bpjs',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_bpjs',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
 
  function izin_nikah()
  {
    $data['judul'] = "PENGAJUAN PENGANTAR NIKAH";
    $data['record'] = $this->db->query("SELECT * FROM izin_nikah WHERE approved = 'n' AND approved_by = 0  ORDER BY id_in DESC");
    $this->load->view('pegawai/pelayanan/view_izin_nikah',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_izin_nikah',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function belum_menikah()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN BELUM NIKAH";
    $data['record'] = $this->db->query("SELECT * FROM belum_menikah WHERE approved = 'n' AND approved_by = 0  ORDER BY id_bm DESC");
    $this->load->view('pegawai/pelayanan/view_belum_menikah',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_belum_menikah',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
    function izin_mertua()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN IZIN MERTUA";
    $data['record'] = $this->db->query("SELECT * FROM izin_mertua WHERE approved = 'n' AND approved_by = 0  ORDER BY id_im DESC");
    $this->load->view('pegawai/pelayanan/view_izin_mertua',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_izin_mertua',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function wali_pernikahan()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN IZIN WALI";
    $data['record'] = $this->db->query("SELECT * FROM izin_wali WHERE approved = 'n' AND approved_by = 0  ORDER BY id_iw DESC");
    $this->load->view('pegawai/pelayanan/view_wali_pernikahan',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_izin_wali',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function domisili_usaha()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN DOMISILI USAHA ";
    $data['record'] = $this->db->query("SELECT * FROM usaha_dom  a JOIN usaha b ON a.id_usaha = b.id_usaha WHERE a.approved = 'n' AND a.approved_by = 0  AND b.approved = 'y' ORDER BY id_usaha_dom DESC");
    $this->load->view('pegawai/pelayanan/view_keterangan_dom_usaha',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_dom_usaha',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
    function keterangan_usaha()
  {
     $data['judul'] = "PENGAJUAN KETERANGAN DOMISILI USAHA ";
    $data['record'] =$this->db->query("SELECT * FROM usaha WHERE approved = 'n' AND approved_by = 0  ORDER BY id_usaha DESC");
    $this->load->view('pegawai/pelayanan/view_keterangan_usaha',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_usaha',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
  function usaha_tidakberjalan()
  {
    $data['judul'] = "PENGAJUAN KETERANGAN  USAHA ";
    $data['record'] = $this->db->query("SELECT * FROM usaha_tidak  a JOIN usaha b ON a.id_usaha = b.id_usaha WHERE a.approved = 'n' AND a.approved_by = 0  AND b.approved = 'y' ORDER BY id_ut DESC");
    $this->load->view('pegawai/pelayanan/view_keterangan_usaha_tidak',$data);
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
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_usaha_tidak',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function approve_usaha()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'y','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);

    $data1 = array('status'=>'tidak');
    $where1 = array('id_usaha'=>$id_usaha);
    $this->model_app->update('usaha',$data1,$where1);
    $this->session->set_flashdata('success','Pengajuan Berhasil disetujui');
    redirect('pegawai/pelayanan');
  }
  function disapprove_usah()
  {
    $db=$this->uri->segment('3');
    $id= $this->uri->segment('4');
    $id_tb = $this->uri->segment('5');
    $peg = $this->session->userdata['pegawai']['id_pegawai'];

    $data = array('approved'=>'n','approved_by'=>$peg);
    $where = array($id_tb=>$id);
    $this->model_app->update($db,$data,$where);
    $this->session->set_flashdata('success','Pengajuan Berhasil di tidak setujui');
    redirect('pegawai/pelayanan');
  }
   function surat_kelahiran()
  {
     $data['judul'] = "PENGAJUAN SURAT KELAHIRAN ";
    $data['record'] =$this->db->query("SELECT * FROM surat_kelahiran WHERE approved = 'n' AND approved_by = 0  ORDER BY id_sk DESC");
    $this->load->view('pegawai/pelayanan/view_surat_kelahiran',$data);
  }
   function detail_surat_kelahiran(){
    $id = $this->uri->segment('3');
    $cek = $this->model_app->view_where('surat_kelahiran',array('id_sk'=>$id));
    if($cek->num_rows() > 0){
        $row= $cek->row_array();
        $data['row'] = $row;
       
      $data['title'] = "DETAIL PENGAJUAN SURAT KELAHIRAN - ".title();
      $data['judul'] = "DETAIL PENGAJUAN SURAT KELAHIRAN";
      $data['back']= base_url('pegawai/pelayanan');
      $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_surat_kelahiran',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function surat_kematian()
  {
     $data['judul'] = "PENGAJUAN SURAT KEMATIAN ";
    $data['record'] =$this->db->query("SELECT * FROM surat_kematian WHERE approved = 'n' AND approved_by = 0  ORDER BY id_sk DESC");
    $this->load->view('pegawai/pelayanan/view_surat_kematian',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_surat_kematian',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
  function keterangan_domisili(){

    $data['judul'] = "PENGAJUAN KETERANGAN DOMISILI ";
    $data['record'] =$this->db->query("SELECT * FROM keterangan_domisili WHERE approved = 'n' AND approved_by = 0  ORDER BY id_kd DESC");
    $this->load->view('pegawai/pelayanan/view_keterangan_domisili',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_keterangan_domisili',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function surat_pindah_penduduk(){

    $data['judul'] = "PENGAJUAN KETERANGAN PINDAH PENDUDUK ";
    $data['record'] =$this->db->query("SELECT * FROM surat_pindah WHERE approved = 'n' AND approved_by = 0 AND id_parent = 0 ORDER BY id_sp DESC");
    $this->load->view('pegawai/pelayanan/view_surat_pindah_penduduk',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_surat_penduduk',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }

   function bepergian(){

    $data['judul'] = "PENGAJUAN KETERANGAN BEPERGIAN ";
    $data['record'] =$this->db->query("SELECT * FROM bepergian WHERE approved = 'n' AND approved_by = 0 ORDER BY id_bp DESC");
    $this->load->view('pegawai/pelayanan/view_bepergian',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_bepergian',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function kehilangan(){

    $data['judul'] = "PENGAJUAN KETERANGAN HILANG/TERCECER ";
    $data['record'] =$this->db->query("SELECT * FROM kehilangan WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kehilangan DESC");
    $this->load->view('pegawai/pelayanan/view_kehilangan',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_kehilangan',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function kelakuan_baik(){

    $data['judul'] = "PENGAJUAN PENGANTAR KELAKUAN BAIK ";
    $data['record'] =$this->db->query("SELECT * FROM kelakuan_baik WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kb DESC");
    $this->load->view('pegawai/pelayanan/view_kelakuan_baik',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_kelakuan_baik',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function penghasilan_ortu(){

    $data['judul'] = "PENGAJUAN PENGHASILAN ORANG TUA ";
    $data['record'] =$this->db->query("SELECT * FROM penghasilan_ortu WHERE approved = 'n' AND approved_by = 0 ORDER BY id_po DESC");
    $this->load->view('pegawai/pelayanan/view_penghasilan_ortu',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_penghasilan_ortu',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
 function pindah_belajar(){

    $data['judul'] = "PENGAJUAN KETERANGAN PINDAH BELAJAR ";
    $data['record'] =$this->db->query("SELECT * FROM pindah_belajar WHERE approved = 'n' AND approved_by = 0 ORDER BY id_pb DESC");
    $this->load->view('pegawai/pelayanan/view_pindah_belajar',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_pindah_belajar',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function keterangan_terlantar(){

    $data['judul'] = "PENGAJUAN KETERANGAN TERLANTAR ";
    $data['record'] =$this->db->query("SELECT * FROM keterangan_terlantar WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kt DESC");
    $this->load->view('pegawai/pelayanan/view_keterangan_terlantar',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_keterangan_terlantar',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
   function keberatan_warga(){

    $data['judul'] = "PENGAJUAN PERNYATAAN KEBERATAN WARGA ";
    $data['record'] =$this->db->query("SELECT * FROM keberatan_warga WHERE approved = 'n' AND approved_by = 0 ORDER BY id_kw DESC");
    $this->load->view('pegawai/pelayanan/view_keberatan_warga',$data);
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
        $data['back']= base_url('pegawai/pelayanan');
        $this->template->load(base_theme().'/template_kembali',base_theme().'/pelayanan/view_detail_keberatan_warga',$data);
    }else{
        $this->session->set_flashdata('message','Data Tidak Ditemukan');
        redirect('pegawai/pelayanan');
    }
  }
  function alokasiDanaDesa(){
    $data['title'] = title();
    $data['menu'] = 'ALOKASI DANA DESA';
    $data['sub']= 'TAHAP ALOKASI DANA DESA';
    
    $this->template->load(base_theme().'/template-new',base_theme().'/add/view_tahap',$data);
    
        

   
        
       
       
       

    

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
  function cekTahap(){
    $tahap = $this->encrypt->decode($this->input->post('id'),$this->key);
    $cek = $this->model_app->view_where('tahap_add',array('id_tahap'=>$tahap));
    if($cek->num_rows() > 0){
       echo base_url('pegawai/detailAlokasiDanaDesa?tahap=').$this->input->post('id');
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
            $data['back'] = base_url('pegawai/alokasiDanaDesa');
            $data['key'] = $this->key;
            $data['title'] = 'TAHAP '.$row['tahap'].' '.$row['tahun']. ' - '.title();
            $data['menu'] = 'ALOKASI DANA DESA <br>TAHAP '.$row['tahap'].' TAHUN '.$row['tahun'];
            $this->template->load(base_theme().'/template-newback',base_theme().'/add/view_tahap_detail',$data);
       
    }else{
        $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
        redirect('pegawai/alokasiDanaDesa');
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
            $data['back'] = base_url('pegawai/detailAlokasiDanaDesa?tahap=').$thp;
            $data['key'] = $this->key;
            $data['status'] = $this->input->get('status');
            $data['id_parent'] = $this->input->get('id_parent');
            $data['id_sub_parent'] = $this->input->get('id_sub_parent');

            $data['title'] = 'TAHAP '.$row['tahap'].' '.$row['tahun']. ' - '.title();
            $data['menu'] = 'ALOKASI DANA DESA <br>TAHAP '.$row['tahap'].' TAHUN '.$row['tahun'];
            $data['bidang'] = $this->model_app->view_where_ordering('kode_rekening',array('status'=>'bidang'),'kode_rekening','ASC');
            $this->template->load(base_theme().'/template-newback',base_theme().'/add/view_add_alokasi',$data);
       
    }else{
        $this->session->set_flashdata('message','Alokasi Dana Desa Tidak Ditemukan');
        redirect('pegawai/alokasiDanaDesa');
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
    $me = $this->session->userdata['pegawai']['id_pegawai'];
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
        $data['back'] = base_url('pegawai/detailAlokasiDanaDesa?tahap='.$id_tahap);
        $this->template->load(base_theme().'/template-newback',base_theme().'/add/view_proses_add',$data);

      }else{
       
        $this->session->set_flashdata('message','Alokasi Dana Desa Belum Disetujui');
        redirect('pegawai/detailAlokasiDanaDesa?tahap='.$id_tahap);
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
                          <div class='col-3'><h6 class='text-dark' style='font-size:0.7rem'>PEGAWAI</h6></div>
                          <div class='col-2'><h6 class='text-dark' style='font-size:0.7rem'>STATUS</h6></div>


                      </div>
                  </div>";
    foreach($data->result_array() as $row){
      $peg = $this->model_app->view_where('pegawai',array('id_pegawai'=>$row['id_pegawai']))->row_array();
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
    $me = $this->session->userdata['pegawai']['id_pegawai'];
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
         $data = array('id_add'=>$id_add,'id_sd'=>$id_sd,'id_pegawai'=>$me,'keterangan'=>$keterangan,'foto_laporan'=>$foto,'approve_pengawas'=>NULL,'status_laporan'=>'p','persentase'=>$persentase,'realisasi'=>$real,'output'=>$output_q);
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
 $data = array('id_add'=>$id_add,'id_sd'=>$id_sd,'id_pegawai'=>$me,'keterangan'=>$keterangan,'foto_laporan'=>$foto,'approve_pengawas'=>NULL,'status_laporan'=>'p','persentase'=>$persentase,'realisasi'=>$real,'output'=>$output_q);
         $this->model_app->insert('persentase_add',$data);
         echo true;
    }
  }
}
