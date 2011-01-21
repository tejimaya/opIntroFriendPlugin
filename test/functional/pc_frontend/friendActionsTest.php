<?php 
/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

include(dirname(__FILE__).'/../../bootstrap/unit.php');
include dirname(__FILE__).'/../../bootstrap/functional.php';
include dirname(__FILE__).'/../../bootstrap/database.php';

$t = new lime_test();
$browser = new opTestFunctional(new opBrowser(), $t);

$table = Doctrine::getTable('IntroFriend');

$t->info('-- If removed the friend test --');

$t->diag('Before removing friend');
$t->is($table->createQuery()->count(), 6, 'count of intro_friend');
$t->isa_ok($table->find(1), 'IntroFriend', 'introductory of friend is exist(1 > 3)');
$t->isa_ok($table->find(2), 'IntroFriend', 'introductory of friend is exist(3 > 1)');

$browser
  ->info('Login')
  ->login('sns@example.com', 'password')

  ->info('unlink friend')
  ->get('/friend/unlink/3')
  ->click('はい')
;

$t->diag('After removing Ffiend');
$t->is($table->createQuery()->count(), 4, 'count of intro_friend(deleted 2 record)');
$t->isa_ok($table->find(1), 'boolean', 'removed by friend was deleted introductory(1 > 3)');
$t->isa_ok($table->find(2), 'boolean', 'removed by friend was deleted introductory(3 > 1)');

$t->info('-- If given the non friend in page of the unlink of friend --');

$browser
  ->info('unlink friend')
  ->post('/friend/unlink/4')
;

$t->is($table->createQuery()->count(), 4, 'not deleted');

$t->info('-- If given the friend(not writing) in page of the unlink of friend --');

$browser
  ->info('unlink friend')
  ->get('/friend/unlink/5')
  ->click('はい')
;

$t->is($table->createQuery()->count(), 4, 'not deleted');
