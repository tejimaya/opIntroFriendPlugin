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
  public function executeIntroFriendManage()
  {
    $this->id = $this->getUser()->getAttribute('id');
    $this->introFriend = IntroFriendPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
  }
  public function executeIntroFriendList()
  {
    $this->introList = IntroFriendPeer::getComponentByTo($this->id);
  }
}
