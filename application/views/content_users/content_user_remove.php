<div id="content_user">
  <span class="title user_remove_img"><h1>Zmaž používateľa</h1></span>
 <div id="user_search_top">
  <form action="post" class="search_user_remove">
        <input id="search_input" name="uid" type="text" placeholder="Zadaj prezývku"/>
        <input id="search_submit" name="submit" type="submit" value="" />
  </form>
 </div>

 <div id="user_search_bottom">
 	<button id="remove_button">Zmazať</button>
 </div>
<script>
	$("#user_search_bottom").hide();
	$("form.search_user_remove").submit(function() {
		$('table').hide();
		$('table').remove();
		uid = $('#search_input').val();
		show_users(uid);
		return false;
	});

	$("#remove_button").click(function(){
			var username = $("#user_search_bottom table").attr('class');
			remove_user(username);
	});

	function show_users(uid)
	{
		var index = 1;
		$.ajax({
			url: "getUser",
			type: "post",
			data: {uid:uid},
			dataType: 'json', 		
			success: function(data){
				if(!data)
				var output = '<table><tr><td>Neznámy používateľ</td></tr></table>';
				else {					
				var output = '<table class="'+data[index].prezyvka+'">';
				for(index = 1; index<=data.pocet; index++)
				{
	 output += '<tr><td><b>'+data[index].prezyvka+'</b></td></tr><tr><td>'+data[index].meno+' '+data[index].priezvisko+' ';
				}
				output += '</table>';
				}
				$('#remove_button').before(output);
				$("#user_search_bottom").fadeIn('slow');

			},
			error: function(){
				var output = 'ERROR: Nobody is find';
				$('#remove_button').before(output);
			},
			beforeSend: function(){
				$('table').hide();
				$('table').remove();
				$("#user_search_bottom").fadeOut('fast');
			}
		});
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
			},
			error: function(){
				var output = 'ERROR: Cannot remove';
				$('#user_search_bottom').append(output);
			}
		});
	}
</script>
</div>
