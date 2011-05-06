<?php include_box('notFriend', __('Introductory essay from %my_friend%'), __('A %friend%\'s introductory essay does not exists.')); ?>

<?php use_helper('Javascript') ?>
<?php op_include_line('backLink', link_to_function(__('Back to previous page'), 'history.back()')) ?>
