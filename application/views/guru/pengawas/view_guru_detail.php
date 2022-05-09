<div class="container">
    <div class="row">
        <div class="col-6 form-group my-3">
            <label for="">Nama</label>
            <h6><?=$row['nama_guru'] ?></h6>
        </div>
        <div class="col-6 form-group my-3">
            <label for="">NIP</label>
            <h6><?= $row['nip']?></h6>
        </div>
        <div class="col-6 form-group my-3">
            <label for="">Tempat Tanggal Lahir</label>
            <h6><?= $row['tempat_lahir']?>, <?= date('d-m-Y',strtotime($row['tanggal_lahir']))?></h6>
        </div>
        <div class="col-6 form-group my-3">
            <label for="">Agama</label>
            <h6><?= ucfirst($row['agama'])?></h6>
        </div>
        <div class="col-7 form-group my-3">
            <label for="">Email</label>
            <h6><?= $row['email']?></h6>
        </div>
        <div class="col-5 form-group my-3">
            <label for="">Phone</label>
            <h6><?= $row['hp']?></h6>
        </div>
        <div class="col-12 form-group my-3">
            <label for="">Alamat</label>
            <h6><?= $row['alamat']?></h6>
        </div>
        <div class="col-8 form-group my-3">
            <label for="">Status Kepegawaian</label>
            <h6><?= $row['status_kepegawaian']?></h6>
        </div>
        <div class="col-4 form-group my-3">
            <label for="">Jenis PTK</label>
            <h6><?= $row['jenis_ptk']?></h6>
        </div>

    </div>
</div>