<?php 
include(dirname(__FILE__).'/../bootstrap/unit.php');
include(dirname(__FILE__).'/../bootstrap/database.php');

$t = new lime_test();

$table = Doctrine::getTable('IntroFriend');

// failed tests
//--------------------
$t->info('Before running the migration of opIntroFriendPlugin');

$t->is($table->createQuery()->count(), 6, 'count of intro_friend');
$t->isa_ok($table->find(1), 'IntroFriend', 'introductory of friend is exist');
$t->isa_ok($table->find(2), 'IntroFriend', 'introductory of friend is exist');
$t->isa_ok($table->find(3), 'IntroFriend', 'introductory of friend is exist');
$t->isa_ok($table->find(4), 'IntroFriend', 'introductory of non friend is exist');
$t->isa_ok($table->find(5), 'IntroFriend', 'introductory of non friend is exist');
$t->isa_ok($table->find(6), 'IntroFriend', 'introductory of non friend is exist');

// run the migrate
//--------------------
$t->info('run migrate of The opIntroFriendPlugin');

// set revision
$snsConfig = Doctrine::getTable('SnsConfig')->createQuery()
->where('name = ?', 'opIntroFriendPlugin_revision')
->fetchOne();
if (!$snsConfig)
{
  $snsConfig = new SnsConfig();
  $snsConfig->setName('opIntroFriendPlugin_revision');
}
$snsConfig->setValue(2);
$snsConfig->save();

// execute
exec('./symfony openpne:migrate --target=opIntroFriendPlugin');

// success tests
//--------------------
$t->info('After running the migration of opIntroFriendPlugin');

$t->is($table->createQuery()->count(), 3, 'count of intro_friend');
$t->isa_ok($table->find(1), 'IntroFriend', 'introductory of friend is exist');
$t->isa_ok($table->find(2), 'IntroFriend', 'introductory of friend is exist');
$t->isa_ok($table->find(3), 'IntroFriend', 'introductory of friend is exist');
$t->isa_ok($table->find(4), 'boolean', 'introductory of non friend was deleted');
$t->isa_ok($table->find(5), 'boolean', 'introductory of non friend was deleted');
$t->isa_ok($table->find(6), 'boolean', 'introductory of non friend was deleted');
