<?php
include_page_title('紹介文');
use_helper('Pagination');

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($pager->getResults() as $introEssay) {
      $criteria = new Criteria();
      $criteria->add(MemberPeer::ID, $introEssay->getFromId());
      $writer = MemberPeer::doSelectOne($criteria);

      $list[] = '氏名 :<br />'
              . link_to($writer->getName(), 'member/profile?id=' . $writer->getId()) . '<br /><br />'
              . '紹介文 :<br />'
              . nl2br($introEssay->getContent());
}
$options = array(
  'border' => true,
);
include_list_box('introEssay', $list, $options);

echo pager_navigation($pager, 'introessay/list?page=%d&id=' . $sf_params->get('id'), false);
