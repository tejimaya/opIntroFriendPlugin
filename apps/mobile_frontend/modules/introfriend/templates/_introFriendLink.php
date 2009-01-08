<?php
$cnt = IntroFriendPeer::getCount($id);

echo link_to(__('Read introductory essay') . '(' . $cnt . ')', 'introfriend/list?id=' . $id);
if($sf_user->GetMemberId() != $member->getId()) {
  echo ' / ' . link_to(__('Write'), 'introfriend/index?id=' . $id);
}

