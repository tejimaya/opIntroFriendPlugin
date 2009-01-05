<?php
$introFriends = IntroFriendPeer::getByTo($id);

if (count($introFriends)) {
  $html = "";
  $list = array();
  foreach ($introFriends as $introFriend) {
      $criteria = new Criteria();
      $criteria->add(MemberPeer::ID, $introFriend->getFromId());
      $writer = MemberPeer::doSelectOne($criteria);

      $list[link_to(image_tag_sf_image($writer->getImage(), array('size' => '76x76')) . '<br />' . $writer->getName(), 'member/' . $writer->getId())] = nl2br($introFriend->getContent());
  }
  include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
}
