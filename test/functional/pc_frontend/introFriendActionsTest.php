<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

include dirname(__FILE__).'/../../bootstrap/functional.php';
include dirname(__FILE__).'/../../bootstrap/database.php';

$browser = new opTestFunctional(new opBrowser(), new lime_test(null, new lime_output_color()));
$browser
  ->info('Login')
  ->login('sns@example.com', 'password')
  ->isStatusCode(302)

// CSRF
  ->info('/introfriend/2 - CSRF')
  ->post('/introfriend/2')
  ->checkCSRF()

  ->info('/introfriend/list/friend/delete/3 - CSRF')
  ->post('/introfriend/list/friend/delete/3')
  ->checkCSRF()

  ->info('/introfriend/manage/friend/delete/3 - CSRF')
  ->post('/introfriend/list/friend/delete/3')
  ->checkCSRF()

  ->info('/introfriend/manage/my/delete/3 - CSRF')
  ->post('/introfriend/list/my/delete/3')
  ->checkCSRF()

// XSS
  ->info('/member/3 - XSS')
  ->get('/member/3')
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
    ->isAllEscapedData('IntroFriend', 'content')
  ->end()

  ->info('/introfriend/list/1 - XSS')
  ->get('/introfriend/list/1')
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
    ->isAllEscapedData('IntroFriend', 'content')
  ->end()

  ->info('/introfriend/3 - XSS')
  ->get('/introfriend/3')
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
  ->end()

  ->info('/friend/manage - XSS')
  ->get('/friend/manage')
  ->with('html_escape')->begin()
    ->isAllEscapedData('IntroFriend', 'content')
  ->end()
;
