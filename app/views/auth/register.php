{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}
	<form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
		<div>
			<label for="email">Email</label>
			<input type="text" name="email" id="email" 
				{% if request.post('email') %} value= "{{ request.post('email') }}" {% endif %}
			>
			{% if errors.GetError('email') %} {{ errors.First('email') }} {% endif %}
		</div>
		<div>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" 
				{% if request.post('username') and not errors.ContainsError('username') %} value= "{{ request.post('username') }}" {% endif %}
			>
			{% if errors.GetError('username') %} {{ errors.First('username') }} {% endif %}
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password"
				{% if requset.post('password') and not errors.ContainsError('password') %} value= "{{ request.post('password') }}" {% endif %}
			>
			{% if errors.GetError('password') %} {{ errors.First('password') }} {% endif %}
		</div>
		<div>
			<label for="password_confirm">Password Confirm</label>
			<input type="password" name="password_confirm" id="password_confirm"
				{% if request.post('password_confirm') and not errors.ContainsError('password_confirm') %} value= "{{ request.post('confirm_password') }}" {% endif %}
			>
			{% if errors.GetError('password_confirm') %} {{ errors.First('password_confirm') }} {% endif %}
		</div>
		<div>
			<input type="submit" value="Register">
		</div>
	</form>
{% endblock %}