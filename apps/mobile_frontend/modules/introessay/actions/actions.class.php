<?php

/**
 * introessay actions.
 *
 * @package    OpenPNE
 * @subpackage introessay
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class introessayActions extends opIntroEssayPluginIntroEssayActions 
{
 /**
  * Executes list action
  *
  * @param sfRequest $request A request object
  */
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
