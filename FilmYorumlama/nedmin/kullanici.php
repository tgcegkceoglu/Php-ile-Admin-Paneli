<?php 
include 'header.php';
$kullanicisor=$db->prepare("SELECT * FROM kullanici");
$kullanicisor->execute();
 ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Listeleme</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Kayıt Tarihi</th>
                            <th>Adı Soyadı</th>
                            <th>Mail Adresi</th>
                            <th>Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Kayıt Tarihi</th>
                            <th>Adı Soyadı</th>
                            <th>Mail Adresi</th>
                            <th>Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                            while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){ 
                            $zaman=explode(" ",$kullanicicek['kullanici_zaman']);
                            $zaman = str_replace('/', '-', $zaman[0]);
                            $zaman = date('d.m.Y', strtotime($zaman));    
                            ?>
                            <tr>
                                <td><img style="width: 100px; height: 100px; object-fit: cover; margin:auto; display:block;" src="http://localhost/SunucuTabanliProgramlama/FilmYorumlama/images/author/<?php echo $kullanicicek['kullanici_resim'] ?>" id="imgshow"></td>
                                <td><?php echo $zaman ?></td>
                                <td><?php echo $kullanicicek['kullanici_adsoyad']?></td>
                                <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                                <?php 
                                    if($kullanicicek['kullanici_durum'] == "1"){?>
                                        <td><button class="btn btn-success btn-xs" style="margin:auto; display:block;">Aktif</button></td> <?php
                                    }
                                    else{
                                    ?>
                                        <td><button class="btn btn-danger btn-xs" style="margin:auto; display:block;">Pasif</button></td>
                                    <?php } ?>
                                <td><a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'];?>"><button class="btn btn-primary" style="margin:auto; display:block;">Düzenle</button></a></td>
                                <td><a href="netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'];?>&kullanicisil=ok"><button class="btn btn-danger" style="margin:auto; display:block;">Sil</button></a></td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php 
  include 'footer.php';
?>