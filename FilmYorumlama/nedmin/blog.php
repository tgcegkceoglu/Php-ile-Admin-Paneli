<?php 
include 'header.php';
$blogsor=$db->prepare("SELECT * FROM blog");
$blogsor->execute();

 ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Blog Listeleme</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> Sıra </th>
                            <th>Blog Tarihi</th>
                            <th>Blog Adı</th>
                            <th>Kategori</th>
                            <th>Anahtar Kelime</th>
                            <th>Blog Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> Sıra </th>
                            <th>Blog Tarihi</th>
                            <th>Blog Adı</th>
                            <th>Kategori</th>
                            <th>Anahtar Kelime</th>
                            <th>Blog Durum</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                            $sayac=0;
                            while($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC))                                                    
                            { $sayac ++; ?>
                            <tr>
                                <td><?php echo $sayac; ?></td>
                                <td>
                                    <?php 
                                           $zaman=explode(" ",$blogcek['blog_date']);
                                           $zaman = str_replace('/', '-', $zaman[0]);
                                           $zaman = date('d.m.Y', strtotime($zaman));
                                           echo $zaman;
                                    ?>
                                </td>
                                <td><?php echo $blogcek['blog_title']; ?></td>
                                <td><?php echo $blogcek['category_name']; ?></td>
                                <td><?php echo $blogcek['blog_keywords']; ?></td>
                                <?php 
                                if($blogcek['blog_status'] == 1){?>
                                    <td><button class="btn btn-success btn-xs" style="margin:auto; display:block;">Aktif</button></td> <?php
                                }
                                else{
                                ?>
                                    <td><button class="btn btn-danger btn-xs" style="margin:auto; display:block;">Pasif</button></td>
                                <?php } ?>
                                <td><a href="blog-duzenle.php?blog_id=<?php echo $blogcek['blog_id'];?>"><button class="btn btn-primary" style="margin:auto; display:block;">Düzenle</button></a></td>
                                <td><a href="netting/islem.php?blog_id=<?php echo $blogcek['blog_id'];?>&blogsil=ok"><button class="btn btn-danger" style="margin:auto; display:block;">Sil</button></a></td>
                
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