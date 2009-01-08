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
class opIntroFriendPluginIntroFriendActions extends sfActions
{
 /**
  * Executes first time
  */
  public function preExecute()
  {
    // id check
    if(!$this->hasRequestParameter('id')) $this->forward404Unless( NULL, 'Undefined id.');
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());

    // member check
    $this->member = MemberPeer::retrieveByPk($this->id);
    $this->forward404Unless($this->member, 'Undefined member.');

    if ($this->id != $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_navi_type', 'friend');
    }
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request)
  {
    if (!$this->friendCheck())
    {
      return sfView::ERROR;
    }
    $this->introFriend = IntroFriendPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->form = new IntroFriendForm($this->introFriend);
    if ($request->isMethod('post'))
    {
      $array = $request->getParameter('intro_friend');
      if (!$this->introFriend)
      {
        $array['from_id'] = $this->getUser()->GetMemberId();
        $array['to_id'] = $this->id;
      }
      $this->form->bind($array);
      if ($this->form->isValid())
      {
        if ($this->introFriend)
        {
          $this->introFriend->setContent($array['content']);
          $this->introFriend->save();
        }
        else
        {
          $this->form->save();
        }
        $this->redirect('member/profile?id=' . $this->id);
        return sfView::SUCCESS;
      }
    }
    return sfView::INPUT;
  }

 /**
  * Executes delete action
  *
  * @param sfRequest $request A request object
  */
  public function executeDelete($request)
  {
    if (!$this->friendCheck())
    {
      return sfView::ERROR;
    }
    $this->introFriend = IntroFriendPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->forward404Unless($this->introFriend, 'Undefined member.');
    if ($request->isMethod('post'))
    {
      if ($request->hasParameter('delete'))
      {
        if (isset($this->introFriend)) $this->introFriend->delete();
        $this->redirect('member/profile?id=' . $this->id);
      }
      $this->redirect('introfriend/list?id=' . $this->id);
    }
  }

  /**
  * Executes friend check
  */
  public function friendCheck()
  {
    // friend check
    $this->relation = MemberRelationshipPeer::retrieveByFromAndTo($this->getUser()->getMemberId(), $this->id);
    if ($this->relation==null)
    {
      return false;
    }
    if(!$this->relation->getIsFriend())
    {
      return false;
    }
  }
}
