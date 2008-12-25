<?php

/**
 * introessay actions.
 *
 * @package    OpenPNE
 * @subpackage introessay
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class introessayActions extends sfActions
{
  public function preExecute()
  {
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());

    $this->relation = MemberRelationshipPeer::retrieveByFromAndTo($this->getUser()->getMemberId(), $this->id);
    if (!$this->relation) {
      $this->relation = new MemberRelationship();
      $this->relation->setMemberIdFrom($this->getUser()->getMemberId());
      $this->relation->setMemberIdTo($this->id);
    }
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request)
  {
    $this->introEssay = IntroEssayPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->form = new IntroEssayForm($this->introEssay);
    if ($request->isMethod('post'))
    {
      $array = $request->getParameter('intro_essay');
      if (!$this->introEssay)
      {
        $array['from_id'] = $this->getUser()->GetMemberId();
        $array['to_id'] = $this->id;
      }
      $this->form->bind($array);
      if ($this->form->isValid())
      {
        if ($this->introEssay)
        {
          $this->introEssay->setContent($array['content']);
          $this->introEssay->save();
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

  public function executeDeleteInfo($request)
  {
  }

  public function executeDelete($request)
  {
    $this->introEssay = IntroEssayPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->delete();
    redirect("member/?id=" . $this->id);
  }

  public function executeList($request)
  {
    $this->redirectIf($this->relation->isAccessBlocked(), '@error');

    $this->pager = IntroEssayPeer::getListPager($this->id, $request->getParameter('page', 1));

    if (!$this->pager->getNbResults()) {
      return sfView::ERROR;
    }

    return sfView::SUCCESS;
  }
}
