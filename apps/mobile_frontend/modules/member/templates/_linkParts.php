<?php
$criteria = new Criteria();
$criteria->add(IntroEssayPeer::TO_ID, $id);
$criteria->addDescendingOrderByColumn(IntroEssayPeer::ID);
$cnt = IntroEssayPeer::doCount($criteria);

if($sf_user->GetMemberId() != $member->getId()) {
  echo link_to('紹介文を書く', 'introessay/index?id=' . $id);
}

if ($cnt) {
  echo link_to('紹介文を読む(' . $cnt . ')', 'introessay/list?id=' . $id);
}

