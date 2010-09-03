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
    $naviList = Doctrine::getTable('Navigation')->findByUri('introfriend/index');
    foreach ($naviList as $navi)
    {
      $navi->setUri('@introfriend');
      $navi->save();
    }
  }
}
