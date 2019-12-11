
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
                <a href="<?= $this->url->get('bahanbaku/index') ?>"><button>Bahan Baku</button></a>
                <a href="<?= $this->url->get('logmasuk/index') ?>"><button class="active">Bahan Baku Masuk</button></a>
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
                        <?php if (isset($masuk)) { ?>
                        <h3 class="card-header">Histori Bahan Baku Masuk</h3>
                        <table class="table table-bordered table-responsive-sm" id="calendar">
                            <thead>
                                <tr>
                                    <th> Nama Bahan </th>
                                    <th> Kondisi Bahan </th>
                                    <th> Jumlah Bahan </th>
                                    <th> Tanggal Keluar </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($masuk as $log_masuk) { ?>
                                    <?php foreach ($bahanbaku as $bahan) { ?>
                                        <?php if ($bahan->id_bahan == $log_masuk->id_bahan) { ?>
                                <tr>
                                    <td>
                                        <?= $bahan->nama_bahan ?>
                                    </td>
                                    
                                    <td>
                                        <?= $log_masuk->kondisi_bahan ?>
                                    </td>
                                    
                                    <td>
                                        <?= $log_masuk->jumlah_bahan ?>
                                    </td>

                                    <td>
                                        <?= $log_masuk->date_masuk ?>
                                    </td>
                                </tr> 
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="<?= $this->url->get('/logmasuk/form') ?>">
                            <button class="btn2">Tambahkan Stok Bahan Baku</button>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
		</div>
    </div>
    <?php } ?>
