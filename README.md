<html>
<head>
</head>
	<body>
		<h1>Setup technical_interview_task:</h1>
		<ol>
			<li>Create a new MySQL database named technical_interview_task</li>
			<li>Copy the <code>.env.example</code> file to <code>.env</code> and update the database configuration with your database username, password, and hostname.</li>
			<li>Run <code>composer update</code> to install the PHP dependencies.</li>
			<li>Run <code>php artisan migrate</code> to create the necessary database tables.</li>
			<li>Run <code>php artisan db:seed</code> to seed the database with initial data.</li>
			<li>Run <code>npm install</code> to install the necessary Node.js packages.</li>
			<li>Run <code>npm run dev</code> to compile the front-end assets.</li>
			<li>Run the following command to optimize the application and start the server:</li>
		</ol>
		<pre><code>php artisan optimize &amp;&amp; php artisan route:cache &amp;&amp; php artisan config:clear &amp;&amp; php artisan cache:clear &amp;&amp; php artisan serve</code></pre>
		<p>Use the following credentials to log in:</p>
		<ul>
			<li>Email: <code>test@example.com</code></li>
			<li>Password: <code>123456789</code></li>
		</ul>
		<p>That's it! You should now be able to access the application at <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>.</p>
	</body>
</html>
