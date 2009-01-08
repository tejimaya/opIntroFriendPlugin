<?php
include_page_title(__('Introductory essay from my friend'));

echo '<p>' . __('Introductory essay is not being written') . '</p>';

echo pager_navigation($pager, 'introfriend/list?page=%d&id=' . $sf_params->get('id'), false);
