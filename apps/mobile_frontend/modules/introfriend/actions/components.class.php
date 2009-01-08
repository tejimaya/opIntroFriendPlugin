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
  public function executeIntroFriendLink($request)
  {
    $this->isFriend = true;
    $relation = MemberRelationshipPeer::retrieveByFromAndTo($this->getUser()->getMemberId(), $request->getParameter('id'));
    if ($relation == null)
    {
      $this->isFriend = false;
    }
    else
    {
      if(!$relation->getIsFriend())
      {
        $this->isFriend = false;
      }
    }
  }

  public function executeIntroFriendManage($request)
  {
    $this->introFriend = IntroFriendPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
  }
}
