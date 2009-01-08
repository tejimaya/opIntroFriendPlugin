<?php
include_page_title(__('Introductory essay from my friend'));

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($pager->getResults() as $i => $introFriend)
{
  $writer = $writers[$i];
  $list[$i] = '<p>' . __('Name') . ' :</p>'
          . '<p>' . link_to($writer->getName(), 'member/profile?id=' . $writer->getId()) . '</p>'
          . '<p>' . __('Introductory essay') . ' :</p>'
          . nl2br($introFriend->getContent());

  if ($writer->getId() == $sf_user->getMemberId())
  {
    $list[$i] .= '<p>' . link_to(__('Edit'), 'introfriend/index?id=' . $id) . '<br />'
               . link_to(__('Delete'), 'introfriend/delete?id=' . $id) . '</p>';
  }
}
$options = array(
  'border' => true,
);
include_list_box('introFriend', $list, $options);

echo pager_navigation($pager, 'introfriend/list?page=%d&id=' . $sf_params->get('id'), false);
