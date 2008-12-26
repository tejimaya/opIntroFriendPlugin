<?php
$criteria = new Criteria();
$criteria->add(IntroEssayPeer::TO_ID, $id);
$criteria->addDescendingOrderByColumn(IntroEssayPeer::ID);
$criteria->setLimit(sfConfig::get('app_max_introessay'));
$introEssays = IntroEssayPeer::doSelect($criteria);

if (count($introEssays)) {
  $html = "";
  $list = array();
  foreach ($introEssays as $introEssay) {
      $criteria = new Criteria();
      $criteria->add(MemberPeer::ID, $introEssay->getFromId());
      $writer = MemberPeer::doSelectOne($criteria);

      $string = $introEssay->getContent();
      $pos = 0;
      for ($i = 0; $i < sfConfig::get('app_line_introessay'); $i++)
      {
        $pos = mb_strpos($string, "\n", $pos + 1);
        if (!$pos) { break; }
      }
      if ($pos) { $string = mb_substr($string, 0, $pos - 1); }
      $name = link_to(image_tag_sf_image($writer->getImage(), array('size' => '76x76')) . '<br />' . $writer->getName(), 'member/' . $writer->getId());
      $list[$name] = nl2br($string) . ($pos ? '...' : '');
  }
  $list['　'] = link_to( '全て見る', 'introessay/show?id=' . $id );
  include_list_box('introEssay', $list, array( 'title' => 'マイフレンドからの紹介文'));
}
