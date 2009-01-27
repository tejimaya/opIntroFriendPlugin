<?php include_box('notFriend', __('Error'), __('Not your friend')); ?>

<?php use_helper('Javascript') ?>
<?php op_include_line('backLink', link_to_function(__('Back to previous page'), 'history.back()')) ?>
