<?php 
    function cek_session_akses($link,$id){
    	$ci = & get_instance();
    	$session = $ci->db->query("SELECT * FROM modul,submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND (submodul.link='$link' OR modul.link ='$link')")->num_rows();
    	if ($session == '0' ){
            $flash = $ci->session->set_flashdata('message','Anda Tidak dapat Mengakses Halaman Ini!');
    		redirect(base_url().'administrator/home',$flash);
    	}
    }
    function cek_session_konten($link,$id,$konten){
        $ci = & get_instance();
        $session = $ci->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
        if ($session > 0){
              return $konten;
        }
    }

    function cek_session_conditional($link,$id){
        $ci = & get_instance();
        $session = $ci->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
        if ($session > 0){
              return true;
        }else{
            return false;
        }
    }
     function update_session($id,$date){
        $ci = & get_instance();
        $session = $ci->db->query("SELECT * FROM siswa_session WHERE id_siswa = '".$id."' AND date = '".$date."' ");
        if ($session->num_rows() == '0' ){
            $agent = $ci->agent->platform();
            $ip = $ci->input->ip_address();
            $key = "sdnpolewaliencryptsecure2021abcdef045623189122132741729321395+61235612412130.";
            $log = $ci->encrypt->encode(date('Y-m-d H:i:s'),$key);
            $ci->db->query("INSERT INTO siswa_session  (`id_login`,`id_siswa`,`time`,`user_agent`,`ip`,`date`) VALUES ('".$log."',$id,'".date('H:i:s',strtotime("+10 Minutes"))."','".$agent."','".$ip."','".$date."') ");
        }else{
            $row = $session->row_array();
            if($row['time'] <= date('H:i:s')){

                $ci->db->query("UPDATE siswa_session SET time = '".date('H:i:s',strtotime("+10 Minutes"))."'  WHERE id_siswa = '".$id."' AND date = '".$date."' ");
               
            }
            
        }
    }
    function template1(){
        return base_url('template/pegawai');
    }
    function base_theme(){
        return 'pegawai';
    }
    function theme_base(){
        return 'guru';
    }

    function template(){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT folder FROM templates where aktif='Y'");
        $tmp = $query->row_array();
        if ($query->num_rows()>=1){
            return base_url('template/').$tmp['folder'];
        }else{
            return 'errors';
        }
    }
     function theme(){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT folder FROM templates where aktif='Y' AND status ='admin' ");
        $tmp = $query->row_array();
        if ($query->num_rows()>=1){
            return base_url('template/').$tmp['folder'];
        }else{
            return 'errors';
        }
    }

    function background(){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT gambar FROM background ORDER BY id_background DESC LIMIT 1")->row_array();
        return $bg['gambar'];
    }
    function cabang(){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT id_sd FROM subdomain WHERE sub_domain = '".base_url()."'  LIMIT 1")->row_array();
        return $bg['id_sd'];
    }
    function cabang_level(){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT status FROM subdomain WHERE sub_domain = '".base_url()."'  LIMIT 1")->row_array();
        return $bg['status'];
    }
    function title(){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT nama_cabang FROM subdomain WHERE sub_domain = '".base_url()."'  LIMIT 1")->row_array();
        return $bg['nama_cabang'];
    }

    function description(){
        $ci = & get_instance();
        $title = $ci->db->query("SELECT meta_deskripsi FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return $title['meta_deskripsi'];
    }

    function keywords(){
        $ci = & get_instance();
        $title = $ci->db->query("SELECT meta_keyword FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return $title['meta_keyword'];
    }

    function favicon(){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT favicon FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return $fav['favicon'];
    }

    function cek_session_admin(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session != 'admin'){
            redirect(base_url());
        }
    }