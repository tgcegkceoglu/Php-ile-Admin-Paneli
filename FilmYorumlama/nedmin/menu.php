<?php 
include 'header.php';
$menusor=$db->prepare("SELECT * FROM menu ORDER BY menu_sira ASC");
$menusor->execute();
 ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Menü Listeleme</h6>
            <a  href="menu-ekle.php"><button class="btn btn-success">Yeni Ekle</button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sıra No</th>
                            <th>Menü Ad</th>
                            <th>Menü Url</th>
                            <th>Menü Sıra</th>
                            <th>Menü Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sıra No</th>
                            <th>Menü Ad</th>
                            <th>Menü Url</th>
                            <th>Menü Sıra</th>
                            <th>Menü Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                         $sayac=0;
                            while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){ $sayac++?>
                            <tr>
                                <td width="20" ><?php echo $sayac?></td>
                                <td><?php echo $menucek['menu_ad']?></td>
                                <td><?php echo $menucek['menu_url']?></td>
                                <td><?php echo $menucek['menu_sira']?></td>
                                <td>
                                <?php 
                                if($menucek['menu_durum'] == 1){?>
                                    <button class="btn btn-success btn-xs" style="margin:auto; display:block;">Aktif</button></td> <?php
                                }
                                else{
                                ?>
                                    <button class="btn btn-danger btn-xs" style="margin:auto; display:block;">Pasif</button></td>
                                <?php } ?>
                                <td><a href="menu-duzenle.php?menu_id=<?php echo $menucek['menu_id'];?>"><button class="btn btn-primary" style="margin:auto; display:block;">Düzenle</button></a></td>
                                <td><a href="netting/islem.php?menu_id=<?php echo $menucek['menu_id'];?>&menusil=ok"><button class="btn btn-danger" style="margin:auto; display:block;">Sil</button></a></td>
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