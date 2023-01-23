<?php include 'header.php';
   $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
   $kullanicisor->execute(
       array(
           'id' => $_GET['kullanici_id']
       ));
   $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>
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
    input[type=file]{
        color: transparent;
    }
</style>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
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
                                    if (isset($_GET['durum'])) {
                                        if ($_GET['durum'] == "ok") {?>
                                            <b class="btn btn-success">İşlem Başarılı</b> <?php 
                                        }
                                        elseif ($_GET['durum'] == "no"){?>
                                            <b class="btn btn-danger">İşlem Başarısız</b> <?php 
                                        }
                                    }
                                    
                                    if(isset($_GET['size']))    {
                                        if($_GET['size'] == "no"){ 
                                            ?>
                                                <b class="btn btn-danger">Fotoğrafın Boyutu 2MB Büyük Olamaz</b>
                                            <?php 
                                        }
                                    }
                                    
                                    if(isset($_GET['uzanti']))    {
                                    if($_GET['uzanti'] == "no"){ 
                                        ?>
                                            <b class="btn btn-danger">Fotoğraf sadece .jpeg veya .png formatında olmalıdır.</b>
                                        <?php 
                                    }
                                } ?>      
                                </small>
                            </div>
                            <form class="user" action="netting/islem.php" method="POST" enctype="multipart/form-data">
                                <?php 
                                    $zaman=explode(" ",$kullanicicek['kullanici_zaman']);
                                ?>
                                <div class="form-group">
                                    <img style="width: 150px; height: 150px; object-fit: cover;" src="http://localhost/SunucuTabanliProgramlama/FilmYorumlama/images/author/<?php echo $kullanicicek['kullanici_resim'] ?>" id="imgshow">
                                    <input type="file" name="resim" id="resim" />
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Kayıt Tarihi</label>
                                    <input type="date" disabled class="form-control form-user font-weight-bold"  value="<?php echo $zaman[0]?>" name="kullanici_zaman" id="kullanici_zaman"
                                        placeholder="Kayıt Tarihi">
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Adı Soyadı</label>
                                    <input type="text" class="form-control form-user font-weight-bold"  value="<?=$kullanicicek['kullanici_adsoyad']?>" name="kullanici_adsoyad" id="kullanici_adsoyad"
                                        placeholder="Adı Soyadı">
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Mail</label>
                                    <input disabled type="text" class="form-control form-user font-weight-bold"  value="<?=$kullanicicek['kullanici_mail']?>" name="kullanici_mail" id="kullanici_mail"
                                        placeholder="Mail">
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Durum</label>
                                    <div>
                                        <select id="heard" class="form-control" name="kullanici_durum" required>
                                            <option value="1" <?php echo $kullanicicek['kullanici_durum'] =='1' ? 'selected=""' : ''; ?>>Aktif</option>
                                            <option value="0" <?php echo $kullanicicek['kullanici_durum'] =='0' ? 'selected=""' : ''; ?>>Pasif</option>
                                        </select>
                                    </div>
                                </div>


                                <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']?>">        
                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit" name="kullaniciduzenle" type="submit">Güncelle</button> 
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
    <script>
    $('document').ready(function () {
    $("#resim").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#button").click(function(){
        console.log($_FILES['resim']);
    });
    });
    </script>
<?php include 'footer.php' ?>
