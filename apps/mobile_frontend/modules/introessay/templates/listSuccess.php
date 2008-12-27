<?php
include_page_title(__('Introductory essay from my friend'));
use_helper('Pagination');

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($pager->getResults() as $introEssay) {
      $criteria = new Criteria();
      $criteria->add(MemberPeer::ID, $introEssay->getFromId());
      $writer = MemberPeer::doSelectOne($criteria);

      $list[] = __('Name') . ' :<br />'
              . link_to($writer->getName(), 'member/profile?id=' . $writer->getId()) . '<br /><br />'
              . __('Introductory essay') . ' :<br />'
              . nl2br($introEssay->getContent());
}
$options = array(
  'border' => true,
);
include_list_box('introEssay', $list, $options);

echo pager_navigation($pager, 'introessay/list?page=%d&id=' . $sf_params->get('id'), false);
