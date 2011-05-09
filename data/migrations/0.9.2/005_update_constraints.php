<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision5_updateContraints extends opMigration
{
  public function up()
  { $import = Doctrine_Manager::connection()->import;
    $export = Doctrine_Manager::connection()->export;

    $relations = $import->listTableRelations('intro_friend');

    foreach ($relations as $relation)
    {
      if ($relation['table'] == 'member' && $relation['local'] == 'member_id_from' && $relation['foreign'] == 'id')
      {
        $export->dropForeignKey('intro_friend', 'intro_friend_member_id_from_member_id');
        continue;
      }
      if ($relation['table'] == 'member' && $relation['local'] == 'member_id_to' && $relation['foreign'] == 'id')
      {
        $export->dropForeignKey('intro_friend', 'intro_friend_member_id_to_member_id');
        continue;
      }
    }

    // intro_friend_member_id_from_member_id
    $definition = array(
                'name'          => 'intro_friend_member_id_from_member_id',
                'local'         => 'member_id_from',
                'foreign'       => 'id',
                'foreignTable'  => 'member',
                'onDelete'      => 'CASCADE'
    );
    $export->createForeignKey('intro_friend', $definition);

    // intro_friend_member_id_to_member_id
    $definition = array(
                'name'          => 'intro_friend_member_id_to_member_id',
                'local'         => 'member_id_to',
                'foreign'       => 'id',
                'foreignTable'  => 'member',
                'onDelete'      => 'CASCADE'
    );
    $export->createForeignKey('intro_friend', $definition);
  }
}
