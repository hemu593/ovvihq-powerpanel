<h1>### How do I get set up? ### </h1>
<ul>
	<li> The git repo must be located/cloned in www root directory, it should not be located in any sub-directory</li>
	<li> Set PHP version to 7.4.x</li>
	<li> Create directories like below in the root path of the project</li>
		<li> Storage
			<ul>
				<li> app 
					<ul>
						<li> public</li>
					</ul>
				</li>
				<li>debugbar</li>
				<li> framework
					<ul>
						<li> cache </li>
						<li> sessions</li>
						<li> testing</li>
						<li> views</li>
					</ul>
				</li>
				<li> logs
					<ul>
						<li>	laravel.log</li>
					</ul>
				</li>
		</ul>
	</li>
			<li> bootstrap
				<ul>
					<li> cache</li>
				</ul>
			</li>		
	<li> Run composer update command in command prompt</li>
	<li> Hit the url from .env.local file set under APP_URL</li>
</ul>
<h1>### How do I get set up? - Shortcut ###</h1>
<ul>
	<li>The git repo must be located/cloned in www root directory, it should not be located in any sub-directory</li>
	<li>Set PHP version to 7.4.x</li>
	<li>Open command prompt on any other laravel project</li>
	<li>Run php artisan "php artisan optimize:clear" command</li>
	<li>Copy storage directory from the project where you ran the command above, and pate it in the root of this project directory</li>
	<li>Create directories like below in the root path of the project	
		<ul>
			<li>bootstrap
				<ul>
					<li>cache</li>
				</ul>
			</li>
		</ul>
	</li>
	<li>Run composer update command in command prompt</li>
	<li>Hit the url from .env.local file set under APP_URL</li>
</ul>