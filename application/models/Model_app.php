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
class Model_app extends CI_model{
    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }
    public function insert_id($table,$data){
         $this->db->insert($table, $data);
         return $this->db->insert_id();
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table,$data,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }
    public function view_order($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        return $this->db->get($table);
        
    }

    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }
    public function join_where_order($table1,$table2,$field1,$field2,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function view_left_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field,'left');
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function konsumen_tebak_angka($status)
    {
        // return $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` ORDER BY `id_ta` ASC");
        return $this->db->query("SELECT * FROM angka  WHERE status = '$status' ORDER BY id_angka DESC ");

    }
     public function search_konsumen_tebak_angka($tgl,$status,$time)
    {
        // return $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` ORDER BY `id_ta` ASC");
        return $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen`  WHERE date = '$tgl' AND  angka.status = '$status' AND  end >= '$time' AND start <= '$time' ");

    }
    public function get_dropshipper_detail($id_penjualan)
    {
        return $this->db->query("SELECT * FROM `rb_penjualan` JOIN `rb_dropshipper_history` ON `rb_penjualan`.`id_pembeli`=`rb_dropshipper_history`.`id_konsumen` WHERE `rb_dropshipper_history`.`kode_transaksi` = '".$id_penjualan."' ORDER BY `rb_dropshipper_history`.`id_dh` ASC  LIMIT 1");
    }

    function umenu_akses($link,$id){
        return $this->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    }

    public function cek_login($username,$password,$table,$cabang){
        return $this->db->query("SELECT * FROM $table where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."' AND id_sd ='".$cabang."' AND blokir='N'");
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function kategori_populer($limit){
        return $this->db->query("SELECT * FROM (SELECT a.*, b.jum_dibaca FROM
                                    (SELECT * FROM kategori) as a left join
                                    (SELECT id_kategori, sum(dibaca) as jum_dibaca FROM berita GROUP BY id_kategori) as b on a.id_kategori=b.id_kategori) as c 
                                        where c.aktif='Y' ORDER BY c.jum_dibaca DESC LIMIT $limit");
    }
    function get_absen($start,$end,$konsumen)
    {
        if($konsumen == 'all')
        {
            $where = '';
        }else{
            $where = 'username = "'.$konsumen.'" AND ';
        }

        return $this->db->query("SELECT * FROM `absensi` JOIN `rb_konsumen` ON `absensi`.`id_konsumen`=`rb_konsumen`.`id_konsumen` WHERE $where  date >= '$start' AND date <= '$end' ORDER BY `date` ASC");
    }
    function get_absen_board($m)
    {
      

        return $this->db->query("SELECT nama_lengkap as nama , COUNT(`absensi`.`id_konsumen`) as total FROM `absensi` JOIN `rb_konsumen` ON `absensi`.`id_konsumen`=`rb_konsumen`.`id_konsumen` WHERE date LIKE '%$m%' GROUP BY `absensi`.`id_konsumen`  ORDER BY `total` DESC LIMIT 3");
    }

     function get_quiz($start,$end,$konsumen,$status)
    {
        if($konsumen == 'all')
        {
            $where = '';
        }else{
            $where = 'id_konsumen = "'.$konsumen.'" AND ';
        }
        if($status == 'all')
        {
            $stt = '';
        }else{
            $stt = 'AND qp_status = "'.$status.'" ';
        }

        return $this->db->query("SELECT * FROM `quiz_partisipasi` JOIN `rb_konsumen` ON `quiz_partisipasi`.`id_konsumen`=`rb_konsumen`.`id_konsumen` WHERE $where  qp_date >= '$start' AND qp_date <= '$end' $stt ORDER BY `qp_finish` DESC");
    }
     function quiz_detail($id,$konsumen)
    {
        if($konsumen == 'all')
        {
            $where = '';
        }else{
            $where = 'AND quiz_partisipasi.id_konsumen = "'.$konsumen.'" ';
        }
       

        return $this->db->query("SELECT * FROM `quiz_partisipasi` JOIN `rb_konsumen` ON `quiz_partisipasi`.`id_konsumen`=`rb_konsumen`.`id_konsumen` JOIN quiz_date ON quiz_partisipasi.qd_id = quiz_date.qd_id WHERE quiz_partisipasi.qd_id = '".$id."' AND qp_status ='50' $where ORDER BY  qp_poin DESC");
    }
     function get_quiz_board($tgl,$konsumen,$status,$limit)
    {
        if($konsumen == 'all')
        {
            $where = '';
        }else{
            $where = 'WHERE T.username = "'.$konsumen.'" ';
        }
        if($status == 'all')
        {
            $stt = '';
        }else{
            $stt = 'AND qp_status = "'.$status.'" ';
        }

       

        return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT SUM(qp_poin) as totalp,
                a.qp_id,a.id_konsumen, COUNT(qp_id) kuis_tot, b.nama_lengkap,a.qp_status,c.tanggal
         from quiz_partisipasi as a INNER JOIN rb_konsumen as b ON a.id_konsumen = b.id_konsumen INNER JOIN quiz_date c ON a.qd_id = c.qd_id
        WHERE  a.qd_id = $tgl $stt 
         group by id_konsumen
         order by totalp desc LIMIT $limit)T,(select @rownum:=0)a");
        }
        function get_quiz_board_nolimit($month,$konsumen,$status)
    {
        if($konsumen == 'all')
        {
            $where = '';
        }else{
            $where = 'AND a.id_konsumen = "'.$konsumen.'" ';
        }
        if($status == 'all')
        {
            $stt = '';
        }else{
            $stt = 'AND qp_status = "'.$status.'" ';
        }

       

        return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT SUM(qp_poin) as totalp,
                a.qp_id,a.id_konsumen, COUNT(qp_id) kuis_tot, b.nama_lengkap,a.qp_status,c.tanggal
         from quiz_partisipasi as a INNER JOIN rb_konsumen as b ON a.id_konsumen = b.id_konsumen INNER JOIN quiz_date c ON a.qd_id = c.qd_id
        WHERE  a.qd_id = $month $stt 
         group by id_konsumen
         order by totalp desc)T,(select @rownum:=0)a");
        }

        function search_quiz_board($start,$end,$status,$limit)
       {
       
        if($status == 'all')
        {
            $stt = '';
        }else{
            $stt = 'AND qp_status = "'.$status.'" ';
        }

       

        return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT SUM(qp_poin) as totalp,
                a.qp_id,a.id_konsumen, COUNT(qp_id) kuis_tot, b.nama_lengkap,a.qp_status
         from quiz_partisipasi as a INNER JOIN rb_konsumen as b ON a.id_konsumen = b.id_konsumen
        WHERE  qp_date >= '$start' AND qp_date <= '$end' $stt 
         group by id_konsumen
         order by totalp desc LIMIT $limit)T,(select @rownum:=0)a");
        }
    function get_tebak_angka($table,$date,$status)
    {
        return $this->db->query("SELECT * FROM `$table` WHERE `status` = '$status' AND time LIKE '$date%'");
    }
    public function get_kuis($tgl,$status){

        if($tgl == 'all'){
            $where = "";
        }else{
            $where =  $this->db->where('MONTH(tanggal)',$tgl);;
        }

        if($status =='all'){
            $where1 = "";
        }else{
            $where1= $this->db->where('status',$status);
        }
        $where;
        $where1;
        $this->db->order_by('tanggal','ASC');
        return $this->db->get('quiz_date');
        
    }
    public function getTopSiswa($kelas,$limit,$cabang){
        if($kelas == 'all'){
            $where = '';
        }else{
            $where = 'AND a.kelas ="'.$kelas.'"';
        }
        $query = $this->db->query("SELECT a.nama_lengkap,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto,a.kelas FROM siswa a JOIN quiz_partisipasi b 
        ON a.id_siswa = b.id_siswa WHERE id_sd = '".$cabang."' $where   GROUP BY b.id_siswa
        ORDER BY poin DESC,quiz_duration ASC LIMIT $limit ");
        return $query;
    }
    public function getPeringkat($kelas,$limit,$start,$end,$sekolah){
        $where = null;
        if($kelas != 'all' ){
           
            $where .= 'AND a.kelas ="'.$kelas.'"';
        }else{
            $where .= '';
        }
        if($sekolah == 'all'){
            $where .= '';
        }else{
            $where .= 'AND a.id_sd = "'.$sekolah.'"';
        }
        $query = $this->db->query("SELECT a.nama_lengkap,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.id_sd,a.foto,a.kelas FROM siswa a JOIN quiz_partisipasi b 
        ON a.id_siswa = b.id_siswa JOIN quiz_date c ON b.qp_date = c.id_qd WHERE c.tanggal >= '".$start."' AND c.tanggal <='".$end."' $where   GROUP BY b.id_siswa
        ORDER BY qp_poin DESC,quiz_duration ASC LIMIT $limit ");
        return $query;
    }
    function dataPartisipasi($start,$end,$siswa,$kelas,$sekolah){
        $where = null;
        if($siswa != 'all' ){
            $where .= "AND b.id_siswa = '".$siswa."'";
        }

        if($kelas != 'all' AND $kelas != null){
            $where .= "AND b.kelas = '".$kelas."'";
        }
        if($sekolah != 'all'){
            $where .= "AND b.id_sd =  '".$sekolah."'";
        }
        $start = $start.' 00:00:00';
        $end = $end.' 23:59:59';

        $query = $this->db->query("SELECT a.id_qp,a.created_at,a.qp_correct,a.qp_wrong,a.qp_poin,a.qp_finish,qp_done,a.quiz_duration,a.qp_date,b.nama_lengkap,b.kelas,a.id_siswa,b.id_sd FROM quiz_partisipasi a JOIN siswa b ON a.id_siswa = b.id_siswa WHERE a.created_at >= '".$start."' AND a.created_at <= '".$end."' $where ORDER BY a.id_qp DESC");
        return $query;

    }
    function dataDiskusi($start,$limit,$id,$hours,$cabang){
        $query = $this->db->query("SELECT * FROM diskusi a JOIN siswa b ON a.id_siswa = b.id_siswa  WHERE b.id_sd = '".$cabang."' ORDER BY 
	 				
                 a.created_at DESC
					   LIMIT $start,$limit");

        return $query;

    }
    function filterSiswa($cabang){
        $where = null;
    
        if($cabang == 'all' OR $cabang == NULL){
            $where .= "";
        }else {
            $where .= "AND id_sd= '".$cabang."'";
        }
    
       
        return $this->db->query("SELECT * FROM siswa WHERE active = 'y' $where ORDER BY id_siswa DESC");
    }
    function filterGuru($cabang){
        $where = null;
    
        if($cabang == 'all' OR $cabang == NULL){
            $where .= "";
        }else {
            $where .= "WHERE id_sd= '".$cabang."'";
        }
    
        
    
        return $this->db->query("SELECT * FROM guru  $where ORDER BY id_guru DESC");
    }
    function fitlerKepsek($cabang){
        $where = null;
    
        if($cabang == 'all' OR $cabang == NULL){
            $where .= "";
        }else {
            $where .= "WHERE kepsek_id_sd= '".$cabang."'";
        }
    
        
    
        return $this->db->query("SELECT * FROM kepala_sekolah  $where ORDER BY kepsek_id DESC");
    }
    
    function filterpegawai($bagian,$sub,$kegiatan,$status){
        if($bagian == "all" OR $bagian == NULL){
            $bag = "";
        }else{
            $bag = "AND bagian=".$bagian;
        }

        if($sub == "all" OR $sub == NULL){
            $sb = "";
        }else{
            $sb = "AND sub_bagian=".$sub;
        }

        if($kegiatan == "all" OR $kegiatan == NULL){
            $sk = "";
        }else{
            $sk = "AND sub_kegiatan=".$kegiatan;
        }

      

      

        return $this->db->query("SELECT * FROM pegawai a JOIN subdomain b ON a.id_sd = b.id_sd WHERE aktif = 'y' $bag $sb $sk  ORDER BY id_pegawai DESC");
    }
    function filterpengawas($bagian,$sub,$cabang){
        if($bagian == "all" OR $bagian == NULL){
            $bag = "";
        }else{
            $bag = "AND bagian=".$bagian;
        }

        if($sub == "all" OR $sub == NULL){
            $sb = "";
        }else{
            $sb = "AND sub_bagian=".$sub;
        }

       

        if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
        }else {
            $wc = "AND a.id_sd= '".$cabang."'";
        }

       

        return $this->db->query("SELECT * FROM pengawas a JOIN subdomain b ON a.id_sd = b.id_sd WHERE jabatan IS NOT NULL $bag $sb  $wc  ORDER BY nama_lengkap DESC");
    }
    function search_absensi($start,$end,$telat,$pulang,$ket,$cabang)
    {   

            if($telat == 'all'){
                $telats = '';
            }else{
                $telats = "AND telat='".$telat."'";
            }
            if($pulang=='all'){
                $puls = '';
            }else{
                $puls = "AND pulang_awal='".$pulang."'";
            }
            if($ket == 'all')
            {
                $kets='';
            }else{
                $kets = "AND ket='".$ket."'";
            }

          
             if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
            }else {
                $wc = "AND pegawai.id_sd= '".$cabang."'";
            }

            


            return $this->db->query("SELECT * FROM `absensi` JOIN `pegawai` ON `absensi`.`id_pegawai` = `pegawai`.`id_pegawai` JOIN subdomain ON pegawai.id_sd = subdomain.id_sd WHERE `tanggal` >= '$start' AND `tanggal`<= '$end' AND status_absen = 'pegawai' $telats $puls $kets  $wc  ORDER BY id_absensi DESC");
    }
    function search_absensi_guru($start,$end,$telat,$pulang,$ket,$cabang)
    {   

            if($telat == 'all'){
                $telats = '';
            }else{
                $telats = "AND telat='".$telat."'";
            }
            if($pulang=='all'){
                $puls = '';
            }else{
                $puls = "AND pulang_awal='".$pulang."'";
            }
            if($ket == 'all')
            {
                $kets='';
            }else{
                $kets = "AND ket='".$ket."'";
            }

          
             if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
            }else {
                $wc = "AND guru.id_sd= '".$cabang."'";
            }

            


            return $this->db->query("SELECT * FROM `absensi` JOIN `guru` ON `absensi`.`id_pegawai` = `guru`.`id_guru` JOIN subdomain ON guru.id_sd = subdomain.id_sd WHERE `tanggal` >= '$start' AND `tanggal`<= '$end' AND status_absen = 'guru' $telats $puls $kets  $wc  ORDER BY id_absensi DESC");
    }
    function view_pegawai_sub($cabang,$sts,$kab,$kec,$kel,$sub){
        if($sub  == 0 OR $sub == NULL){
            $wsub = "";
        }else{
            $wsub = "AND a.sub_bagian =".$sub;
        }
        if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
        }else {
                $wc = "AND a.id_sd= '".$cabang."'";
        }

        if($sts == 'kelurahan'){
            $ws = "AND b.kelurahan = '".$kel."'";
        }else if($sts == 'kecamatan'){
            $ws = "AND b.kecamatan = '".$kec."' AND (b.status = 'kelurahan' OR b.status ='kecamatan') ";
        }else if($sts == 'kabupaten'){
            $ws = "AND b.kabupaten = '".$kab."' AND (b.status = 'kelurahan' OR b.status ='kecamatan' OR b.status='kabupaten') ";
        }else {
            $ws = "";
        }

        $query = $this->db->query("SELECT * FROM pegawai a JOIN subdomain b ON a.id_sd = b.id_sd WHERE a.aktif = 'y' $wc $wsub $ws ORDER BY a.nama_lengkap ASC");
        return $query;

}
    function view_guru_cabang($cabang){
        $where  =null;
        if($cabang == 'all'){
            $where = '';
        }else{
            $where = 'AND a.id_sd = "'.$cabang.'"';

        }
        $query = $this->db->query("SELECT * FROM guru a JOIN subdomain b ON a.id_sd = b.id_sd WHERE a.status = 'active' $where ORDER BY id_guru DESC");
        return $query;
    }
function detail_absensi($id,$cabang)
{
        return $this->db->query("SELECT * FROM `absensi` JOIN `pegawai` ON `absensi`.`id_pegawai` = `pegawai`.`id_pegawai` WHERE `id_absensi` = $id AND id_sd = '".$cabang."'");
}
function detail_absensi_guru($id)
{
        return $this->db->query("SELECT * FROM `absensi` JOIN `guru` ON `absensi`.`id_pegawai` = `guru`.`id_guru` WHERE `id_absensi` = $id ");
}
function detail_form($id,$cabang)
    {
            return $this->db->query("SELECT * ,`form_izin`.`status` as status_ket FROM `form_izin` JOIN `pegawai` ON `form_izin`.`id_pegawai` = `pegawai`.`id_pegawai` WHERE `id_form` = $id AND id_sd = $cabang");
    }
    function detail_form_guru($id)
    {
            return $this->db->query("SELECT * ,`form_izin`.`status` as status_ket, form_izin.foto as foto_form FROM `form_izin` JOIN `guru` ON `form_izin`.`id_pegawai` = `guru`.`id_guru` WHERE `id_form` = $id ");
    }
function search_alpha($hari,$sub,$cabang)
    {   

          
            if($sub == 0){
                $sb = '';
            }else{
                $sb = "AND sub_bagian ='".$sub. "'";
            }
             if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
            }else {
                $wc = "AND pegawai.id_sd= '".$cabang."'";
            }



            return $this->db->query("SELECT * FROM `pegawai` JOIN subdomain ON pegawai.id_sd = subdomain.id_sd  JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian`WHERE pegawai.aktif ='y'  $sb $wc  ORDER BY nama_lengkap ASC");
    }
    function data_report($start,$end,$id,$cabang){
        if($id == 'all'){
            $where = '';
        }else{
            $where = "AND `report`.`id_pegawai` = '".$id."'";
        }
      
         if($cabang == 'all' OR $cabang == NULL){
                $wc = "";
            }else {
                    $wc = "AND pegawai.id_sd= '".$cabang."'";
            }

         


         return $this->db->query("SELECT * FROM `report` JOIN `pegawai` ON `report`.`id_pegawai` = `pegawai`.`id_pegawai` JOIN subdomain ON pegawai.id_sd = subdomain.id_sd WHERE status_report = 'pegawai' AND `date` >= '$start' AND `date`<= '$end' $where $wc ORDER BY id_report DESC");
    }
    function data_report_guru($start,$end,$cabang){
        
      
         if($cabang == 'all' OR $cabang == NULL){
                $wc = "";
            }else {
                    $wc = "AND guru.id_sd= '".$cabang."'";
            }

         


         return $this->db->query("SELECT * FROM `report` JOIN `guru` ON `report`.`id_pegawai` = `guru`.`id_guru` JOIN subdomain ON guru.id_sd = subdomain.id_sd WHERE status_report = 'guru' AND `date` >= '$start' AND `date`<= '$end'  $wc ORDER BY id_report DESC");
    }
    function search_izin($start,$end,$status,$cabang){
        if($status == 'all'){
            $where = '';
        }else{
            $where = "AND `form_izin`.`status` = '".$status."'";
        }

     
          if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
            }else {
                $wc = "AND pegawai.id_sd= '".$cabang."'";
            }

         

         return $this->db->query("SELECT *,`form_izin`.`status` as status_ket FROM `form_izin` JOIN `pegawai` ON `form_izin`.`id_pegawai` = `pegawai`.`id_pegawai` JOIN subdomain ON pegawai.id_sd = subdomain.id_sd WHERE `dari` >= '$start' AND `sampai`<= '$end' AND `approved` = 'setuju' AND status_form = 'pegawai' $where   $wc  ORDER BY id_form DESC");
        
        
    }
    function search_izin_guru($start,$end,$status,$cabang){
        if($status == 'all'){
            $where = '';
        }else{
            $where = "AND `form_izin`.`status` = '".$status."'";
        }

     
          if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
            }else {
                $wc = "AND guru.id_sd= '".$cabang."'";
            }

         

         return $this->db->query("SELECT *,`form_izin`.`status` as status_ket FROM `form_izin` JOIN `guru` ON `form_izin`.`id_pegawai` = `guru`.`id_guru` JOIN subdomain ON guru.id_sd = subdomain.id_sd WHERE  `dari` >= '$start' AND `sampai`<= '$end' AND `approved` = 'setuju'  AND status_form = 'guru' $where   $wc  ORDER BY id_form DESC");
        
        
    }
    function view_pegawai($cabang){
        if($cabang == 'all' OR $cabang == NULL){
            $wc = "";
        }else {
                $wc = "AND a.id_sd= '".$cabang."'";
        }

      

        $query = $this->db->query("SELECT * FROM pegawai a JOIN subdomain b ON a.id_sd = b.id_sd WHERE a.aktif = 'y' $wc ORDER BY a.nama_lengkap ASC");
        return $query;

    }
    function detail_report($id,$cabang)
    {
            return $this->db->query("SELECT * FROM `report` JOIN `pegawai` ON `report`.`id_pegawai` = `pegawai`.`id_pegawai` WHERE `id_report` = $id AND id_sd = $cabang");
    }
    function detail_report_guru($id)
    {
            return $this->db->query("SELECT * FROM `report` JOIN `guru` ON `report`.`id_pegawai` = `guru`.`id_guru` WHERE `id_report` = $id");
    }
    function search_lembur($hari,$sub,$cabang){
        if($sub == 0){
              $sb = '';
          }else{
              $sb = "AND b.sub_bagian ='".$sub. "'";
          }
           if($cabang == 'all' OR $cabang == NULL){
          $wc = "";
          }else {
              $wc = "AND b.id_sd= '".$cabang."'";
          }

        
          
      return  $this->db->query("SELECT * FROM lembur a JOIN pegawai b ON a.id_pegawai = b.id_pegawai  JOIN subdomain c ON b.id_sd = c.id_sd WHERE a.date='".$hari."' $sb $wc  ORDER BY id_lembur DESC");

  }
  function data_lembarkinerja($cabang){
    if($cabang == 'all' OR $cabang == NULL){
           $wc = "";
       }else {
               $wc = "AND pegawai.id_sd= '".$cabang."'";
       }

     


    return $this->db->query("SELECT * FROM `pegawai`  JOIN subdomain ON pegawai.id_sd = subdomain.id_sd  JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian`WHERE pegawai.aktif='y' $wc  ORDER BY nama_lengkap ASC");
}
function data_lembarkinerjaguru($cabang){
    if($cabang == 'all' OR $cabang == NULL){
           $wc = "";
       }else {
               $wc = "AND guru.id_sd= '".$cabang."'";
       }

     


    return $this->db->query("SELECT * FROM `guru`  JOIN subdomain ON guru.id_sd = subdomain.id_sd  WHERE guru.status='active' $wc  ORDER BY nama_guru ASC");
}
function dataGaji($sk,$cabang){
    if($cabang == 'all' OR $cabang == NULL){
       $wc = "";
   }else {
       $wc = "AND pegawai.id_sd= '".$cabang."'";
   }


   if($sk == 'all' OR $sk == NULL){
       $where = "";
   }else{
       $where = "AND sub_kegiatan = ".$sk;
   }
   $query = $this->db->query("SELECT * FROM `pegawai`  JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` JOIN subdomain on pegawai.id_sd = subdomain.id_sd WHERE pegawai.aktif = 'y' $where $wc  ORDER BY pegawai.`id_pegawai` DESC");
   return $query;
} 
function get_rank($m,$start,$limit)
{
     return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
    FROM 
    (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE status_poin = 'pegawai' AND MONTH(tanggal) = $m  GROUP BY a.`id_pegawai`
     order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
}
function get_rank_all_c($m,$start,$limit,$cabang)
    {
         return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE MONTH(tanggal) = $m AND b.id_sd = $cabang GROUP BY a.`id_pegawai`
         order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
    }
    function get_rank_bag_c($m,$bag,$start,$limit,$cabang)
    {
         return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE MONTH(tanggal) = $m AND bagian = $bag AND b.id_sd = $cabang GROUP BY a.`id_pegawai`
         order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
    }
    function get_rank_bag_sub_C($m,$bag,$sub,$start,$limit,$cabang)
    {
         return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE MONTH(tanggal) = $m AND bagian = $bag  AND sub_bagian = $sub AND b.id_sd = $cabang GROUP BY a.`id_pegawai`
         order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
    }

     function get_rank_all($m,$start,$limit)
    {
         return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE MONTH(tanggal) = $m GROUP BY a.`id_pegawai`
         order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
    }
    function get_rank_bag($m,$bag,$start,$limit)
    {
         return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE MONTH(tanggal) = $m AND bagian = $bag  GROUP BY a.`id_pegawai`
         order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
    }
    function get_rank_bag_sub($m,$bag,$sub,$start,$limit)
    {
         return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
        FROM 
        (SELECT b.nama_lengkap,b.id_pegawai,b.bagian,b.sub_bagian,b.foto_profile,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `pegawai` b ON a.`id_pegawai` = b.`id_pegawai` WHERE MONTH(tanggal) = $m AND bagian = $bag  AND sub_bagian = $sub  GROUP BY a.`id_pegawai`
         order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
    }
function get_rank_guru($m,$cabang,$start,$limit)
{
     return $this->db->query("SELECT *, @rownum:=@rownum+1 as rank
    FROM 
    (SELECT b.nama_guru,b.id_guru,b.email,b.foto,SUM(poin) as tot_poin FROM `poin_pegawai` a JOIN `guru` b ON a.`id_pegawai` = b.`id_guru` WHERE status_poin = 'guru' AND MONTH(tanggal) = $m AND id_sd = $cabang GROUP BY a.`id_pegawai`
     order by tot_poin desc LIMIT $start,$limit)T,(select @rownum:=0)a");
}
function data_report_pen($bag,$sub,$limit,$start,$cabang){
    if($bag == 'all'){
        $bg = '';
    }else{
        $bg = "AND `pegawai`.`bagian` = '".$bag."'";
    }
    if($sub == 'all'){
        $sb = "";
    }else{
        $sb = "AND `pegawai`.`sub_bagian` ='".$sub."'";
    }


     return $this->db->query("SELECT * FROM `report` JOIN `pegawai` ON `report`.`id_pegawai` = `pegawai`.`id_pegawai` WHERE report.id_pegawai != 0 AND pegawai.id_sd = ".$cabang." $bg $sb ORDER BY id_report DESC LIMIT $start,$limit");
}
function filterKelas($cabang){
    $where = null;

    if($cabang == 'all' OR $cabang == NULL){
        $where .= "";
    }else {
        $where .= "WHERE rk_id_sd= '".$cabang."'";
    }

   
    return $this->db->query("SELECT * FROM ruang_kelas   $where ORDER BY rk_id DESC");
}
}