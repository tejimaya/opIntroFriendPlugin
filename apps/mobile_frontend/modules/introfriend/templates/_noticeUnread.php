<?php if ($introFriendUnread && $introFriendUnread->getCount() > 0) : ?>
<?php echo link_to(format_number_choice('[1]There is new introductory essay!|(1,Inf]There are %1% new introductory essays!', array('%1%' => $introFriendUnread->getCount()), $introFriendUnread->getCount()), 'obj_introfriend', $member) ?><br>
<?php endif; ?>
