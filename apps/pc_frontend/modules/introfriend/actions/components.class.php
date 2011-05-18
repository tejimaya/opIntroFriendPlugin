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
    $this->relation = Doctrine::getTable('MemberRelationship')->retrieveByFromAndTo($this->getUser()->getMemberId(), $this->id);
    $this->introFriend = Doctrine::getTable('IntroFriend')->getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
  }

  public function executeIntroFriendList()
  {
    $this->introList = Doctrine::getTable('IntroFriend')->getComponentByTo($this->id);
    $this->count = Doctrine::getTable('IntroFriend')->getCount($this->id);
  }
}
