<?php op_include_parts('yesNo', 'delete_introfriend', array(
  'yes_form' => new BaseForm(),
  'yes_method' => 'post',
  'no_method' => 'get',
  'no_url' => $uri,
  'title' => __('Do you really delete it?'),
)) ?>
