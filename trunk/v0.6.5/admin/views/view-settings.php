<main id="aviary-app" class="wrap">
	<div class="ui two column grid">
		<section class="row">
			<h2 class="column">Aviary Image Editor Settings</h2>
		</section>
		
		<section class="row">
			<div class="column">
				
				<div id="aviary-app-key-form" class="ui form">
					<div class="field">
						<label>Aviary App Key:</label>
						<input type="text" name="aviary-app-key" value="<?php echo get_option($this->option_name) ?>">
					</div>
					<button class="ui primary button" type="submit" id="add-aviary-app-key-btn">Submit</button>
					<p id="aviary-app-key-msg">
						<span class="ui message success"></span>
						<span class="ui message error"></span>
					</p>
				</div>
			
				<hr>
			
				<h3>How to get your free Aviary app key</h3>
				<ol>
					<li><p>Login to Adobe Creative at <a href="https://creativesdk.adobe.com/myapps.html" target="_blank">https://creativesdk.adobe.com/myapps.html</a></p></li>
					<li><p>If you do not yet have an account, you will need to create one.</p></li>
					<li><p>Under "My Apps", you will see a list of your apps. Your app key is the "CLIENT ID".</p></li>
					<li><p>Copy your app key into the field above and save it.</p></li>
				</ol>
				
			</div>
			
			<div class="column center aligned ">
				<h3>Built with love by</h3>
				<a href="http://buooy.com/?utm_source=plugins&utm_medium=wordpress&utm_campaign=buooy%20aviary%20editor">
					<img style="width: 225px;" class="ui centered image rounded" src="<?php echo plugins_url('assets/img', __DIR__); ?>/buooy-rectangle.png">
				</a>
			</div>
			
		</section>
	</div>
</main>