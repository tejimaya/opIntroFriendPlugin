<?php
$html = "";
$list = array();
foreach ($introList as $obj) {
  $member = $obj['member'];
  $img = link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76'))
       . '<br />' . $member->getName(), 'member/' . $member->getId());
  $list[$img] = nl2br($obj['essay']);
}
include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
