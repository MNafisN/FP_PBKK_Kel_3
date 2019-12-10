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
                <a href="{{ url('/ruangan') }}"><button>Ruang Rapat</button></a>
                <a href="{{ url('/fasilitas') }}"><button class="active">Fasilitas</button></a>
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
                    {% if fasilitas is defined %}
                        <h3 class="card-header">Daftar Fasilitas Ruangan</h3>
                        <table class="table table-bordered table-responsive-sm" id="calendar">
                            <thead>
                                <tr>
                                    <th> Nama Fasilitas </th>
                                    <th> Nama Ruangan </th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for fasil in fasilitas %}
                                    {% for ruang in ruangan %}
                                        {% if ruang.id_ruangan is fasil.id_ruangan %}
                                <tr>
                                    {{ form('fasilitas/detail', 'method': 'post') }}
                                    <td>
                                        {{ hidden_field('id_fasilitas', 'value': fasil.id_fasilitas) }}
                                        {{ submit_button(fasil.nama_fasilitas, 'style': 'all: unset; cursor: pointer') }}
                                    </td>
                                    
                                    <td>
                                        {{ hidden_field('id_ruangan', 'value': ruang.id_ruangan) }}
                                        {{ ruang.nama_ruangan }}
                                    </td>
                                    {{ end_form() }}
                                </tr>
                                        {% endif %}
                                    {% endfor %} 
                                {% endfor %}
                            </tbody>
                        </table>
                        <a href="{{ url('/fasilitas/form') }}">
                            <button class="btn2">Buat Data Fasilitas Baru</button>
                        </a>
                    </div>
                    {% endif %}
                </div>
            </div>
		</div>
    </div>
    {% endif %}
{% endblock %}