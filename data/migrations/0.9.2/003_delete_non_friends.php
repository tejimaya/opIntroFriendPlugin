<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision3_deleteNonFriend extends opMigration
{
  public function up() {
    $subQuery = 'SELECT mr.* FROM member_relationship AS mr WHERE mr.member_id_to = intro_friend.member_id_to AND mr.member_id_from = intro_friend.member_id_from AND mr.is_friend = 1';
    $sql = 'DELETE FROM intro_friend WHERE NOT EXISTS ('.$subQuery.')';

    $conn = Doctrine::getTable('IntroFriend')->getConnection();
    $conn->execute($sql);
  }
}
