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
  public function up()
  {
    $conn = $this->getConnection();

    if (!$conn->import->tableIndexExists('created_at_idx', 'intro_friend'))
    {
      $this->addIndex('intro_friend', 'created_at_idx', array('fields' => array('created_at')));
    }

    if (!$conn->import->tableIndexExists('member_id_from_member_id_to_idx', 'intro_friend'))
    {
      $this->addIndex('intro_friend', 'member_id_from_member_id_to_idx', array('fields' => array('member_id_from', 'member_id_to')));
    }
  }

  public function down()
  {
    $conn = $this->getConnection();

    if ($conn->import->tableIndexExists('created_at_idx', 'intro_friend'))
    {
      $this->dropIndex('intro_friend', 'created_at_idx');
    }

    if ($conn->import->tableIndexExists('member_id_from_member_id_to_idx', 'intro_friend'))
    {
      $this->dropIndex('intro_friend', 'member_id_from_member_id_to_idx');
    }
  }
}
