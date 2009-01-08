<?php
if ($introFriend)
{
  echo '<p>' . $introFriend->getContent() . '</p><p>'
  . '[' . link_to(__('Edit'), 'introfriend/index?id=' . $id) . '] '
  . '[' . link_to(__('Delete'), 'introfriend/delete?id=' . $id) . ']</p>';
}
else
{
  echo '[' . link_to(__('Write introductory essay'), 'introfriend/index?id=' . $id) . ']';
}
?>
