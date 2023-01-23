<?php include 'header.php';?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                            Kategori Ekle
                            <small class="float-right">
                                <?php
                                if (isset($_GET['durum'])) {
                                    if ($_GET['durum'] == "ok") {
                                ?>
                                        <b class="btn btn-success">İşlem Başarılı</b>

                                    <?php } elseif ($_GET['durum'] == "no") {
                                    ?>
                                        <b class="btn btn-danger">İşlem Başarısız</b>
                                <?php }
                                }      ?>
                            </small>
                        </div>
                        <form class="user" action="netting/islem.php" method="POST">
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Kategori Adı</label>
                                <input type="text" class="form-control form-user font-weight-bold" name="kategori_ad" id="kategori_ad" placeholder="Ad">
                            </div>
                            
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Kategori Sıra</label>
                                <input type="text" class="form-control form-user font-weight-bold"  name="kategori_sira" id="kategori_sira" placeholder="Sıra">
                            </div>

                            <div class="form-group">
                                 <label class="text-sm font-weight-bold text-primary">Üst Kategori</label>
                                 <div>
                                    <select id="heard" class="form-control" name="kategori_ust">
                                        <?php 
                                        $menusor = $db->prepare("SELECT * FROM menu");
                                        $menusor->execute();
                                        while($menucek = $menusor->fetch(PDO::FETCH_ASSOC)){ ?>
                                          <option value="<?php echo $menucek['menu_id'] ?>"><?php echo $menucek['menu_ad'] ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Kategori Durum</label>
                                <div>
                                    <select class="form-control" name="kategori_durum" required>
                                        <option value="1" >Aktif</option>
                                        <option value="0" >Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right" type="submit" name="kategoriekle" type="submit">Kaydet</button>
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