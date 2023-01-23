<?php 
include 'header.php';
$kategorisor=$db->prepare("SELECT * FROM kategori ORDER BY kategori_sira ASC");
$kategorisor->execute();

 ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kategori Listeleme</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sıra No</th>
                            <th>Kategori Ad</th>
                            <th>Kategori Sıra</th>
                            <th>Kategori Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sıra No</th>
                            <th>Kategori Ad</th>
                            <th>Kategori Sıra</th>
                            <th>Kategori Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                         $sayac=0;
                            while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ $sayac++?>
                            <tr>
                                <td width="20" ><?php echo $sayac?></td>
                                <td><?php echo $kategoricek['kategori_ad']?></td>
                                <td><?php echo $kategoricek['kategori_sira']?></td>
                                <td>
                                <?php 
                                if($kategoricek['kategori_durum']== 1){?>
                                    <button class="btn btn-success btn-xs" style="margin:auto; display:block;">Aktif</button></td> <?php
                                }
                                else{
                                ?>
                                    <button class="btn btn-danger btn-xs" style="margin:auto; display:block;">Pasif</button></td>
                                <?php } ?>
                                <td><a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id'];?>"><button class="btn btn-primary" style="margin:auto; display:block;">Düzenle</button></a></td>
                                <td><a href="netting/islem.php?kategori_id=<?php echo $kategoricek['kategori_id'];?>&kategorisil=ok"><button class="btn btn-danger" style="margin:auto; display:block;">Sil</button></a></td>
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