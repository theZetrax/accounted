{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}
	<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
		<div>
			<label for="identifier">Username/Email</label>
			<input type="text" name="identifier" id="identifier" 
				{% if request.post('identifier') %} value= "{{ request.post('identifier') }}" {% endif %}
			>
			{% if errors.GetError('identifier') %} {{ errors.First('identifier') }} {% endif %}
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password"
				{% if requset.post('password') and not errors.ContainsError('password') %} value= "{{ request.post('password') }}" {% endif %}
			>
			{% if errors.GetError('password') %} {{ errors.First('password') }} {% endif %}
		</div>
		<div>
			<input type="submit" value="Login">
		</div>
	</form>
{% endblock %}