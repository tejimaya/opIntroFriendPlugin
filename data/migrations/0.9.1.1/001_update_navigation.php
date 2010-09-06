<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */
class Revision1_updateNavigation extends opMigration
{
  public function migrate($direction)
  {
    opDoctrineQuery::create()
      ->update('Navigation n')
      ->set('n.uri', '@obj_member_introfriend')
      ->where('n.uri = ?', 'introfriend/index')
      ->execute();
  }
}
