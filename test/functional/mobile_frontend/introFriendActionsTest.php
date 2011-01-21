<?php 

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

$_app = 'mobile_frontend';
include dirname(__FILE__).'/../../bootstrap/functional.php';
include dirname(__FILE__).'/../../bootstrap/database.php';

$browser = new opTestFunctional(new opBrowser(), new lime_test(null, new lime_output_color()));
$browser->setMobile();
$browser
  ->info('Login')
  ->login('sns@example.com', 'password')
  ->isStatusCode(302)

// CSRF
  ->info('/introfriend/2 - CSRF')
  ->post('/introfriend/2')
  ->checkCSRF(array('<input type="hidden" name="intro_friend\[_csrf_token\]" id="intro_friend__csrf_token" /><font color="#FF0000">'."\n".'<br>必須項目です。'))
  ->info('/introfriend/manage/my/delete/3 - CSRF')
  ->post('/introfriend/manage/my/delete/3')
  ->checkCSRF()

// XSS
  ->info('/introfriend/list/1 - XSS')
  ->get('/introfriend/list/1')
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
    ->isAllEscapedData('IntroFriend', 'content')
  ->end()

  ->info('/friend/manage - XSS')
  ->get('/friend/manage')
  ->with('html_escape')->begin()
    ->isAllEscapedData('IntroFriend', 'content')
  ->end()
;
