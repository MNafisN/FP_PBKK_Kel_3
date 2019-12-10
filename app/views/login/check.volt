{% block head %}
	<meta charset="utf-8">
	<title>SIRUPAT</title>
    {{ assets.outputCss() }}
{% endblock %}
{% block body %}

    {% if admin is defined %}
        <h1>user is defined</h1>
        <table class="table table-bordered table-responsive-sm">
            <tr>
                <th> Username </th>
                <th> Email </th>
                <th> Nama </th>
            </tr>
            <tr>
                <td>{{ admin.username }}</td>
                <td>{{ admin.email }}</td>
                <td>{{ admin.nama_pegawai }}</td>
            </tr>
        </table>
        <!-- {% for user in admin %}
            {% if loop.first %}
                <table class="table table-bordered table-responsive-sm">
                    <tr>
                        <th> Username </th>
                        <th> Email </th>
                        <th> Nama </th>
                    </tr>
            {% endif %}
                    <tr>
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.nama_pegawai }}</td>
                    </tr>
            {% if loop.last %}
                </table>
            {% endif %}
        {% endfor %} -->
    {% endif %}
{% endblock %}