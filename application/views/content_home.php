<div class="content">
	<div class="top">
	<ul>
		<li>
			<a class="users">Používatelia</a>
				<ul class="users_sub_menu">
					<li><a href="<?php base_url();?>/index.php/home" class="user_home">Domov</a></li>
					<li><a href="<?php base_url();?>/index.php/users/add" class="user_add">Pridaj</a></li>
					<li><a href="<?php base_url();?>/index.php/users/remove" class="user_delete">Zmaž</a></li>
					<li><a href="<?php base_url();?>/index.php/users/edit" class="user_edit">Uprav</a></li>
					<li><a href="<?php base_url();?>/index.php/users/search" class="user_find">Hľadaj</a></li>
				</ul>
		</li>
		<li>
			<a class="devices">Zariadenia</a>
				<ul class="devices_sub_menu">
					<li><a href="<?php base_url();?>/index.php/home" class="device_home">Domov</a></li>
					<li><a href="#" class="device_add">Pridaj</a></li>
					<li><a href="#" class="device_delete">Zmaž</a></li>
					<li><a href="#" class="device_edit">Uprav</a></li>
					<li><a href="#" class="device_find">Hľadaj</a></li>
				</ul>
		</li>
		<li><a class="ports">Porty</a></li>
	</ul>
	</div>
	<div class="bottom">
	<ul>
		<li><a class="temperature">Teploty</a></li>
		<li><a class="camera">Kamery</a></li>
		<li><a class="kvota">Kvóta</a></li>
		<li><a class="export">Export</a></li>
	</ul>
	</div>
</div>

<script>
$(function() {
	$('.top ul li ul').hide();


	$('.top ul li').click(function() {
		$('.top ul li ul').hide();
		$(this).find('ul:first').stop(true,true).slideDown('slow');
	});
})	
</script>
