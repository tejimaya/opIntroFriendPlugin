<?php slot('firstRow') ?>
<tr><th><?php echo __('Photo') ?></th>
<td><?php echo link_to(image_tag_sf_image($member->getImageFileName(), array('size' => '76x76')), 'member/profile?id='.$member->getId()) ?> </td>
</tr>
<tr><th><?php echo __('Nickname') ?></th>
<td><?php echo link_to($member->getName(), 'obj_member_profile', $member) ?></td>
</tr>
<?php end_slot() ?>
<?php
op_include_form('formIntroFriend', $form, array(
  'title'       => __('Create introductory essay'),
  'button'      => __('Create'),
  'isMultipart' => true,
  'firstRow'    => get_slot('firstRow'),
));
