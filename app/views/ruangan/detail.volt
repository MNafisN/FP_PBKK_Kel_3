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
                        <h2 class="card-header">Detail Ruangan</h2>
                        {{ flashSession.output() }}
                        <ul class="list-group">

                            <li class="list-group-item">
                                
                                <span style="width: 25%; white-space: nowrap">Nama Ruangan</span>
                                <span style="flex: 1; white-space: nowrap">: {{ ruangan.nama_ruangan }}</span>
                                    
                            </li>
                            
                            <li class="list-group-item">
                                
                                <span style="width: 25%; white-space: nowrap">Lokasi Ruangan</span>
                                <span style="flex: 1; white-space: nowrap">: {{ ruangan.lokasi_ruangan }}</span>
                                    
                            </li>
                            
                            <li class="list-group-item">
                                <span style="width: 25%; white-space: nowrap">Kapasitas Ruangan</span>
                                <span style="flex: 1; white-space: nowrap">: {{ ruangan.kapasitas_ruangan }}</span>
                            </li>
                            
                        </ul>
                        
                        <div class="card-footer">
                            <div style="display: inline-block; width: max-content">
                                <a href="{{ url('/ruangan') }}"><button class="btn2">Kembali</button></a>
                            </div>
                            <div style="display: block; width: max-content; float: right">
                                {{ form('ruangan/delete', 'method': 'post', 'style': 'margin-block-end: 0px', 'onSubmit': 'return validateForm3()') }}
                                    {{ hidden_field('id_ruangan', 'value': ruangan.id_ruangan) }}
                                    {{ submit_button('Hapus', 'style': 'width: auto; float: right; margin: 0px') }}
                                {{ end_form() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {% endif %}
{% endblock %}