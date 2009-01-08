<?php
$html = "";
$list = array();
foreach ($introList as $obj) {
  $member = $obj['member'];
  $img = link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76'))
       . '<br />' . $member->getName(), 'member/' . $member->getId());
  $list[$img] = '<p>' . nl2br($obj['essay']) . '</p>';
  if ($member->getId() == $sf_user->getMemberId()) {
    $list[$img] .= '<ul><li>'
                 . link_to(__('Edit introductory essay'), 'introfriend/index?id=' . $id)
                 . '</li><li>'
                 . link_to(__('Delete introductory essay'), 'introfriend/delete?id=' . $id)
                 . '</li></ul>';
  }
}
include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
