{% if auth %}
	<p>Hello {{ auth.getFirstNameOrUsername() }}</p>
{% else %}
	<p>Hello, there</p>
{% endif %}

{% block content %}{% endblock content %}