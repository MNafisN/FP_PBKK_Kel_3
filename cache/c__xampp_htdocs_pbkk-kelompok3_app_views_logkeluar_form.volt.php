
	<meta charset="utf-8">
    <title>SIMAR</title>  
    <?= $this->assets->outputCss() ?>  


    <?php if ($this->session->has('login')) { ?>    
    <div class="header">
		<div class="header-container">
			SIMAR
		</div>
    </div>
	<div class="content">
        <div class="main-container">
            <div class="tab">
                <div style="text-align: center; padding: 10px 0px">
                    Selamat datang, <?= $this->session->get('login')['username'] ?>
                </div>
                <a href="<?= $this->url->get('/index') ?>"><button>Dashboard</button></a>
                <?php if ($this->session->get('login')['username'] == 'admin') { ?>
                <a href="<?= $this->url->get('bahanbaku/index') ?>"><button>Bahan Baku</button></a>
                <a href="<?= $this->url->get('logmasuk/index') ?>"><button>Bahan Baku Masuk</button></a>
                <a href="<?= $this->url->get('logkeluar/index') ?>"><button class="active">Bahan Baku Keluar</button></a>
                <?php } ?>
                <?php if ($this->session->get('login')['username'] != 'admin') { ?>
                <a href="<?= $this->url->get('logkeluar/index') ?>"><button class="active">Ambil Bahan Baku</button></a>
                <?php } ?>
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="<?= $this->url->get('/index/logout') ?>" method="post">
                        <button>Logout</button>
                    </form>
                </div>
            </div>
            
            <div class="tabcontent">
                <div class="container">
                    <div class="card">
                        <h2 class="card-header">Form Ambil Stok Bahan Baku</h2>
                        <div class="content-midcontainer" style="width: 50%!important">
                        <div class="form-login">
                            <?= $this->flashSession->output() ?>
                            <?= $this->tag->form(['logkeluar/save', 'name' => 'logkeluar', 'method' => 'post']) ?>
                            
                                <?php if ($this->session->get('login')['username'] == 'admin') { ?>
                                    <label for="username">Nama Pengambil Bahan:</label>
                                    <?= $this->tag->select(['username', $users, 'using' => ['username', 'nama_karyawan'], 'class' => 'form-control col-sm-4', 'style' => 'width: 100%; margin: 8px 0px']) ?>
                                <?php } ?>

                                <?php if ($this->session->get('login')['username'] != 'admin') { ?>
                                    <?= $this->tag->hiddenField(['username', 'value' => $this->session->get('login')['username']]) ?>
                                <?php } ?>

                                <label for="nama_bahan">Nama Bahan Baku:</label>
                                <?= $this->tag->select(['nama_bahan', $bahanbaku, 'using' => ['nama_bahan', 'nama_bahan'], 'class' => 'form-control col-sm-4', 'style' => 'width: 100%; margin: 8px 0px']) ?>
                                
                                <label for="kondisi_bahan">Kondisi Bahan Baku:</label>
                                <?= $this->tag->selectStatic(['kondisi_bahan', ['Segar' => 'Segar', 'Cukup segar' => 'Cukup segar', 'Hampir basi' => 'Hampir basi', 'Basi' => 'Basi', 'Busuk' => 'Busuk'], 'class' => 'form-control col-sm-4', 'style' => 'width: 100%; margin: 8px 0px']) ?>

                                <label for="jumlah_bahan">Jumlah Bahan Baku:</label>
                                <?= $this->tag->numericField(['jumlah_bahan', 'placeholder' => 'Tentukan jumlah bahan baku']) ?>

                                <?= $this->tag->submitButton(['Confirm']) ?>

                            <?= $this->tag->endForm() ?>
                        </div></div>
                    </div>
                </div>
            </div>
		</div>
    </div>
    <?php } ?>
