<?php
include_page_title(__('Introductory essay from %my_friend%'));

echo '<p>' . __('Introductory essay is not being written') . '</p>';
if ($isFriend):
  echo link_to(__('Write introductory essay'), '@obj_member_introfriend?id='.$member->getId()).'<br>';
endif;
