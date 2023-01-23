<?php include 'header.php' ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                                Genel Ayarlar
                                <small class="float-right">
                                 <?php      
                                  if(isset($_GET['durum']))    {
                                    if($_GET['durum'] == "ok"){ 
                                        ?>
                                            <b class="btn btn-success">İşlem Başarılı</b>
                                                
                                        <?php }
                                        elseif($_GET['durum'] == "no"){ 
                                            ?>
                                                <b class="btn btn-danger">İşlem Başarısız</b>                                         
                                            <?php }
                                   
                                  }      ?>        
                                    </small>
                            </div>
                            <form class="user" action="netting/islem.php" method="POST">
                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Site Başlığı</label>
                                    <input type="text" class="form-control form-user font-weight-bold"  value="<?=$ayarcek['ayar_title']?>" name="ayar_title" id="ayar_title"
                                        placeholder="Site Başlığı">
                                </div>

                                <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Site Açıklaması</label>
                                    <input type="text" class="form-control form-user font-weight-bold"  value="<?=$ayarcek['ayar_description']?>" name="ayar_description" id="ayar_description"
                                        placeholder="Site Açıklaması">
                                </div>

                                <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Site Anahtar Kelime</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?=$ayarcek['ayar_keywords']?>" name="ayar_keywords" id="ayar_description"
                                        placeholder="Site Anahtar Kelime">
                                </div>

                                <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Site Yazarı</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?=$ayarcek['ayar_author']?>" name="ayar_author" id="ayar_author"
                                        placeholder="Site Yazarı">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit" name="genelayarkaydet" type="submit">Güncelle</button> 
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
<?php include 'footer.php' ?>
