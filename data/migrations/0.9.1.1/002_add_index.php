<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision2_addIndex extends opMigration
{
  public function migrate($direction)
  {
    $this->addIndex('intro_friend', 'created_at_idx', array('fields' => array('created_at')));
    $this->addIndex('intro_friend', 'member_id_to_idx', array('fields' => array('member_id_to')));
    $this->addIndex('intro_friend', 'member_id_from_idx', array('fields' => array('member_id_from')));
    $this->addIndex('intro_friend', 'member_id_from_member_id_to_idx', array('fields' => array('member_id_from', 'member_id_to')));
  }
}
