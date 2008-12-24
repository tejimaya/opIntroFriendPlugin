<?php
$criteria = new Criteria();
$criteria->add(IntroEssayPeer::TO_ID, $id);
$criteria->addDescendingOrderByColumn(IntroEssayPeer::ID);
$introEssays = IntroEssayPeer::doSelect($criteria);

if (count($introEssays)) {
  $html = "";
  $list = array();
  foreach ($introEssays as $introEssay) {
      $criteria = new Criteria();
      $criteria->add(MemberPeer::ID, $introEssay->getFromId());
      $writer = MemberPeer::doSelectOne($criteria);

      $list[link_to(image_tag_sf_image($writer->getImage(), array('size' => '76x76')) . '<br />' . $writer->getName(), 'member/' . $writer->getId())] = nl2br($introEssay->getContent());
  }
  include_list_box('introEssay', $list, array( 'title' => 'マイフレンドからの紹介文'));
}
