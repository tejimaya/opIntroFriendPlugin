<?php
/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * introfriend actions.
 *
 * @package    OpenPNE
 * @subpackage introfriend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class opIntroFriendPluginIntroFriendComponents extends sfComponents
{

  public function executeNoticeUnread(sfWebRequest $request)
  {
    $this->member = $this->getUser()->getMember();
    $this->introFriendUnread = Doctrine_Core::getTable('IntroFriendUnread')->findOneByMemberId($this->member->getId());
  }
}
