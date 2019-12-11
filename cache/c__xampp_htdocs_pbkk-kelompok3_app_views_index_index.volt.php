
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
                <a href="<?= $this->url->get('/index') ?>"><button class="active">Dashboard</button></a>
                <?php if ($this->session->get('login')['username'] == 'admin') { ?>
                <a href="<?= $this->url->get('bahanbaku/index') ?>"><button>Bahan Baku</button></a>
                <button>Bahan Baku Masuk</button>
                <button>Bahan Baku Keluar</button>
                <?php } ?>
                <?php if ($this->session->get('login')['username'] != 'admin') { ?>
                <button>Ambil Bahan Baku</button>
                <?php } ?>
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="<?= $this->url->get('/index/logout') ?>" method="post">
                        <button>Logout</button>
                    </form>
                </div>
            </div>

            <div class="tabcontent">
                <div class="container">
                    <?php if ($this->session->get('login')['username'] == 'admin') { ?>
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
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <br>
                    <div class="card">
                    <?php if (isset($keluar)) { ?>
                        <?php if ($this->session->get('login')['username'] == 'admin') { ?>
                        <h3 class="card-header">Histori Bahan Baku Keluar</h3>
                        <?php } ?>
                        <?php if ($this->session->get('login')['username'] != 'admin') { ?>
                        <h3 class="card-header">Histori Bahan Baku Diambil</h3>
                        <?php } ?>
                        <table class="table table-bordered table-responsive-sm" id="calendar">
                            <thead>
                                <tr>
                                    <?php if ($this->session->get('login')['username'] == 'admin') { ?>
                                    <th> Nama Pengambil Bahan </th>
                                    <?php } ?>
                                    <th> Nama Bahan </th>
                                    <th> Kondisi Bahan </th>
                                    <th> Jumlah Bahan </th>
                                    <th> Tanggal Masuk </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($this->session->get('login')['username'] == 'admin') { ?>
                                    <?php foreach ($keluar as $log_keluar) { ?>
                                        <?php foreach ($users as $user) { ?>
                                            <?php foreach ($bahanbaku as $bahan) { ?>
                                                <?php if ($bahan->id_bahan == $log_keluar->id_bahan && $user->id_user == $log_keluar->id_user) { ?>
                                <tr>
                                    <td>
                                        <?= $user->nama_karyawan ?>
                                    </td>

                                    <td>
                                        <?= $bahan->nama_bahan ?>
                                    </td>
                                    
                                    <td>
                                        <?= $log_keluar->kondisi_bahan ?>
                                    </td>
                                    
                                    <td>
                                        <?= $log_keluar->jumlah_bahan ?>
                                    </td>

                                    <td>
                                        <?= $log_keluar->date_keluar ?>
                                    </td>
                                </tr> 
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>

                                <?php if ($this->session->get('login')['username'] != 'admin') { ?>
                                    <?php foreach ($keluar as $log_keluar) { ?>
                                        <?php foreach ($users as $user) { ?>
                                            <?php foreach ($bahanbaku as $bahan) { ?>
                                                <?php if ($bahan->id_bahan == $log_keluar->id_bahan && $user->username == $this->session->get('login')['username']) { ?>
                                <tr>
                                    <td>
                                        <?= $bahan->nama_bahan ?>
                                    </td>

                                    <td>
                                        <?= $log_keluar->kondisi_bahan ?>
                                    </td>

                                    <td>
                                        <?= $log_keluar->jumlah_bahan ?>
                                    </td>
    
                                    <td>
                                        <?= $log_keluar->date_keluar ?>
                                    </td>
                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    </div>
                </div>
            </div>
		</div>
    </div>
    <?php } ?>
