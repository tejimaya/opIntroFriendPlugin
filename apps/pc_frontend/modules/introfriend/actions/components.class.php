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
    $this->introFriend = Doctrine::getTable('IntroFriend')->getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
  }

  public function executeIntroFriendList()
  {
    $this->introList = Doctrine::getTable('IntroFriend')->getComponentByTo($this->id);
  }
}
