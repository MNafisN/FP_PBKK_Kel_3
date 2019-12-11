{% block head %}
	<meta charset="utf-8">
    <title>SIMAR</title>  
    {{ assets.outputCss() }}  
{% endblock %}
{% block body %}
    {% if session.get('login')['username'] is 'admin' %}
    <div class="header">
		<div class="header-container">
			SIMAR
		</div>
    </div>
	<div class="content">
        <div class="main-container">
            <div class="tab">
                <div style="text-align: center; padding: 10px 0px">
                    Selamat datang, {{ session.get('login')['username'] }}
                </div>
                <a href="{{ url('/index') }}"><button>Dashboard</button></a>
                <a href="{{ url('bahanbaku/index') }}"><button class="active">Bahan Baku</button></a>
                <a href="{{ url('logmasuk/index') }}"><button>Bahan Baku Masuk</button></a>
                <button>Bahan Baku Keluar</button>
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="{{ url('/index/logout') }}" method="post">
                        <button>Logout</button>
                    </form>
                </div>
            </div>
            
            <div class="tabcontent">
                <div class="container">
                    <div class="card">
                        <h2 class="card-header">Form Tambah Stok Bahan Baku</h2>
                        <div class="content-midcontainer" style="width: 50%!important">
                        <div class="form-login">
                            {{ flashSession.output() }}
                            {{ form('logmasuk/save', 'name': 'logmasuk', 'method': 'post') }}
                            
                                <label for="nama_bahan">Nama Bahan Baku:</label>
                                {{ select('nama_bahan', bahanbaku, 'using': ['nama_bahan', 'nama_bahan'], 'class': 'form-control col-sm-4', 'style': 'width: 100%; margin: 8px 0px') }}
                                
                                <label for="kondisi_bahan">Kondisi Bahan Baku:</label>
                                {{ select_static('kondisi_bahan', [
                                    'Segar': 'Segar', 
                                    'Cukup segar': 'Cukup segar', 
                                    'Hampir basi': 'Hampir basi', 
                                    'Basi': 'Basi', 
                                    'Busuk': 'Busuk'
                                ], 'class': 'form-control col-sm-4', 'style': 'width: 100%; margin: 8px 0px') }}

                                <label for="jumlah_bahan">Jumlah Bahan Baku:</label>
                                {{ numeric_field('jumlah_bahan', 'placeholder': 'Tentukan jumlah bahan baku') }}

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