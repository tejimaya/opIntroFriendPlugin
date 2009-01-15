<?php

$cnt = IntroFriendPeer::getCount($id);

echo link_to(__('Read introductory essay') . '(' . $cnt . ')', 'introfriend/list?id=' . $id) . '<br>';

if ($isFriend == true)
{
  echo ' / ' . link_to(__('Write'), 'introfriend/index?id=' . $id);
}

