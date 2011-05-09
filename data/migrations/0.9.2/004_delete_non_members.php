<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision4_deleteNonMembers extends opMigration
{
  public function up()
  {
    // write from member does not exist
    $subQuery = 'SELECT m.* FROM member AS m WHERE m.id = intro_friend.member_id_from';
    $sql = 'DELETE FROM intro_friend WHERE NOT EXISTS ('.$subQuery.')';

    $conn = Doctrine::getTable('IntroFriend')->getConnection();
    $conn->execute($sql);

    // write to member does not exist
    $subQuery = 'SELECT m.* FROM member AS m WHERE m.id = intro_friend.member_id_to';
    $sql = 'DELETE FROM intro_friend WHERE NOT EXISTS ('.$subQuery.')';

    $conn = Doctrine::getTable('IntroFriend')->getConnection();
    $conn->execute($sql);
  }
}
