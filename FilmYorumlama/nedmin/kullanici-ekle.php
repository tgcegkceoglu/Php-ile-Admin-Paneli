<?php include 'header.php'; ?>
<style>
    input[type=file]::file-selector-button {
        margin-right: 20px;
        border: none;
        background: #476dda;
        padding: 10px 20px;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
    }
</style>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                                Kullanıcı Düzenleme
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
                            <form class="user" action="netting/islem.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input required type="file" name="resim" />
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Adı Soyadı</label>
                                    <input type="text" class="form-control form-user font-weight-bold" name="kullanici_adsoyad" id="kullanici_adsoyad"
                                        placeholder="Adı Soyadı">
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Mail</label>
                                    <input type="text" class="form-control form-user font-weight-bold" name="kullanici_mail" id="kullanici_mail"
                                        placeholder="Mail">
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Şifre</label>
                                    <input type="password" class="form-control form-user font-weight-bold" name="kullanici_password" id="kullanici_password"
                                        placeholder="Şifre">
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Durum</label>
                                    <div>
                                        <select id="heard" class="form-control" name="kullanici_durum" required>
                                            <option value="1">Aktif</option>
                                            <option value="0">Pasif</option>
                                        </select>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit" name="kullanicikaydet" type="submit">Kaydet</button> 
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
