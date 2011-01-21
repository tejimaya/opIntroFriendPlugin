<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opIntroFriendPluginObserver
 *
 * @package opIntroFriendPlugin
 * @author  Masato Nagasawa <nagasawa@tejimaya.com>
 */
class opIntroFriendPluginObserver
{
  static public function listenToPostActionEventSendFriendUnlinkDeleteIntroFriend($arguments)
  {
    if ($arguments['result'] != sfView::SUCCESS)
    {
      return;
    }

    $request = $arguments['actionInstance']->getRequest();
    $friendId = $request->getParameter('id');
    $memberId  = sfContext::getInstance()->getUser()->getMemberId();
    Doctrine::getTable('IntroFriend')->deleteNonFriend($friendId, $memberId);
  }
}
