{% extends 'email/templates/default.php' %}

{% block content %}
	<p>You have been registered.</p>

	<p>Activate Your Account using this Link: {{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier }}</p>
{% endblock content %}