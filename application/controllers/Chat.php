<?php
/*
-- ---------------------------------------------------------------
-- CHAT --
-- JUA KOPI --
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        $this->session->set_userdata('referred_from', current_url()); 
			cek_session();
    }
    function index(){
        $data['title']= 'Chat - '.title();
        $data['page'] = 'Chat';
        $data['back'] ="";
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id,date('Y-m-d'));
        $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $this->template->load('phpmu-tigo/template-chat','phpmu-tigo/view_chat',$data);
    }
    function siswaOnline(){
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $data = $this->db->query("SELECT * FROM siswa_session a JOIN siswa b ON a.id_siswa = b.id_siswa WHERE a.date = '".date('Y-m-d')."' AND time >= '".date('H:i:s')."' AND a.id_siswa != '".$id."' ORDER BY a.time DESC");
        $output = null;
        if($data->num_rows() > 0 ){
            foreach($data->result_array() as $row){

                $output .= "  <div class='mr-1 mb-0 chatDetail position-relative' data-id='".$this->encrypt->encode($row['id_siswa'],keys())."' style='width:40px'>
                                 <center><img src='".$row['foto']."' class='img-fluid rounded-circle ' style='height: 36px;width: 36px;pointer-events: none;  cursor: default;' alt='image'></center> 
                                 <div class='dot'></div>     
                                 <span class='d-block  font-10 text-center mt-1' style='line-height:100%;padding-bottom:0 !important' >".namasingkat($row['nama_lengkap'])."</span>  
                                           
                             </div>";
            }
        }
        echo json_encode(array('output'=>$output,'count'=>$data->num_rows()));
    }
    function getOnline(){
         $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $data = $this->db->query("SELECT * FROM siswa_session a JOIN siswa b ON a.id_siswa = b.id_siswa WHERE a.date = '".date('Y-m-d')."' AND time >= '".date('H:i:s')."' AND a.id_siswa != '".$id."' ORDER BY a.time DESC");
        $output = null;
        $title = null;
        if($data->num_rows() > 0 ){
            foreach($data->result_array() as $row){

                $output .= "  <li class='chatDetail' data-id='".$this->encrypt->encode($row['id_siswa'],keys())."'>
                                <div class='item '>
                                    <img src='".base_url('asset/foto_siswa/').$row['foto_profile']."' alt='".$row['nama_lengkap']."' class='image'>
                                                                    
                                     <div class='in'>
                                        <div>".$row['nama_lengkap']."</div>
                                        <span class='dot1'></span>
                                    </div>

                                </div>
                            </li>";
            }
        }
        $title = $data->num_rows().' Siswa Online';
        echo json_encode(array('output'=>$output,'title'=>$title));
    }
    function sendText(){
        $siswa = $this->encrypt->decode($this->input->post('siswa'),keys());
        $me = $this->encrypt->decode($this->session->id_siswa,keys());

        $teks = $this->input->post('text');
        if($teks == ''){
            $status = false;
        }else{
            $status = true;
            $this->model_app->insert('obrolan_detail',array('from_id'=>$me,'to_id'=>$siswa,'obrolan'=>$teks,'type'=>'teks','read'=>'n','tanggal'=>date('Y-m-d'),'waktu'=>date('H:i:s')));
            $cek = $this->model_app->view_where('obrolan',array('from_id'=>$me,'to_id'=>$siswa));
            if($cek->num_rows() > 0){
                $this->model_app->update('obrolan',array('tanggal_update'=>date('Y-m-d H:i:s')),array('from_id'=>$me,'to_id'=>$siswa));
                $this->model_app->update('obrolan',array('tanggal_update'=>date('Y-m-d H:i:s')),array('to_id'=>$me,'from_id'=>$siswa));

            }else{
                $this->model_app->insert('obrolan',array('from_id'=>$me,'to_id'=>$siswa,'tanggal_update'=>date('Y-m-d H:i:s')));
                $this->model_app->insert('obrolan',array('to_id'=>$me,'from_id'=>$siswa,'tanggal_update'=>date('Y-m-d H:i:s')));

            }
        }
        echo json_encode($status);
        
    }
    function sendImage(){
        $config['upload_path'] =  './asset/file_chat/'; 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '20000';
        $config['encrypt_name'] = TRUE;
     

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')){
        $status =false;

        }
        else{
            $status = true;
            $siswa = $this->encrypt->decode($this->input->post('siswa'),keys());
            $me = $this->encrypt->decode($this->session->id_siswa,keys());
            $dataupload = $this->upload->data();
            
            $this->model_app->insert('obrolan_detail',array('from_id'=>$me,'to_id'=>$siswa,'obrolan'=>base_url('asset/file_chat/').$dataupload['file_name'],'type'=>'foto','read'=>'n','tanggal'=>date('Y-m-d'),'waktu'=>date('H:i:s')));
            $cek = $this->model_app->view_where('obrolan',array('from_id'=>$me,'to_id'=>$siswa));
            if($cek->num_rows() > 0){
                $this->model_app->update('obrolan',array('tanggal_update'=>date('Y-m-d H:i:s')),array('from_id'=>$me,'to_id'=>$siswa));
                $this->model_app->update('obrolan',array('tanggal_update'=>date('Y-m-d H:i:s')),array('to_id'=>$me,'from_id'=>$siswa));

            }else{
                $this->model_app->insert('obrolan',array('from_id'=>$me,'to_id'=>$siswa,'tanggal_update'=>date('Y-m-d H:i:s')));
                $this->model_app->insert('obrolan',array('to_id'=>$me,'from_id'=>$siswa,'tanggal_update'=>date('Y-m-d H:i:s')));

            }


        }
       echo json_encode($status);
    }
    function countChat(){
        $siswa = $this->encrypt->decode($this->input->post('siswa'),keys());
        $me = $this->encrypt->decode($this->session->id_siswa,keys());
        $count = $this->db->query("SELECT * FROM obrolan_detail WHERE to_id = '".$me."' AND from_id = '".$siswa."' AND `read` ='n' ")->num_rows();
        echo json_encode($count);

    }
    function countAllChat(){
    
        $me = $this->encrypt->decode($this->session->id_siswa,keys());
        $count = $this->db->query("SELECT * FROM obrolan_detail WHERE to_id = '".$me."'  AND `read` ='n' ")->num_rows();
        echo json_encode($count);

    }
    function dataChat(){
        $siswa = $this->encrypt->decode($this->input->post('siswa'),keys());
        $me = $this->encrypt->decode($this->session->id_siswa,keys());
        $output =null;
        $this->model_app->update('obrolan_detail',array('read'=>'y'),array('to_id'=>$me,'from_id'=>$siswa));
        $data = $this->db->query("SELECT * FROM obrolan_detail WHERE (from_id = '$me' OR to_id = '$me') AND  (from_id = '$siswa' OR to_id = '$siswa') GROUP BY tanggal ORDER BY id_od ");
        $cus = $this->model_app->view_where('siswa',array('id_siswa'=>$siswa))->row_array();
        if (! $cus['foto_profile']==''){
            $foto = base_url('asset/foto_siswa/profile.svg');
          }else{
            $foto = $cus['foto_profile'];

          }
        $count = 0;
        if($data->num_rows() > 0){
            $count = $this->db->query("SELECT * FROM obrolan_detail WHERE to_id = '".$me."' AND from_id = '".$siswa."' AND `read` ='n' ")->num_rows();

            foreach($data->result_array() as $row ){
                $date = date('Y-m-d',strtotime($row['tanggal']));
                
                $yes = date('Y-m-d', strtotime($date. ' +1 days'));
                $now = date('Y-m-d');
                $dt = date('d/m/Y',strtotime($row['tanggal']));
                if($date == $now){
                  $day = 'Hari Ini';
                 
                }elseif($now ==  $yes){
                  $day = 'Kemarin';
                 
                }else{
                  $day = $dt;
                  
                }
                $output .= "<div class='message-divider'>
                                ".$day."
                            </div>";
                $chat = $this->db->query("SELECT * FROM obrolan_detail WHERE (from_id = '$me' OR to_id = '$me') AND  (from_id = '$siswa' OR to_id = '$siswa') AND tanggal = '".$row['tanggal']."' ORDER BY id_od ");
                foreach($chat->result_array() as $cht){
                   
                    $time = date('H:i',strtotime($row['time']));
                    if($cht['from_id'] == $me){
                        if($cht['type'] == 'teks'){
                            $output .= "<div class='message-item user'>
                            
                            <div class='content'>
                                
                                <div class='bubble'>
                                    ".str_replace(array('<p></p>'),'',$cht['obrolan'])."
                                </div>
                                <div class='footer'>8:40 AM</div>
                            </div>
                        </div>";
                        }elseif($cht['type'] == 'foto'){
                         
                                if(checkImage($row['obrolan'])  == true){
                                    $img =$cht['obrolan'];
                                }else{
                                    $img =base_url('asset/file_chat/broken.jpg');
                                }
                                $output .= "<div class='message-item user'>
                                
                                <div class='content'>
                                    
                                    <div class='bubble'>
                                    <img src='".$img."' alt='img-chat' class='imaged w160' >
                                    </div>
                                    <div class='footer'>8:40 AM</div>
                                </div>
                            </div>";
                            
                        }
                    }elseif($cht['from_id'] == $siswa){
                        if($cht['type'] == 'teks'){
                            $output .= "<div class='message-item'>
                            <img src='".$foto."' alt='avatar-".$cus['nama_lengkap']."' class='avatar' style='height:32px'>
                            <div class='content'>
                                
                                <div class='bubble'>
                                    ".str_replace(array('<p></p>'),'',$cht['obrolan'])."
                                </div>
                                <div class='footer'>8:40 AM</div>
                            </div>
                        </div>";
                        }elseif($cht['type'] == 'foto'){
                            
                                if(file_exists('asset/file_chat/'.$cht['obrolan'])){
                                    $img = base_url('asset/file_chat/').$cht['obrolan'];
                                }else{
                                    $img =base_url('asset/file_chat/broken.jpg');
                                }
                                $output .= "<div class='message-item'>
                                <img src='".$foto."' alt='avatar-".$cus['nama_lengkap']."' class='avatar' style='height:32px'>
                                <div class='content'>
                                    
                                    <div class='bubble'>
                                    <img src='".$img."' alt='img-chat' class='imaged w160'>
                                    </div>
                                    <div class='footer'>8:40 AM</div>
                                </div>
                            </div>";
                            
                        }
                    }
                }
                
            }
        }else{

        }
        echo json_encode(array('output'=>$output,'count'=>$count));
       
    
    }
    function detail(){
        $siswa = $this->encrypt->decode($this->input->get('siswa'),keys());
        $me = $this->encrypt->decode($this->session->id_siswa,keys());
        $id = $this->encrypt->decode($this->input->get('id'),keys());
        $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$siswa));
        
        if($cek->num_rows() > 0 ){
            $row = $cek->row_array();
            
            $data['row'] = $cek->row_array();
            $n = $row['nama_lengkap'];
            $nama = nama($n);
            
            $data['title'] = $nama.' - '.title();
            $data['page'] = $nama;
            $this->load->view('phpmu-tigo/view_chat_detail',$data);

        }else{
            $this->session->set_flashback('message','Siswa tidak ditemukan!');
            redirect('main');
        }
    }

    function doDetail(){
        $siswa = $this->encrypt->decode($this->input->post('siswa'),keys());
        $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$siswa));
        $me = $this->encrypt->decode($this->session->id_siswa,keys());

        if($cek->num_rows() > 0){
           
            $idsiswa = $this->input->post('siswa');
            $status = true;
            $link = base_url('chat/detail?siswa='.$idsiswa);
        }else{  
            $status = false;
            $link = null;
        }
       
        echo json_encode(array('status'=>$status,'link'=>$link));
    }
    

    function searchUser(){
        $key = $this->input->post('key');
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $data = $this->db->query("SELECT * FROM siswa WHERE (nama_lengkap LIKE '%".$key."%'  ) AND id_siswa !=  '".$id."' AND id_sd = '".$cabang['id_sd']."' ");
        $output = null;
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $n = $row['nama_lengkap'];
                $na = explode(' ',$n);
                if(count($na) == 1){
                    $nama = ucfirst($na[0]);
                }else if(count($na) == 2){
                    $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
                }else if(count($na) == 3){
                    $nam = ucfirst($na[0]).' '.ucfirst($na[1]).' '.ucfirst($na[2]);
                    if(strlen($nam) > 20){
                        $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
                    }else{
                        $nama = $nam;
                    }

                }else {
                    $nam = ucfirst($na[0]).' '.ucfirst($na[1]).' '.ucfirst($na[2]);
                    if(strlen($nam) > 20){
                        $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
                    }else{
                        $nama = $nam;
                    }
                }
                if($row['foto'] != null){
                    $img = $row['foto'];
                }else{
                    $img = base_url('asset/foto_siswa/profile.svg');
                }
                $output.= "<li class='detailchat' data-siswa='".$this->encrypt->encode($row['id_siswa'],keys())."'  >
                    <a class='item'>
                        <img src='".$img."' alt='profile-".$row['nama_lengkap']."' class='image'>
                        <div class='in' >
                            <div  >
                                <header>".strtoupper($row['nama_sekolah'])."</header>
                                ".$nama."
                                <footer> Kelas ".strtoupper($row['kelas'])." </footer>
                            </div>
                       
                        </div>
                    </a>
                </li>";
            }
        }else{
            $output = "<li class='p-2 py-4'> <a >Pencarian tidak ditemukan</a></li>";
        }
        echo $output;
    }
    function getChat(){
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
  
         $data = $this->db->query("SELECT id_obrolan,id_siswa,tanggal_update,nama_lengkap,foto 
                                    FROM obrolan a JOIN siswa b ON a.to_id = b.id_siswa 
                                    WHERE a.from_id = '$id' AND a.visible ='y' ORDER BY tanggal_update DESC");
        
        $output = null;
        $style = null;
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $n = $row['nama_lengkap'];
                $na = explode(' ',$n);
                if(count($na) == 1){
                    $nama = ucfirst($na[0]);
                }else if(count($na) == 2){
                    $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
                }else if(count($na) == 3){
                    $nam = ucfirst($na[0]).' '.ucfirst($na[1]).' '.ucfirst($na[2]);
                    if(strlen($nam) > 20){
                        $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
                    }else{
                        $nama = $nam;
                    }

                }else {
                    $nam = ucfirst($na[0]).' '.ucfirst($na[1]).' '.ucfirst($na[2]);
                    if(strlen($nam) > 20){
                        $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
                    }else{
                        $nama = $nam;
                    }
                }
                $cek = $this->db->query("SELECT * FROM obrolan_detail WHERE (from_id = '".$id."' AND to_id  = '".$row['id_siswa']."') 
                                            OR (to_id = '".$id."' AND from_id = '".$row['id_siswa']."') 
                                             ORDER BY created_at DESC LIMIT 1")->row_array();
                if($cek['from_id'] == $id){
                    $style='';
                    if($cek['type'] == 'foto'){
                        $footer = "Anda Mengirim Foto";
                    }else if($cek['type'] == 'video'){
                        $footer = "Anda Mengirim Video";
                    }else if($cek['type'] == 'document'){
                        $footer = "Anda Mengirim Dokumen";
                    }else if($cek['type']=='teks'){
                        $teks = $cek['obrolan'];
                        if(strlen($teks) > 50){
                            $cht = substr($teks,0,50).'...';
                        }else{
                            $cht = $teks;
                        }
                        $footer = "<ion-icon name='return-down-forward-outline'></ion-icon> ".$cht;
                    }
                }else if($cek['to_id'] == $id){
                    if($cek['type'] == 'foto'){
                        $footer = " Mengirim Foto";
                    }else if($cek['type'] =='video'){
                        $footer = "Mengirim Video";
                    }else if($cek['type']== 'document'){
                        $footer = "Mengirim Dokumen";
                    }else if($cek['type'] == 'teks'){
                        $teks = $cek['obrolan'];
                        if(strlen($teks) > 50){
                            $cht = substr($teks,0,50).'...';
                        }else{
                            $cht = $teks;
                        }
                        $footer = $cht;
                    }
                    if($cek['read']== 'n' AND $cek['alur'] == 'to-from'){
                        $style = "style='font-weight:bold;'";
                    }else{
                        $style = null;
                    }
                }
                $count = $this->db->query("SELECT * FROM obrolan_detail WHERE to_id = '".$id."' AND `read` ='n' ")->num_rows();
                if($count > 0){
                    $tot = " <span class='badge badge-primary'>".$count."</span>";
                }else{
                    $tot ="";
                }
                if($row['foto'] != null OR $row['foto'] != ""){
                    $img = $row['foto'];
                }else{
                    $img = base_url('asset/foto_siswa/profile.svg');
                }
                $date = date('Y-m-d',strtotime($row['tanggal_update']));
                $time = date('H:i',strtotime($row['tanggal_update']));
                $yes = date('Y-m-d', strtotime($date. ' +1 days'));
                $now = date('Y-m-d');
                $dt = date('d/m',strtotime($row['tanggal_update']));

                $count = date('Ymd') - $yes;

                if($date == $now){
                  $chat_time = $time;
                }elseif($yes  == $now){
                  $chat_time = 'Kemarin';
                }else {
                  $chat_time = $dt;
                }
                $output.= "<li class='detailchat' data-siswa='".$this->encrypt->encode($row['id_siswa'],keys())."'  >
                    <a class='item'>
                        <img src='".$img."' alt='profile-".$row['nama_lengkap']."' class='image'>
                        <div class='in' >
                            <div ".$style." >
                                <header>".$chat_time."</header>
                                ".$nama."
                                <footer>".$footer." </footer>
                            </div>
                           ".$tot."
                        </div>
                    </a>
                </li>";
            }
        }else{
            $output = "";
        }
        echo $output;
    }
    
	
}
