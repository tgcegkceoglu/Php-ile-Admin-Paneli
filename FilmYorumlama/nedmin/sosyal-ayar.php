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
                                Sosyal Ayarlar
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
                                    <label class="text-sm font-weight-bold text-primary">İnstagram</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?=$ayarcek['ayar_instagram']?>" name="ayar_instagram" id="ayar_instagram"
                                        placeholder="İnstagram">
                                </div>

                                <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Twitter</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?=$ayarcek['ayar_twitter']?>" name="ayar_twitter" id="ayar_twitter"
                                        placeholder="Twitter">
                                </div>

                                <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Youtube</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?=$ayarcek['ayar_youtube']?>" name="ayar_youtube" id="ayar_youtube"
                                        placeholder="Youtube">
                                </div>

                                <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Facebook</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?=$ayarcek['ayar_facebook']?>" name="ayar_facebook" id="ayar_facebook"
                                        placeholder="Facebook">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit" name="sosyalayarkaydet" type="submit">Güncelle</button> 
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