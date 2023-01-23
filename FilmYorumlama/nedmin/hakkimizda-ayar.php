<?php include 'header.php';
include 'netting/baglan.php';
$hakkimizdasor = $db->prepare("SELECT * FROM hakkimizda");
$hakkimizdasor->execute();
$hakkimizdacek = $hakkimizdasor->fetch(PDO::FETCH_ASSOC);
$sayac = $hakkimizdasor->rowCount();

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
<div class="container-fluid">,
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                            Hakkımızda Ayarları
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
                        <?php if($sayac != 0 ){ ?>
                            <form class="user" action="netting/islem.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                <img style="width: 150px; height: 150px; object-fit: cover; <?php if($hakkimizdacek['hakkimizda_resim'] == null){?> display: none; <?php } ?>"  src="http://localhost/SunucuTabanliProgramlama/FilmYorumlama/images/kategori/<?php echo $hakkimizdacek['hakkimizda_resim'] ?>"  id="imgshow">
                                    <input type="file" name="resim" id="resim" />
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Hakkımızda Başlığı</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?= $hakkimizdacek['hakkimizda_baslik'] ?>" name="hakkimizda_baslik" id="hakkimizda_baslik" placeholder="Hakkımızda Başlığı">
                                </div>
                                <div class="form-group ">
                                    <label class="text-sm font-weight-bold text-primary">Hakkımızda İçerik</label>
                                    <textarea id="editor" name="hakkimizda_icerik"><?=$hakkimizdacek['hakkimizda_icerik']?></textarea>
                                
                                </div> 
                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Hakkımızda Vizyon</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?= $hakkimizdacek['hakkimizda_vizyon'] ?>" name="hakkimizda_vizyon" id="hakkimizda_vizyon" placeholder="Hakkımızda Vizyon">
                                </div>

                                <div class="form-group">
                                    <label class="text-sm font-weight-bold text-primary">Hakkımızda Misyon</label>
                                    <input type="text" class="form-control form-user font-weight-bold" value="<?= $hakkimizdacek['hakkimizda_misyon'] ?>" name="hakkimizda_misyon" id="hakkimizda_misyon" placeholder="Hakkımızda Misyon">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit" name="hakkimizdaayarkaydet" type="submit">Güncelle</button>
                                </div>

                            </form>
                        <?php } else{ ?>
                            <form class="user" action="netting/islem.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <img style="width: 150px; height: 150px; object-fit: cover;"  id="imgshow">
                                <input type="file" name="resim" id="resim" />
                            </div>
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Hakkımızda Başlığı</label>
                                <input required type="text" class="form-control form-user font-weight-bold" name="hakkimizda_baslik" id="hakkimizda_baslik" placeholder="Hakkımızda Başlığı">
                            </div>
                            <div class="form-group ">
                                <label class="text-sm font-weight-bold text-primary">Hakkımızda İçerik</label>
                                <textarea id="editor" name="hakkimizda_icerik"></textarea>
                                
                            </div> 
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Hakkımızda Vizyon</label>
                                <input required type="text" class="form-control form-user font-weight-bold" name="hakkimizda_vizyon" id="hakkimizda_vizyon" placeholder="Hakkımızda Vizyon">
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Hakkımızda Misyon</label>
                                <input required type="text" class="form-control form-user font-weight-bold" name="hakkimizda_misyon" id="hakkimizda_misyon" placeholder="Hakkımızda Misyon">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right" type="submit" name="hakkimizdaayarkaydet" type="submit">Güncelle</button>
                            </div>
                        </form>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function () {
    $("#resim").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
                let image=document.getElementById("imgshow");
                image.style.display="inline";
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#button").click(function(){
        console.log($_FILES['resim']);
    });
    });
    </script>
<!-- End of Main Content -->
<?php include 'footer.php'; 