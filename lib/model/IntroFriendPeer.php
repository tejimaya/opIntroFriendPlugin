<?php

class IntroFriendPeer extends BaseIntroFriendPeer
{
  /**
   * Get introFriend from to_id
   * @param int $to_id member id
   * @return array array object
   */
  public static function getByTo($to_id)
  {
    $criteria = new Criteria();
    $criteria->add(IntroFriendPeer::TO_ID, $to_id);
    $criteria->addDescendingOrderByColumn(IntroFriendPeer::ID);
    return IntroFriendPeer::doSelect($criteria);
  }

  /**
   * Get ByTo from Parts
   * @param int $id member id
   * @return array object array
   */
  public static function getPartsByTo($id)
  {
    $criteria = new Criteria();
    $criteria->add(self::TO_ID, $id);
    $criteria->addDescendingOrderByColumn(self::ID);
    $criteria->setLimit(sfConfig::get('app_max_introfriend'));
    return self::doSelect($criteria);
  }

  /**
   * Get introFriend from from_id and to_id
   * @param int $from_id member id
   * @param int $to_id member id
   * @return object object
   */
  public static function getByFromAndTo($from_id, $to_id)
  {
    $criteria = new Criteria();
    $criteria->add(self::FROM_ID, $from_id);
    $criteria->add(self::TO_ID, $to_id);
    return self::doSelectOne($criteria);
  }

  /**
   * Get introFriend pager
   * @param int $to_id member id
   * @param int $page page number
   * @param int $size show number
   * @return pager pager
   */
  public static function getListPager($to_id, $page = 1, $size = 20)
  {
    $c = new Criteria();
    $c->add(IntroFriendPeer::TO_ID, $to_id);
    $c->addDescendingOrderByColumn(IntroFriendPeer::ID);

    $pager = new sfPropelPager('IntroFriend', $size);
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  /**
   * Get Count
   * @param int $id member id
   * @return int count
   */
  public static function getCount($id)
  {
    $criteria = new Criteria();
    $criteria->add(self::TO_ID, $id);
    $criteria->addDescendingOrderByColumn(self::ID);
    return self::doCount($criteria);
  }
}
