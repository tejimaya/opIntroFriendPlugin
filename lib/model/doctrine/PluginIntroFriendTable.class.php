<?php
/**
 */
class PluginIntroFriendTable extends Doctrine_Table
{
  /**
   * Get ByTo from Component
   * @param int $memberIdTo member id
   * @return array object array
   */
  public function getComponentByTo($memberIdTo)
  {
    $introFriends = $this->getListQuery($memberIdTo)
      ->limit(sfConfig::get('app_max_introfriend'))
      ->execute();

    $list = array();
    foreach ($introFriends as $i => $introFriend)
    {
      $list[$i] = array();
      $string = $introFriend->getContent();
      $list[$i]['member'] = $introFriend->getMember_2();
      for ($j = 0, $pos = 0; $j < sfconfig::get('app_line_introfriend'); $j++)
      {
        $pos = mb_strpos($string, "\n", $pos + 1);
        if (!$pos) { break; }
      }
      if ($pos) { $string = mb_substr($string, 0, $pos - 1); }
      $list[$i]['essay'] = $string;
    }

    return $list;
  }

  /**
   * Get introFriend from member_id_from and member_id_to
   * @param int $memberIdFrom member id
   * @param int $memberIdTo member id
   * @return object object
   */
  public function getByFromAndTo($memberIdFrom, $memberIdTo)
  {
    return $this->createQuery()
      ->where('member_id_from = ?', $memberIdFrom)
      ->addWhere('member_id_to = ?', $memberIdTo)
      ->fetchOne();
  }

  /**
   * Get introFriend pager
   * @param int $memberIdTo member id
   * @param int $page page number
   * @param int $size show number
   * @return pager pager
   */
  public function getListPager($memberIdTo, $page = 1, $size = 20)
  {
    $pager = new sfDoctrinePager('IntroFriend', $size);
    $pager->setQuery($this->getListQuery($memberIdTo));
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public function getListQuery($memberIdTo)
  {
    return Doctrine::getTable('IntroFriend')->createQuery()
      ->where('member_id_to = ?', $memberIdTo)
      ->orderBy('id');
  }

  /**
   * Get Count
   * @param int $memberIdTo member id
   * @return int count
   */
  public function getCount($memberIdTo)
  {
    return $this->getListQuery($memberIdTo)->count();
  }

  public function deleteNonFriend($memberId, $memberId2)
  {
    $relation = Doctrine::getTable('MemberRelationship')->retrieveByFromAndTo($memberId, $memberId2);
    if ($relation && $relation->getIsFriend())
    {
      return;
    }

    Doctrine::getTable('IntroFriend')->createQuery()
      ->delete()
      ->where('member_id_to = ?', $memberId)
      ->andWhere('member_id_from = ?', $memberId2)
      ->execute();

    Doctrine::getTable('IntroFriend')->createQuery()
      ->delete()
      ->where('member_id_from = ?', $memberId)
      ->andWhere('member_id_to = ?', $memberId2)
      ->execute();
  }
}
