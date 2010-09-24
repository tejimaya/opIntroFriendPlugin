<?php $pagerLink = '@obj_introfriend?id='.$id.'&page=%d' ?>
<?php echo op_include_pager_navigation($pager, $pagerLink); ?>
<?php
$list = array();
foreach ($pager->getResults() as $introFriend)
{
  $member = $introFriend->getMember_2();
  $img = link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76'))
       . '<br />' . $member->getName(), 'member/' . $member->getId());
  $list[$img] = '<p>' . nl2br($introFriend->getContent()) . '</p>';

  if ($id == $sf_user->getMemberId() || $member->getId() == $sf_user->getMemberId())
  {
    $list[$img] .= '<ul><li>';

    $options = array('from' => 'list');
    if ($member->getId() == $sf_user->getMemberId())
    {
      $list[$img] .= link_to(__('Edit introductory essay'), 'obj_member_introfriend', $introFriend->getMember()).'</li><li>';
      $options['target'] = 'my';
      $options['sf_subject'] = $introFriend->getMember();
    }
    else
    {
      $options['target'] = 'friend';
      $options['sf_subject'] = $introFriend->getMember_2();
    }

    $list[$img] .= link_to(__('Delete introductory essay'), 'obj_introfriend_delete', $options);
    $list[$img] .= '</li></ul>';
  }
}
include_list_box('introFriend', $list, array( 'title' => __('Introductory essay from my friend')));
?>
<?php echo op_include_pager_navigation($pager, $pagerLink); ?>
