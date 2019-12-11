
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
                        <?php if (isset($bahanbaku)) { ?>
                        <h3 class="card-header">Daftar Bahan Baku</h3>
                        <table class="table table-bordered table-responsive-sm" id="calendar">
                            <thead>
                                <tr>
                                    <th> Nama Bahan </th>
                                    <th> Kondisi Bahan </th>
                                    <th> Jumlah Bahan </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bahanbaku as $bahan) { ?>
                                <tr>
                                    <td>
                                        <?= $bahan->nama_bahan ?>
                                    </td>
                                    
                                    <td>
                                        <?= $bahan->kondisi_bahan ?>
                                    </td>
                                    
                                    <td>
                                        <?= $bahan->jumlah_bahan ?>
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="<?= $this->url->get('/bahanbaku/form') ?>">
                            <button class="btn2">Tambahkan Jenis Bahan Baku</button>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
		</div>
    </div>
    <?php } ?>
