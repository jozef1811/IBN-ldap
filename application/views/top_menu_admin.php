<ul>
	<li>
		<a href="<?php base_url();?>/index.php/home" class="home">Domov</a>
	</li>
	<li>
		<a class="users">Používatelia</a>
		<ul class="users">
			<li><a href="<?php base_url();?>/index.php/users/add" class="user_add">Pridaj</a></li>
			<li><a href="<?php base_url();?>/index.php/users/user" class="user_list">Používatelia</a></li>
		</ul>
	</li>
	<li>
		<a class="devices">Zariadenia</a>
		<ul class="devices">
			<li><a href="<?php base_url();?>/index.php/devices/add" class="device_add">Pridaj</a></li>
			<li><a href="<?php base_url();?>/index.php/devices/remove#" class="device_delete">Zmaž</a></li>
			<li><a href="#" class="device_edit">Uprav</a></li>
			<li><a href="#" class="device_find">Hľadaj</a></li>
		</ul>
	</li>
	<li>
		<a class="ports">Porty</a>
		<ul class="ports">
			<li><a href="<?php base_url();?>/index.php/ports/blockB" class="block_b">Blok B</a></li>
			<li><a href="<?php base_url();?>/index.php/ports/blockC" class="block_c">Blok C</a></li>
			<li><a href="<?php base_url();?>/index.php/ports/blockD" class="block_d">Blok D</a></li>
			<li><a href="<?php base_url();?>/index.php/ports/ports_edit" class="port_edit">Uprav</a></li>
		</ul>	
	</li>
	<li><a href="<?php base_url();?>/index.php/temperature/temp" class="temperature">Teploty</a></li>
	<li><a href="<?php base_url();?>/index.php/camera/kamera" class="camera">Kamery</a></li>
	<li><a class="quota">Kvóta</a></li>
	<li><a class="export">Export</a></li>
	<li><a href="<?php base_url();?>/index.php/login" class="logout">Odhlásiť</a></li>
</ul>

<script>
$(function() {
	$('#top_menu_admin ul li ul').hide();

	$('#top_menu_admin ul li a').click(function() {
		$('#top_menu_admin ul li ul').hide();
		$(this).next().show('fast');
		$(this).next().children().fadeIn('slow');
	});
})
</script>
