<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision7_addUnreadTable extends opMigration
{
  public function up()
  {
    $export = Doctrine_Manager::connection()->export;

    $export->createTable('intro_friend_unread',
      array(
        'member_id' => array('type' => 'integer', 'length' => 4, 'primary' => true, 'notnull' => true, 'default' => 0),
        'read_at' => array('type' => 'timestamp', 'notnull' => true),
        'count' => array('type' => 'integer', 'length' => 4, 'unsigned' => true, 'notnull' => true, 'default' => 0),
        'created_at' => array('type' => 'timestamp', 'notnull' => true),
        'updated_at' => array('type' => 'timestamp', 'notnull' => true),
      )
    );
    
    $export->createForeignKey('intro_friend_unread', array(
      'name' => 'intro_friend_unread_member_id_member_id',
      'local' => 'member_id',
      'foreign' => 'id',
      'foreignTable' => 'member',
      'onDelete' => 'CASCADE',
    ));
  }
}
