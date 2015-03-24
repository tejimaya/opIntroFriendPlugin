<?php

if (count($introList))
{
  $list = array();
  $i = 0;
  foreach ($introList as $obj)
  {
    $member = $obj['member'];
    $pos = 0;
    $num = $i++;
    if('4' === $member->getConfig('profile_page_public_flag') || $sf_user->isSNSMember())
    {
      $img = link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76'))
      .'<br />'.$member->getName(), 'member/'.$member->getId());
      $list[$img] = nl2br($obj['essay']);
    }
    else
    {
      $img = op_image_tag('no_image.gif', array('size' => '76x76'))
      .'<br /><!--'. $num .'-->'.__('Private<br />Member');
      $list[$img] = __('Private Introductory essay');
    }
  }
  $list[' '] = link_to(__('Show all').'('.$count.')', '@obj_introfriend?id='.$id);
  include_list_box('introFriend', $list, array('title' => __('Introductory essay from %my_friend%')));
}
