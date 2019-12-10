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
                <a href="{{ url('/index') }}"><button>Reservasi</button></a>
                <a href="{{ url('/ruangan') }}"><button class="active">Ruang Rapat</button></a>
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
                        <h2 class="card-header">Form Ruangan</h2>
                        <div class="content-midcontainer" style="width: 50%!important">
                        <div class="form-login">
                            {{ flashSession.output() }}
                            {{ form('ruangan/save', 'name': 'ruangan', 'method': 'post') }}
                            
                                <label for="nama_ruangan">Nama Ruangan:</label>
                                {{ text_field('nama_ruangan', 'placeholder': 'Masukkan nama ruangan', 'required') }}

                                <label for="lokasi_ruangan">Lokasi Ruangan:</label>
                                {{ text_field('lokasi_ruangan', 'placeholder': 'Masukkan lokasi ruangan', 'required') }}

                                <label for="kapasitas_ruangan">Kapasitas Ruangan:</label>
                                {{ numeric_field('kapasitas_ruangan', 'placeholder': 'Tentukan kapasitas ruangan') }}

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