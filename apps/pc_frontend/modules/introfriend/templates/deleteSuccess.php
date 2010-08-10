<?php
$form = new sfForm();
$html = '<form style="width: 48%; float: left; text-align: right" action="" method="post"><input type="hidden" name="delete" value="1" /><input type="submit" value="' . __('Yes') . '" />'
      . '<input type="hidden" name="'.$form->getCSRFFieldName().'" value="'.$form->getCSRFToken().'"/>'
      . '</form>'
      . '<form style="width: 48%; float: right; text-align: left" action="" method="post"><input type="submit" value="' . __('No') . '" /></form>'
      . '<div style="clear: left"></div>';
include_box( 'infobox', __('Do you really delete it?'), $html);

