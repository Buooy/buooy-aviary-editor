<main id="aviary-app" class="wrap">
	
	<h2>Aviary Image Editor Settings</h2>
	
	<table class="form-group">
		<tbody>
			
			<tr>
				<td><h3>Aviary App Key: </h3></td>
				<td id="aviary-app-key"><input class="form-control" type="text" name="aviary-app-key" value="<?php echo get_option($this->option_name) ?>"></td>
				<td id="add-aviary-app-key"><button class="btn btn-2 btn-2a" id="add-aviary-app-key-btn">Submit</button></td>
				<td id="aviary-app-key-msg"><label class="alert"></label></td>
			</tr>
			
		</tbody>
	</table>
	<br>
	<hr>
	<br>
	<h3>How to get your free Aviary app key</h3>
	<ol>
		<li><p>Login to Adobe Creative at <a href="https://creativesdk.adobe.com/myapps.html" target="_blank">https://creativesdk.adobe.com/myapps.html</a></p></li>
		<li><p>If you do not yet have an account, you will need to create one.</p></li>
		<li><p>Under "My Apps", you will see a list of your apps. Your app key is the "CLIENT ID".</p></li>
		<li><p>Copy your app key into the field above and save it.</p></li>
	</ol>
	
</main>