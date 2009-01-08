<?php
/**
 * introfriend components.
 *
 * @package    OpenPNE
 * @subpackage introfriend
 * @author     Masato Nagasawa <nagasawa@tejimaya.com>
 */
class introfriendComponents extends sfComponents
{
  public function executeIntroFriendManage($request)
  {
    $this->introFriend = IntroFriendPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
  }
}
