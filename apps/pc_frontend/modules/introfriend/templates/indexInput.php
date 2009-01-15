<?php slot('opIntroFriend') ?>
<tr>
<th><?php echo __('photo') ?></th>
<td><?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), 'member/profile?id=' . $member->getId()) ?></td>
</tr>
<tr>
<th><?php echo __('Nickname') ?></th>
<td><?php echo link_to($member->getName(), 'member/profile?id=' . $member->getId()) ?></td>
</tr>
<?php end_slot() ?>

<?php
include_box( 'introFriendBox', __('Create introductory essay'), '', array(
  'form' => array($form),
  'url' => 'introfriend/index?id=' . $id,
  'button' => __('Create')
))
?>

