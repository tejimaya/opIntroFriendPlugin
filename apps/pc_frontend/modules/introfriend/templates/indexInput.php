<div id="introFriendBox" class="dparts form">
<div class="parts">

<div class="partsHeading">
<h3><?php echo __('Create introductory essay') ?></h3>
</div>

<form action="" method="post" enctype="multipart/form-data">

<table>
<tbody>

<tr>
<th><?php echo __('photo') ?></th>
<td><?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), 'member/profile?id=' . $member->getId()) ?></td>
</tr>
<tr>
<th><?php echo __('Nickname') ?></th>
<td><?php echo link_to($member->getName(), 'obj_member_profile', $member) ?></td>
</tr>

<?php echo $form ?>

</tbody>
</table>

<div class="operation">
<ul class="moreInfo button">
<li>
<input type="submit" class="input_submit" value="<?php echo __('Create') ?>" />
</li>
</ul>
</div>
</form>

</div></div>
