{% block head %}
	<meta charset="utf-8">
	<title>SIMAR</title>
    {{ assets.outputCss() }}
{% endblock %}
{% block body %}
    {% if session.has('login') %}
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
                <a href="{{ url('/index') }}"><button class="active">Dashboard</button></a>
                {% if session.get('login')['username'] is 'admin' %}
                <a href="{{ url('bahanbaku/index') }}"><button>Bahan Baku</button></a>
                <a href="{{ url('logmasuk/index') }}"><button>Bahan Baku Masuk</button></a>
                <button>Bahan Baku Keluar</button>
                {% endif %}
                {% if session.get('login')['username'] is not 'admin' %}
                <button>Ambil Bahan Baku</button>
                {% endif %}
                <div style="bottom: 0px; width: inherit; position: absolute">
                    <form action="{{ url('/index/logout') }}" method="post">
                        <button>Logout</button>
                    </form>
                </div>
            </div>

            <div class="tabcontent">
                <div class="container">
                    {% if session.get('login')['username'] is 'admin' %}
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
                        {% endif %}
                    </div>
                    {% endif %}
                    <br>
                    <div class="card">
                    {% if keluar is defined %}
                        {% if session.get('login')['username'] is 'admin' %}
                        <h3 class="card-header">Histori Bahan Baku Keluar</h3>
                        {% endif %}
                        {% if session.get('login')['username'] is not 'admin' %}
                        <h3 class="card-header">Histori Bahan Baku Diambil</h3>
                        {% endif %}
                        <table class="table table-bordered table-responsive-sm" id="calendar">
                            <thead>
                                <tr>
                                    {% if session.get('login')['username'] is 'admin' %}
                                    <th> Nama Pengambil Bahan </th>
                                    {% endif %}
                                    <th> Nama Bahan </th>
                                    <th> Kondisi Bahan </th>
                                    <th> Jumlah Bahan </th>
                                    <th> Tanggal Masuk </th>
                                </tr>
                            </thead>
                            <tbody>
                                {% if session.get('login')['username'] is 'admin' %}
                                    {% for log_keluar in keluar %}
                                        {% for user in users %}
                                            {% for bahan in bahanbaku %}
                                                {% if bahan.id_bahan is log_keluar.id_bahan and user.id_user is log_keluar.id_user %}
                                <tr>
                                    <td>
                                        {{ user.nama_karyawan }}
                                    </td>

                                    <td>
                                        {{ bahan.nama_bahan }}
                                    </td>
                                    
                                    <td>
                                        {{ log_keluar.kondisi_bahan }}
                                    </td>
                                    
                                    <td>
                                        {{ log_keluar.jumlah_bahan }}
                                    </td>

                                    <td>
                                        {{ log_keluar.date_keluar }}
                                    </td>
                                </tr> 
                                                {% endif %}
                                            {% endfor %}
                                        {% endfor %}
                                    {% endfor %}
                                {% endif %}

                                {% if session.get('login')['username'] is not 'admin' %}
                                    {% for log_keluar in keluar %}
                                        {% for user in users %}
                                            {% for bahan in bahanbaku %}
                                                {% if bahan.id_bahan is log_keluar.id_bahan and user.username is session.get('login')['username'] %}
                                <tr>
                                    <td>
                                        {{ bahan.nama_bahan }}
                                    </td>

                                    <td>
                                        {{ log_keluar.kondisi_bahan }}
                                    </td>

                                    <td>
                                        {{ log_keluar.jumlah_bahan }}
                                    </td>
    
                                    <td>
                                        {{ log_keluar.date_keluar }}
                                    </td>
                                </tr>
                                                {% endif %}
                                            {% endfor %}
                                        {% endfor %}
                                    {% endfor %}
                                {% endif %}
                            </tbody>
                        </table>
                    {% endif %}
                    </div>
                </div>
            </div>
		</div>
    </div>
    {% endif %}
{% endblock %}