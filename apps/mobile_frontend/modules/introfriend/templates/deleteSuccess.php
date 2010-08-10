<?php op_mobile_page_title(__('Do you really delete it?')) ?>
<?php $form = new sfForm() ?>
<form style="width: 48%; float: left; text-align: right" action="" method="post">
<input type="hidden" name="delete" value="1">
<input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>">
<input type="submit" value="<?php echo __('Yes') ?>">
</form>
<form style="width: 48%; float: right; text-align: left" action="" method="post">
<input type="submit" value="<?php echo __('No')?>">
</form>
<div style="clear: left"></div>
