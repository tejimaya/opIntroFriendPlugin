<?php include_box( 'notFriend', __('Error'), __('Not your friend')); ?>

<?php use_helper('Javascript') ?>
<p><?php echo link_to_function(__('前のページに戻る'), 'history.back()') ?></p>
