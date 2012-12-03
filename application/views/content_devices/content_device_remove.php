<div id="popup"><div id="popup_remove"></div> </div>
<div id="content_user">
  <span class="title user_remove_img"><h1>Zmaž zariadenie</h1></span>

 <div id="user_search_top"> </div>
 <div id="user_search_bottom"></div>
</div>
<script>
$(document).ready(function() {
		$('#popup').hide();
		show_users();
		return false;
	});

	function show_users()
	{
		$('table').hide();
		$('table').remove();

		var index = 1;
		var uid = '*';
		$.ajax({
			url: "getUser",
			type: "post",
			data: {uid:uid},
			dataType: 'json', 		
			success: function(data){
				if(!data)
					var output = '<table><tr><td>Žiadný používateľ v databáze</td></tr></table>';
				else {					
					var output = '<table><tr><th>#</th><th>Prezývka</th><th>Meno</th><th>Priezvisko</th><th></th><th></th><th></th><th></th>';
					for(index = 1; index<=data.pocet; index++)
					{

			 			output += '<tr><td class="small">'+index+'</td>';
						output += '<td><b>'+data[index].prezyvka+'</b></td>';
						output += '<td>'+data[index].meno+'</td><td>'+data[index].priezvisko+'</td>';
						output += '<td class="small"><a class="profile" href="'+index+'">';
						output += '<img src="/../images/icons/user_info.png"/ ></a></td>';
						output += '<td class="small"><a class="edit" href="'+data[index].prezyvka+'">';
						output += '<img src="/../images/icons/user_edit.png"/ ></a></td>';
						output += '<td class="small"><a class="right" href="'+index+'">';
						output += '<img src="/../images/icons/user_right.png"/ ></a></td>';
						output += '<td class="small"><a class="change_password" href="'+data[index].prezyvka+'">';
						output += '<img src="/../images/icons/user_password.png"/ ></a></td>';
						output += '<td class="small"><a class="remove" href="'+data[index].prezyvka+'">';
						output += '<img src="/../images/icons/user_remove.png"/ ></a></td></tr>';

					}
					output += '</table>';
					}
					$("#user_search_bottom").append(output);
					$("#user_search_bottom").fadeIn('slow');
					$("html").delegate('.profile','click', function() {
						profile_user_dialog($(this).attr('href'), data); 
						return false; 
					});
					$("html").delegate('.edit','click', function() {
						edit_user_dialog($(this).attr('href'), data); 
						return false; 
					});
					$("html").delegate('.right','click', function() {
						remove_user_dialog($(this).attr('href')); 
						return false; 
					});
					$("html").delegate('.change_password','click', function() {
						change_password_user_dialog($(this).attr('href')); 
						return false; 
					});
					$("html").delegate('.remove','click', function() {
						remove_user_dialog($(this).attr('href')); 
						return false; 
					});
			},
			error: function(){
				var output = 'ERROR: Connection to database';
				$('#remove_button').before(output);
			},
			beforeSend: function(){
				$('table').hide();
				$('table').remove();
				$("#user_search_bottom").fadeOut('fast');
			}
		});
	}

	function profile_user_dialog(index, data)
	{
		var remove_text = "<div id='popup_profile'><h1>"+data[index].prezyvka+"</h1><table>";
		remove_text += "<tr><td><b>Meno:</b></td><td><p>"+data[index].meno+"</p></td></tr>";
		remove_text += "<tr><td><b>Priezvisko:</b></td><td><p>"+data[index].priezvisko+"</p></td></tr>";
		remove_text += "<tr><td><b>Izba:</b></td><td><p>"+data[index].izba+"</p></td></tr>";
		remove_text += "<tr><td><b>Mobil:</b></td><td><p>"+data[index].mobil+"</p></td></tr>";
		remove_text += "<tr><td><b>Klapka:</b></td><td><p>"+data[index].klapka+"</p></td></tr>";
		remove_text += "<tr><td><b>Email:</b></td><td><p>"+data[index].email+"</p></td></tr>";
		remove_text += "<tr><td><b>Popis:</b></td><td><p>"+data[index].popis+"</p></td></tr>";
		remove_text += "</tr></table><button class='cancel_user_button'>Zatvoriť</button></div>";

		$('#popup').append(remove_text);

		$("html").delegate('.cancel_user_button','click', function() {
			$('#popup').hide(); 
			$('#popup *').remove(); 
		});
		$('#popup').fadeIn('normal');
	}

	function remove_user_dialog(uid)
	{
		var remove_text = "<div id='popup_remove'><p>Skutočne chces zmazať používateľa? </p><h1>"+uid+"</h1>";
		remove_text += "<button class='remove_user_button'>Áno</button>";
		remove_text += "<button class='cancel_user_button'>Nie</button></div>";

		$('#popup').append(remove_text);
		$("html").delegate('.remove_user_button','click', function() {
			remove_user(uid); 
			$('#popup').hide(); 
			$('#popup *').remove();
		});
		$("html").delegate('.cancel_user_button','click', function() {
			$('#popup').hide(); 
			$('#popup *').remove(); 
		});
		$('#popup').fadeIn('normal');
	}

	function remove_user(uid) 
	{
		$.ajax({
			url: "removeUser",
			type: "post",
			data: {uid:uid},
			dataType: 'json', 		
			success: function(data){
				$('table').hide();
				$('table').remove();
				$("#user_search_bottom").fadeOut('fast');
				show_users();
			},
			error: function(){
			}

		}); 
	}

	function edit_user_dialog(uid)
	{

		$.ajax({
			url: "getUser",
			type: "post",
			data: {uid:uid},
			dataType: 'json', 		
			success: function(data){
		var remove_text = "<div id='popup_profile'><p>Úprava profilu</p>";
		remove_text += '<label for="uid">Prezývka</label>';
	    	remove_text += '<input class="uid" type="text" name="uid" value="'+data[1].prezyvka+'" placeholder="Prezývka" readonly/ >';
		remove_text += '<label for="cn">Meno</label>';
	        remove_text += '<input class="cn" type="text" name="cn" value="'+data[1].meno+'" placeholder="Meno" / >'; 
            	remove_text += '<label for="sn">Priezvisko</label>';
	    	remove_text += '<input class="sn" type="text" name="sn" value="'+data[1].priezvisko+'" placeholder="Priezvisko" / >';
            	remove_text += '<label for="roomNumber">Izba</label>';
	        remove_text += '<input class="roomNumber" type="text" name="roomNumber" value="'+data[1].izba+'" placeholder="Izba" / >'; 
            	remove_text += '<label for="mobile">Mobil</label>';
	    	remove_text += '<input class="mobile" type="text" name="mobile" value="'+data[1].mobil+'" placeholder="Mobil" / >';
	    	remove_text += '<label for="telephoneNumber">Klapka</label>';
	    	remove_text += '<input class="telephoneNumber" type="text" name="telephoneNumber" value="'+data[1].klapka+'" placeholder="Klapka" / >';
		remove_text += '<label for="mail">Email</label>';
	        remove_text += '<input class="mail" type="text" name="mail" value="'+data[1].email+'" placeholder="Email" / >';
	    	remove_text += '<label for="description">Popis</label>';
	    	remove_text += '<textarea class="description" name="description">'+data[1].popis+'</textarea>';  		

		remove_text += "<button class='edit_user_button'>Uložiť</button>";
		remove_text += "<button class='cancel_user_button'>Zrušiť</button></div>";

		$('#popup').append(remove_text);

		$('.edit_user_button').live('click', function() {
			edit_user();
			$('#popup').hide(); 
			$('#popup *').remove(); 
		});

		$("html").delegate('.cancel_user_button','click', function() {
			$('#popup').hide(); 
			$('#popup *').remove(); 
		});
		$('#popup').fadeIn('normal');

			},
			error: function(){
			}

		}); 
	}

	function edit_user() 
	{
		var uid = $('.uid').val();
		var cn = $('.cn').val();
		var sn = $('.sn').val();
		var roomNumber = $('.roomNumber').val();
		var mobile = $('.mobile').val();
		var telephoneNumber = $('.telephoneNumber').val();
		var mail = $('.mail').val();
		var description = $('.description').val();

		$.ajax({
			url: "editUser",
			type: "post",
			data: {uid:uid, cn:cn, sn:sn, roomNumber:roomNumber, mobile:mobile, telephoneNumber:telephoneNumber, mail:mail, description:description},
			dataType: 'json', 		
			success: function(data){
				$('table').hide();
				$('table').remove();
				$("#user_search_bottom").fadeOut('fast');
				show_users();
			},
			error: function(){
			}

		}); 
	}

	function change_password_user_dialog(uid)
	{
		var remove_text = "<div id='popup_remove'><p>Zmena hesla používateľa: "+uid+"</p>";
		remove_text += '<label for="userPassword">Heslo</label>';
	        remove_text += '<input class="userPassword" type="password" name="userPassword" value="" placeholder="Heslo" / >'; 
            	remove_text += '<label for="userPassword2">Potvrď heslo</label>';
	    	remove_text += '<input class="userPassword2" type="password" name="userPassword2" value="" placeholder="Potvrď heslo" / >';
		remove_text += "<button class='remove_user_button'>Uložiť</button>";
		remove_text += "<button class='cancel_user_button'>Zrušiť</button></div>";

		$('#popup').append(remove_text);
		$("html").delegate('.remove_user_button','click', function() {
			remove_user(uid); 
			$('#popup').hide(); 
			$('#popup *').remove();
		});
		$("html").delegate('.cancel_user_button','click', function() {
			$('#popup').hide(); 
			$('#popup *').remove(); 
		});
		$('#popup').fadeIn('normal');

	}

</script>
</div>
