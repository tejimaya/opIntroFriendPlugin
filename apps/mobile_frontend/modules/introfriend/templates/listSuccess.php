<?php
include_page_title(__('Introductory essay from my friend'));

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($pager->getResults() as $i => $introFriend) {
  $writer = $writers[$i];
  $list[] = __('Name') . ' :<br />'
          . link_to($writer->getName(), 'member/profile?id=' . $writer->getId()) . '<br /><br />'
          . __('Introductory essay') . ' :<br />'
          . nl2br($introFriend->getContent());
}
$options = array(
  'border' => true,
);
include_list_box('introFriend', $list, $options);

echo pager_navigation($pager, 'introfriend/list?page=%d&id=' . $sf_params->get('id'), false);
