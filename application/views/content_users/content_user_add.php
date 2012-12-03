<div id="content_user">
 <span class="title user_add_img"><h1>Pridaj používateľa</h1></span>
  <form action="<?= base_url() ?>index.php/users/addUser" method="post" accept-charset="utf-8"> 
        <fieldset id="user-details1">			
 
            <label for="uid">Prezývka</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="uid" value="<?php echo set_value('uid'); ?>" placeholder="Prezývka" /> 

            <label for="cn">Meno</label>
	    <?php echo form_error('cn'); ?>
	    <input type="text" name="cn" value="<?php echo set_value('cn'); ?>" placeholder="Meno" /> 
 
            <label for="sn">Priezvisko</label>
	    <?php echo form_error('sn'); ?>
	    <input type="text" name="sn" value="<?php echo set_value('sn'); ?>" placeholder="Priezvisko" /> 

            <label for="roomNumber">Izba</label>
	    <?php echo form_error('roomNumber'); ?>
	    <input type="text" name="roomNumber" value="<?php echo set_value('roomNumber'); ?>" placeholder="Izba" /> 
	    
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
 
            <label for="mobile">Mobil</label>
	    <?php echo form_error('mobile'); ?>
	    <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="Mobil" /> 

	    <label for="telephoneNumber">Klapka</label> 
	    <?php echo form_error('telephoneNumber'); ?>
	    <input type="text" name="telephoneNumber" value="<?php echo set_value('telephoneNumber'); ?>" placeholder="Klapka" /> 

	    <label for="mail">Email</label> 
	    <?php echo form_error('mail'); ?>
	    <input type="text" name="mail" value="<?php echo set_value('mail'); ?>" placeholder="Email" /> 

            <label for="userPassword">Heslo</label>
	    <?php echo form_error('userPassword'); ?>
	    <input type="password" name="userPassword" value="" placeholder="Heslo" /> 

            <label for="userPassword2">Zopakuj heslo</label>
	    <?php echo form_error('userPassword2'); ?>
	    <input type="password" name="userPassword2" value="" placeholder="Zopakuj heslo" /> 

	    <label for="description">Popis</label> 
	    <?php echo form_error('description'); ?>
	    <textarea name="description" rows="0" cols="0"><?php echo set_value('options[]'); ?></textarea>  		
 
	</fieldset><!-- end user-details2 -->
 </form>
</div>
