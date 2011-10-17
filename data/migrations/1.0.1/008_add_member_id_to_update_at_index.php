<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision8_addMemberIdToUpdateAtIndex extends opMigration
{
  public function up()
  {
    $export = Doctrine_Manager::connection()->export;

    $export->createIndex('intro_friend', 'member_id_to_updated_at_idx', array(
      'fields' => array('member_id_to', 'updated_at'),
    ));
  }
}
