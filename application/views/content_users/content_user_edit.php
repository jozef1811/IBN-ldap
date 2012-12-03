<div id="content_user">
  <span class="title user_edit_img"><h1>Uprav používateľa</h1></span>
 <div id="user_search_top">
  <form action="post" class="search_user_edit">
        <input id="search_input" name="search" type="text" placeholder="Zadaj prezývku" />
        <input id="search_submit" name="submit" type="submit" value="" />
  </form>
 </div>

 <div id="user_search_bottom">
 <form method="post" accept-charset="utf-8" class="edit_user"> 
        <fieldset id="user-details1">			
 
            <label for="uid">Prezývka:</label>
	    <?php echo form_error('uid'); ?>
	    <input id="uid" type="text" name="uid" value="<?php echo set_value('uid'); ?>" placeholder="Prezývka" /> 

            <label for="cn">Meno:</label>
	    <?php echo form_error('cn'); ?>
	    <input id="cn" type="text" name="cn" value="<?php echo set_value('cn'); ?>" placeholder="Meno" /> 
 
            <label for="sn">Priezvisko:</label>
	    <?php echo form_error('sn'); ?>
	    <input id="sn" type="text" name="sn" value="<?php echo set_value('sn'); ?>" placeholder="Priezvisko" /> 

            <label for="roomNumber">Izba:</label>
	    <?php echo form_error('roomNumber'); ?>
	    <input id="roomNumber" type="text" name="roomNumber" value="<?php echo set_value('roomNumber'); ?>" placeholder="Izba" /> 
	    
	    <label for="sluzby" class="checkbox">
   	    <input type="checkbox" id="sluzby" class="checkbox" name='sluzby' value=1 />
            Základné ( Jabber, FTP )
	    </label>

   	    <label for="technici" class="checkbox">
 	    <input type="checkbox" id="technici" class="checkbox" name='technici' value=1 />
	    Technik ( Prepínače )
	    </label>

	    <label for="systemaci" class="checkbox">
   	    <input type="checkbox" id="systemaci" class="checkbox" name='systemaci' value=1 />
	    Systemák ( Virtuálne servre )
            </label>

	    <label for="admini" class="checkbox">
   	    <input type="checkbox" id="admini" class="checkbox" name='admini' value=1 />
	    Administrátor ( Fyzické servre, DHCP server, Pridávanie technikov do LDAP)
	    </label>

	    <input type="submit" value="Ulož" name="submit" class="submit" />
 
	</fieldset><!--end user-details1-->
	<fieldset id="user-details2">
 
            <label for="mobile">Mobil:</label>
	    <?php echo form_error('mobile'); ?>
	    <input id="mobile" type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="Mobil" /> 

	    <label for="telephoneNumber">Klapka:</label> 
	    <?php echo form_error('telephoneNumber'); ?>
	    <input id="telephoneNumber" type="text" name="telephoneNumber" value="<?php echo set_value('telephoneNumber'); ?>" placeholder="Klapka" /> 

	    <label for="mail">Email:</label> 
	    <?php echo form_error('mail'); ?>
	    <input id="mail" type="text" name="mail" value="<?php echo set_value('mail'); ?>" placeholder="Email" /> 

            <label for="userPassword">Heslo:</label>
	    <?php echo form_error('userPassword'); ?>
	    <input id="userPassword" type="password" name="userPassword" value="" placeholder="Heslo" /> 

            <label for="userPassword2">Zopakuj heslo:</label>
	    <?php echo form_error('userPassword2'); ?>
	    <input id="userPassword2" type="password" name="userPassword2" value="" placeholder="Zopakuj heslo" /> 

	    <label for="description">Popis:</label> 
	    <?php echo form_error('description'); ?>
	    <textarea id="description" name="description" rows="0" cols="0"><?php echo set_value('options[]'); ?></textarea>  		
 
	</fieldset><!-- end user-details2 -->
 </form>
 </div>

<script>
	$("#user_search_bottom").hide();

	$("form.search_user_edit").submit(function() {
		uid = $('#search_input').val();
		fill_fields(uid); 
		$("#user_search_bottom").fadeIn('slow');
		return false;
	});

	function fill_fields(uid)
	{
		var index = 1;
		$.ajax({
			url: "getUser",
			type: "post",
			data: {uid:uid},
			dataType: 'json', 		
			success: function(data){
				$('input#uid').val(''+data[1].prezyvka);
				$('input#cn').val(''+data[1].meno);
				$('input#sn').val(''+data[1].priezvisko);
				$('input#roomNumber').val(''+data[1].izba);
				$('input#mobile').val(''+data[1].mobil);
				$('input#telephoneNumber').val(''+data[1].klapka);
				$('input#mail').val(''+data[1].email);
				$('textarea#description').val(''+data[1].popis);
			},
			error: function(){
				var output = 'ERROR: Nobody is find';
				$('#user_search_bottom').after(output);
				$("#user_search_bottom").fadeIn('slow');
			},
			beforeSend: function(){
				$("#user_search_bottom").fadeOut('fast');
				$('input').val("");
			}
		});
	}

</script>
</div>
