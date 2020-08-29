<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accounted | {% block title %} {% endblock %}</title>
</head>
<body>
	{% include 'templates/partials/messages.php' %}
	{% include 'templates/partials/navigation.php' %}
	{% block content %}
	{% endblock %}
</body>
</html>