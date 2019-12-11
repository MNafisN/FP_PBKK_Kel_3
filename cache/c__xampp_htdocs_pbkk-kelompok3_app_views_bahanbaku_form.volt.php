
	<meta charset="utf-8">
    <title>SIMAR</title>  
    <?= $this->assets->outputCss() ?>  


    <?php if ($this->session->get('login')['username'] == 'admin') { ?>
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
                <a href="<?= $this->url->get('bahanbaku/index') ?>"><button class="active">Bahan Baku</button></a>
                <button>Bahan Baku Masuk</button>
                <button>Bahan Baku Keluar</button>
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="<?= $this->url->get('/index/logout') ?>" method="post">
                        <button>Logout</button>
                    </form>
                </div>
            </div>
            
            <div class="tabcontent">
                <div class="container">
                    <div class="card">
                        <h2 class="card-header">Form Reservasi</h2>
                        <div class="content-midcontainer" style="width: 50%!important">
                        <div class="form-login">
                            <?= $this->flashSession->output() ?>
                            <?= $this->tag->form(['bahanbaku/save', 'name' => 'bahanbaku', 'method' => 'post']) ?>
                            
                                <label for="nama_bahan">Nama Bahan Baku:</label>
                                <?= $this->tag->textField(['nama_bahan', 'placeholder' => 'Masukkan nama bahan baku baru', 'required']) ?>

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
