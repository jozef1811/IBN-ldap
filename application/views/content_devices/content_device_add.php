<div id="content_user">
 <span class="title user_add_img"><h1>Pridaj zariadenie</h1></span>
  <form action="#"> 
        <fieldset id="user-details1">			
 
            <label for="cn">Názov</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="cn" value="" placeholder="Názov" /> 
		
            <label for="cn">Značka</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="cn" value="" placeholder="Značka" /> 

            <label for="cn">Typ</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="cn" value="" placeholder="Typ" /> 
 
            <label for="sn">Seriové číslo</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="sn" value="" placeholder="Sériové číslo" /> 

            <label for="roomNumber">Inventárne číslo</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="roomNumber" value="" placeholder="Inventárne číslo" /> 
	    
	    <input type="submit" value="Ulož" name="submit" class="submit" />
 
	</fieldset><!--end user-details1-->
	<fieldset id="user-details2">
 
            <label for="cn">Fyzická adresa</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="cn" value="" placeholder="Mac adresa" /> 

            <label for="mobile">IP adresa</label>
	    <?php echo form_error('uid'); ?>
	    <input type="text" name="mobile" value="0.0.0.0" placeholder="IP adresa" /> 

             <label for="umiestnenie">Umiestnenie</label>
 	     <select>
		<option value ="ServerovnaB" selected>Serverovňa B-blok</option>
		<option value ="ServerovnaC">Serverovňa C-blok</option>
		<option value ="ServerovnaD">Serverovňa D-blok</option>
		<option value ="Sklad">Sklad</option>
		<option value ="B055">Kancelária B-055</option>
	     </select>

	    <label for="description">Popis</label> 
	    <?php echo form_error('uid'); ?>
	    <textarea name="description" rows="0" cols="0"></textarea>  		
 
	</fieldset><!-- end user-details2 -->
 </form>
</div>
