<?php 
    function cek_session_members(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session != 'konsumen'){
          // $ci->session->set_userdata('referred_from', current_url()); 
          $flash = $ci->session->set_flashdata('message', 'Login terlebih dahulu untuk mengakses halaman ini!'); 
         redirect('auth/login/'.$flash);
        }
    }
    function cek_session_cabang($cabang){
        $ci = & get_instance();
        $session = $ci->session->userdata['pegawai'];
        $sd = $ci->session->userdata['pegawai']['id_sd'];
     
        if (!$session AND $sd != $cabang){
          // $ci->session->set_userdata('referred_from', current_url()); 
          $flash = $ci->session->set_flashdata('message', 'Login terlebih dahulu untuk mengakses halaman ini!'); 
         redirect('auth/loginpegawai/'.$flash);
        }
    }
    function cek_session_cabang_guru($cabang){
        $ci = & get_instance();
        $session = $ci->session->userdata['guru'];
        $sd = $ci->session->userdata['guru']['id_sd'];
     
        if (!$session AND $sd != $cabang){
          // $ci->session->set_userdata('referred_from', current_url()); 
          $flash = $ci->session->set_flashdata('message', 'Login terlebih dahulu untuk mengakses halaman ini!'); 
         redirect('guru/login/'.$flash);
        }
    }
    function cek_session_cabang_kepsek($cabang){
        $ci = & get_instance();
        $session = $ci->session->userdata['kepsek'];
        $sd = $ci->session->userdata['kepsek']['id_sd'];
     
        if (!$session AND $sd != $cabang){
          // $ci->session->set_userdata('referred_from', current_url()); 
          $flash = $ci->session->set_flashdata('message', 'Login terlebih dahulu untuk mengakses halaman ini!'); 
         redirect('kepsek/login/'.$flash);
        }
    }
    function cek_session_pengawas(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session != 'pengawas'){
             $flash = $ci->session->set_flashdata('message', 'Login terlebih dahulu untuk mengakses halaman ini!'); 
         redirect('pengawas/login/'.$flash);
        }
    }
    function cek_session(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session != 'siswa'){
          // $ci->session->set_userdata('referred_from', current_url()); 
          $flash = $ci->session->set_flashdata('message', 'Login terlebih dahulu untuk mengakses halaman ini!'); 
         redirect('auth/login/'.$flash);
        }
    }
   

    function cek_session_reseller(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session != 'reseller'){
            redirect(base_url());
        }
    }
    function keys(){
        return "sdnpolewaliencryptsecure2021abcdef045623189122132741729321395+61235612412130.";
    }
    function encode($post){
        $key =  "sdnpolewaliencryptsecure2021abcdef045623189122132741729321395+61235612412130.";
        $ci = & get_instance();
        return $ci->encrypt->encode($post,$key);

    }
    function decode($post){
       $key =  "sdnpolewaliencryptsecure2021abcdef045623189122132741729321395+61235612412130.";
       $ci = & get_instance();
       return $ci->encrypt->decode($post,$key);
       
       
   }
    function filter($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
    }

    function rupiah($total){
        return number_format($total,0);
    }

    function terbilang($x){
      $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
      if ($x < 12)
        return " " . $abil[$x];
      elseif ($x < 20)
        return Terbilang($x - 10) . " Belas";
      elseif ($x < 100)
        return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
      elseif ($x < 200)
        return " Seratus" . Terbilang($x - 100);
      elseif ($x < 1000)
        return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
      elseif ($x < 2000)
        return " Seribu" . Terbilang($x - 1000);
      elseif ($x < 1000000)
        return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
      elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
    }
    function lastExplode($str){
        return substr($str, strrpos($str, '/') + 1);
    }
    function checkImage($url){
      
        if (!$fp = curl_init($url)) return false;
         return true;
    }
    function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
    }

    function cetak_meta($str,$mulai,$selesai){
        return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
    }

    function sensor($teks){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT * FROM katajelek");
        foreach ($query->result_array() as $r) {
            $teks = str_replace($r['kata'], $r['ganti'], $teks);       
        }
        return $teks;
    }  

    function getSearchTermToBold($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
            return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<b style="color:red">$0</b>', $text);
    }

    function tgl_indo($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.' '.$bulan.' '.$tahun;       
    } 

    function tgl_simpan($tgl){
            $tanggal = substr($tgl,0,2);
            $bulan = substr($tgl,3,2);
            $tahun = substr($tgl,6,4);
            return $tahun.'-'.$bulan.'-'.$tanggal;       
    }

    function tgl_view($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.'-'.$bulan.'-'.$tahun;       
    }

    function tgl_grafik($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.'_'.$bulan;       
    }   

    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    } 
    function randomShuffle($length = 5) {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    } 

    function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    function hari_ini($w){
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari_ini = $seminggu[$w];
        return $hari_ini;
    }

    function getBulan($bln){
                switch ($bln){
                    case 1: 
                        return "Jan";
                        break;
                    case 2:
                        return "Feb";
                        break;
                    case 3:
                        return "Mar";
                        break;
                    case 4:
                        return "Apr";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Jun";
                        break;
                    case 7:
                        return "Jul";
                        break;
                    case 8:
                        return "Agu";
                        break;
                    case 9:
                        return "Sep";
                        break;
                    case 10:
                        return "Okt";
                        break;
                    case 11:
                        return "Nov";
                        break;
                    case 12:
                        return "Des";
                        break;
                }
            } 

    function bulan($bln){
                switch ($bln){
                    case 1: 
                        return "Januari";
                        break;
                    case 2:
                        return "Februari";
                        break;
                    case 3:
                        return "Maret";
                        break;
                    case 4:
                        return "April";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Juni";
                        break;
                    case 7:
                        return "Juli";
                        break;
                    case 8:
                        return "Agustus";
                        break;
                    case 9:
                        return "September";
                        break;
                    case 10:
                        return "Oktober";
                        break;
                    case 11:
                        return "November";
                        break;
                    case 12:
                        return "Desember";
                        break;
                }
            } 
              function bulan1($bln){
                switch ($bln){
                    case '01': 
                        return "Januari";
                        break;
                    case '02':
                        return "Februari";
                        break;
                    case '03':
                        return "Maret";
                        break;
                    case '04':
                        return "April";
                        break;
                    case '05':
                        return "Mei";
                        break;
                    case '06':
                        return "Juni";
                        break;
                    case '07':
                        return "Juli";
                        break;
                    case '08':
                        return "Agustus";
                        break;
                    case '09':
                        return "September";
                        break;
                    case '10':
                        return "Oktober";
                        break;
                    case '11':
                        return "November";
                        break;
                    case '12':
                        return "Desember";
                        break;
                }
            } 
function romawi($bil){
    if($bil == 1){
        return 'I';
    }else if($bil == 2){
        return 'II';
    }else if($bil == 3){
        return 'III';
    }else if($bil == 4){
        return 'IV';
    }else if($bil == 5){
        return 'V';
    }else if($bil == 6){
        return 'VI';
    }else if($bil == 7){
        return 'VII';
    }else if($bil == 8){
        return 'VIII';
    }else if($bil == 9){
        return 'IX';
    }else if($bil == 10){
        return 'X';
    }else if($bil == 11){
        return 'XI';
    }else if($bil == 12){
        return 'XII';
    }
}           
function selisihdate($tgl1,$tgl2){
    $tgl1 = new DateTime($tgl1);
    $tgl2 = new DateTime($tgl2);
    $jarak = $tgl2->diff($tgl1);

    return $jarak->d;
}
function checkToday($tgl){
    if($tgl == date('Y-m-d')){
        return  'Hari ini';
    }else if($tgl == date('Y-m-d',strtotime('-1 day'))){
        return  'Kemarin';
    }else if($tgl == date('Y-m-d',strtotime('+1 day'))){
        return  'Besok';
    }else{
        return date('d/m',strtotime($tgl));
    }
}
function cek_terakhir($datetime, $full = false) {
	 $today = time();    
     $createdday= strtotime($datetime); 
     $datediff = abs($today - $createdday);  
     $difftext="";  
     $years = floor($datediff / (365*60*60*24));  
     $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
     $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
     $hours= floor($datediff/3600);  
     $minutes= floor($datediff/60);  
     $seconds= floor($datediff);  
     //year checker  
     if($difftext=="")  
     {  
       if($years>1)  
        $difftext=$years." Tahun";  
       elseif($years==1)  
        $difftext=$years." Tahun";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($months>1)  
        $difftext=$months." Bulan";  
        elseif($months==1)  
        $difftext=$months." Bulan";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($days>1)  
        $difftext=$days." Hari";  
        elseif($days==1)  
        $difftext=$days." Hari";  
     }  
     //hour checker  
     if($difftext=="")  
     {  
        if($hours>1)  
        $difftext=$hours." Jam";  
        elseif($hours==1)  
        $difftext=$hours." Jam";  
     }  
     //minutes checker  
     if($difftext=="")  
     {  
        if($minutes>1)  
        $difftext=$minutes." Menit";  
        elseif($minutes==1)  
        $difftext=$minutes." Menit";  
     }  
     //seconds checker  
     if($difftext=="")  
     {  
        if($seconds>1)  
        $difftext=$seconds." Detik";  
        elseif($seconds==1)  
        $difftext=$seconds." Detik";  
     }  
     return $difftext;  
	}
    if (!function_exists('format_indo')) {
        function format_indo($date){
          date_default_timezone_set('Asia/Makassar');
          // array hari dan bulan
          $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
          $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
          
          // pemisahan tahun, bulan, hari, dan waktu
          $tahun = substr($date,0,4);
          $bulan = substr($date,5,2);
          $tgl = substr($date,8,2);
          $waktu = substr($date,11,5);
          $hari = date("w",strtotime($date));
          $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;
      
          return $result;
        }
      }
      if (!function_exists('format_indo_w')) {
        function format_indo_w($date){
          date_default_timezone_set('Asia/Makassar');
          // array hari dan bulan
      
          $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
          
          // pemisahan tahun, bulan, hari, dan waktu
          $tahun = substr($date,0,4);
          $bulan = substr($date,5,2);
          $tgl = substr($date,8,2);
          $waktu = substr($date,11,5);
        
          $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;
      
          return $result;
        }
      }
    if (!function_exists('format_indo_1')) {
  function format_indo_1($date){
    date_default_timezone_set('Asia/Makassar');
    // array hari dan bulan
    $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    
    $hari = date("w",strtotime($date));
    $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;

    return $result;
  }
}
if (!function_exists('format_indow')) {
    function format_indow($date){
      date_default_timezone_set('Asia/Makassar');
      // array hari dan bulan
      $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $Bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
      
      // pemisahan tahun, bulan, hari, dan waktu
      $tahun = substr($date,0,4);
      $bulan = substr($date,5,2);
      $tgl = substr($date,8,2);
      
      $hari = date("w",strtotime($date));
      $result = $tgl." ".$Bulan[(int)$bulan-1];
  
      return $result;
    }
  }
function nama($n){
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
    return $nama;
}
function namasingkat($n){
    $na = explode(' ',$n);
    if(count($na) == 1){
        $nama = ucfirst($na[0]);
    }else {
        if(strlen($na[0].' '.$na[1]) > 10){
            $nama = ucfirst($na[0]);
        }else{
            $nama = ucfirst($na[0]).' '.ucfirst($na[1]);
        }
        
    }
    return $nama;
}
   function noHp($nohp){
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
                return $hp;
    }