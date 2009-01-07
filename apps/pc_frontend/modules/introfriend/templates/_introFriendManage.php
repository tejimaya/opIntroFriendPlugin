<td>
<?php
if ($introFriend) {
  echo '<p>' . $introFriend->getContent() . '</p><p>'
  . link_to(__('編集'), 'introfriend/index?id=' . $id) . ' '
  . link_to(__('削除'), 'introfriend/delete?id=' . $id) . '</p>';
}
else {
  echo link_to(_('紹介文を書く'), 'introfriend/index?id=' . $id);
}
?>
</td>
