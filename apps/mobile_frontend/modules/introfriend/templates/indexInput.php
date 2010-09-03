<?php op_mobile_page_title(__('Create introductory essay')) ?>
<form action="<?php echo url_for('obj_member_introfriend', $member) ?>" method="post">
<?php echo $form ?>
<br><br>
<center><input type="submit" value="<?php echo __('Create') ?>"></center>
</form>

