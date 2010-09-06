<?php
op_mobile_page_title(__('Introductory essay from my friend'));

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($pager->getResults() as $i => $introFriend)
{
  $member = $introFriend->getMember_2();
  $list[$i] = '<p>' . __('Name') . ' :</p>'
          . '<p>' . link_to($member->getName(), '@member_profile?id='.$member->getId()) . '</p>'
          . '<p>' . __('Introductory essay') . ' :</p>'
          . nl2br($introFriend->getContent());

  if ($id == $sf_user->getMemberId() || $member->getId() == $sf_user->getMemberId()) {
    if ($member->getId() == $sf_user->getMemberId())
    {
      $list[$i] .= '<p>' . link_to(__('Edit'), 'obj_member_introfriend', $introFriend->getMember()) . '<br>';
    }
    $list[$i] .= link_to(__('Delete'), 'obj_introfriend_delete', $introFriend) . '</p>';
  }
}
$options = array(
  'border' => true,
);
include_list_box('introFriend', $list, $options);

echo pager_navigation($pager, '@obj_introfriend?id='.$id.'&page=%d', false);
