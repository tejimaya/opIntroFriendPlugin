<?php

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
 }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request)
  {
    $this->friendCheck();
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
    $this->friendCheck();
    $this->introFriend = IntroFriendPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->forward404Unless($this->introFriend, 'Undefined member.');
    if ($request->isMethod('post'))
    {
      if ($request->hasParameter('delete'))
      {
        if (isset($this->introFriend)) $this->introFriend->delete();
      }
      $this->redirect('member/' . $this->id);
    }
  }

  /**
  * Executes friend check
  */
  public function friendCheck()
  {
    // friend check
    $this->relation = MemberRelationshipPeer::retrieveByFromAndTo($this->getUser()->getMemberId(), $this->id);
    $this->forward404Unless($this->relation, "this member is not friend");
    if ( !$this->relation->getIsFriend() ) $this->forward404Unless( NULL, "this member is not friend");
  }
}
