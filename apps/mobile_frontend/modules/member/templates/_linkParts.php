<?php
$cnt = IntroFriendPeer::getCount($id);

if($sf_user->GetMemberId() != $member->getId()) {
  echo link_to(__('Write introductory essay'), 'introfriend/index?id=' . $id);
}

if ($cnt) {
  echo link_to(__('紹介文を読む') . '(' . $cnt . ')', 'introfriend/list?id=' . $id);
}

