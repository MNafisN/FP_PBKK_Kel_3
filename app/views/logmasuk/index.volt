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
                <a href="{{ url('bahanbaku/index') }}"><button>Bahan Baku</button></a>
                <a href="{{ url('logmasuk/index') }}"><button class="active">Bahan Baku Masuk</button></a>
                <a href="{{ url('logkeluar/index') }}"><button>Bahan Baku Keluar</button></a>
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="{{ url('/index/logout') }}" method="post">
                        <button>Logout</button>
                    </form>
                </div>
            </div>

            <div class="tabcontent">
                <div class="container">
                    <div class="card">
                        {% if masuk is defined %}
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
                                {% for log_masuk in masuk %}
                                    {% for bahan in bahanbaku %}
                                        {% if bahan.id_bahan is log_masuk.id_bahan %}
                                <tr>
                                    <td>
                                        {{ bahan.nama_bahan }}
                                    </td>
                                    
                                    <td>
                                        {{ log_masuk.kondisi_bahan }}
                                    </td>
                                    
                                    <td>
                                        {{ log_masuk.jumlah_bahan }}
                                    </td>

                                    <td>
                                        {{ log_masuk.date_masuk }}
                                    </td>
                                </tr> 
                                        {% endif %}
                                    {% endfor %}
                                {% endfor %}
                            </tbody>
                        </table>
                        <a href="{{ url('/logmasuk/form') }}">
                            <button class="btn2">Tambahkan Stok Bahan Baku</button>
                        </a>
                        {% endif %}
                    </div>
                </div>
            </div>
		</div>
    </div>
    {% endif %}
{% endblock %}