{% block head %}
	<meta charset="utf-8">
    <title>SIRUPAT</title>  
    {{ assets.outputCss() }}  
{% endblock %}
{% block body %}
    {% if session.has('login') %}
	<div class="header">
		<div class="header-container">
			SIRUPAT
		</div>
    </div>
	<div class="content">
        <div class="main-container">
            <div class="tab">
                <div style="text-align: center; padding: 10px 0px">
                    Selamat datang, {{ session.get('login')['username'] }}
                </div>
                <a href="{{ url('/index') }}"><button class="active">Reservasi</button></a>
                <a href="{{ url('/ruangan') }}"><button>Ruang Rapat</button></a>
                <a href="{{ url('/fasilitas') }}"><button>Fasilitas</button></a>
                <button>Konsumsi</button>
                <button>Vendor</button>
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="{{ url('/index/logout') }}" method="post">
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
                            {{ flashSession.output() }}
                            {{ javascript_include('js/query.js') }}
                            {{ form('index/save', 'name': 'reservasi', 'method': 'post') }}
                            
                                <label for="no_surat">No. Surat:</label>
                                {{ text_field('no_surat', 'placeholder': 'Masukkan nomor surat', 'max-length': 10, 'required') }}

                                <label for="id_peminjam">Nama Peminjam:</label>
                                {{ select('id_peminjam', users, 'using': ['id_user', 'nama_pegawai'], 'class': 'form-control col-sm-4', 'style': 'width: 100%; margin: 8px 0px') }}

                                <label for="id_ruangan">Nama Ruangan:</label>
                                {{ select('id_ruangan', ruangan, 'using': ['id_ruangan', 'nama_ruangan'], 'class': 'form-control col-sm-4', 'style': 'width: 100%; margin: 8px 0px') }}

                                <label for="nama_agenda">Nama agenda:</label>
                                {{ text_field('nama_agenda', 'placeholder': 'Masukkan nama agenda', 'required') }}

                                <label for="deskripsi">Deskripsi:</label>
                                {{ text_field('deskripsi', 'placeholder': 'Masukkan deskripsi agenda') }}

                                <label for="waktu_awal">Tentukan waktu mulai agenda:</label> <br>
                                {{ date_field('date_awal', 'style': 'width: calc(50% - 3px)') }}
                                {{ time_field('time_awal', 'style': 'width: calc(50% - 3px)') }}

                                <label for="waktu_akhir">Tentukan waktu agenda berakhir:</label> <br>
                                {{ date_field('date_akhir', 'style': 'width: calc(50% - 3px)') }}
                                {{ time_field('time_akhir', 'style': 'width: calc(50% - 3px)') }}

                                <label for="jumlah_peserta">Jumlah Partisipan:</label>
                                {{ numeric_field('jumlah_peserta', 'placeholder': 'Tentukan jumlah partisipan') }}

                                {{ submit_button('Confirm') }}

                            {{ end_form() }}
                        </div></div>
                    </div>
                </div>
            </div>
		</div>
    </div>
    {% endif %}
{% endblock %}