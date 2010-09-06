<td>
<?php
if ($introFriend) {
  echo '<p>' . $introFriend->getContent() . '</p><p>'
  . link_to(__('Edit'), 'obj_member_introfriend', $introFriend->getMember()) . ' '
  . link_to(__('Delete'), 'obj_introfriend_delete', $introFriend) . '</p>';
}
else {
  echo '<p>' . link_to(__('Write introductory essay'), '@obj_member_introfriend?id='.$id) . '</p>';
}
?>
</td>
