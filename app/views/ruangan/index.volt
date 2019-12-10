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
                    {% if ruangan is defined %}
                        <h3 class="card-header">Daftar Ruangan</h3>
                        <table class="table table-bordered table-responsive-sm" id="calendar">
                            <thead>
                                <tr>
                                    <th> Nama Ruangan </th>
                                    <th> Lokasi </th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for ruang in ruangan %}
                                <tr>
                                    {{ form('ruangan/detail', 'method': 'post') }}
                                    <td>
                                        {{ hidden_field('id_ruangan', 'value': ruang.id_ruangan) }}
                                        {{ submit_button(ruang.nama_ruangan, 'style': 'all: unset; cursor: pointer') }}
                                    </td>
                                    
                                    <td>
                                        {{ ruang.lokasi_ruangan }}
                                    </td>
                                    {{ end_form() }}
                                </tr> 
                                {% endfor %}
                            </tbody>
                        </table>
                        <a href="{{ url('/ruangan/form') }}">
                            <button class="btn2">Buat Data Ruangan Baru</button>
                        </a>
                    </div>
                    {% endif %}
                </div>
            </div>
		</div>
    </div>
    {% endif %}
{% endblock %}