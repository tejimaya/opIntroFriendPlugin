<?php

echo link_to(__('Read introductory essay') . '(' . $count . ')', 'obj_introfriend', $member);

if ($isFriend == true)
{
  echo ' / ' . link_to(__('Write'), 'obj_member_introfriend', $member);
}

?>
<br>
