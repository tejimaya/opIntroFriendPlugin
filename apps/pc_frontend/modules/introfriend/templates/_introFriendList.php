<?php

if (count($introList)) {
  $list = array();
  foreach ($introList as $obj) {
    $writer = $obj['member'];
    $pos = 0;
    $img = link_to(image_tag_sf_image($writer->getImageFilename(), array('size' => '76x76'))
         . '<br />' . $writer->getName(), 'member/' . $writer->getId());
    $list[$img] = nl2br($obj['essay']);
  }
  $list[' '] = link_to( __('Show all'), 'introfriend/list?id=' . $id );
  include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
}
