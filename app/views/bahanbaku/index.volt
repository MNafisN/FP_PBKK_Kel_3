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
                        {% if bahanbaku is defined %}
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
                                {% for bahan in bahanbaku %}
                                <tr>
                                    <td>
                                        {{ bahan.nama_bahan }}
                                    </td>
                                    
                                    <td>
                                        {{ bahan.kondisi_bahan }}
                                    </td>
                                    
                                    <td>
                                        {{ bahan.jumlah_bahan }}
                                    </td>
                                </tr> 
                                {% endfor %}
                            </tbody>
                        </table>
                        <a href="{{ url('/bahanbaku/form') }}">
                            <button class="btn2">Tambahkan Jenis Bahan Baku</button>
                        </a>
                        {% endif %}
                    </div>
                </div>
            </div>
		</div>
    </div>
    {% endif %}
{% endblock %}