<?php

if (count($introList)) {
  $list = array();
  foreach ($introList as $obj) {
    $member = $obj['member'];
    $pos = 0;
    $img = link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76'))
         . '<br />' . $member->getName(), 'member/' . $member->getId());
    $list[$img] = nl2br($obj['essay']);
  }
  $list[' '] = link_to(__('Show all'), '@obj_introfriend?id='.$id);
  include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
}
