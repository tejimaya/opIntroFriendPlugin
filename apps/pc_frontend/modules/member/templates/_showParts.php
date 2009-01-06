<?php
$introFriends = IntroFriendPeer::getPartsByTo($id);

if (count($introFriends)) {
  $html = "";
  $list = array();
  foreach ($introFriends as $introFriend) {
      $criteria = new Criteria();
      $criteria->add(MemberPeer::ID, $introFriend->getFromId());
      $writer = MemberPeer::doSelectOne($criteria);

      $string = $introFriend->getContent();
      $pos = 0;
      for ($i = 0; $i < sfConfig::get('app_line_introfriend'); $i++)
      {
        $pos = mb_strpos($string, "\n", $pos + 1);
        if (!$pos) { break; }
      }
      if ($pos) { $string = mb_substr($string, 0, $pos - 1); }
      $name = link_to(image_tag_sf_image($writer->getImageFilename(), array('size' => '76x76')) . '<br />' . $writer->getName(), 'member/' . $writer->getId());
      $list[$name] = nl2br($string) . ($pos ? '...' : '');
  }
  $list[' '] = link_to( __('Show all'), 'introfriend/show?id=' . $id );
  include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
}
