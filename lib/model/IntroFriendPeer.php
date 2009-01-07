<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class IntroFriendPeer extends BaseIntroFriendPeer
{
  /**
   * Get introFriend from to_id
   * @param int $to_id member id
   * @return array array
   */
  public static function getByTo($to_id)
  {
    $criteria = new Criteria();
    $criteria->add(IntroFriendPeer::TO_ID, $to_id);
    $criteria->addDescendingOrderByColumn(IntroFriendPeer::ID);
    $introFriends = IntroFriendPeer::doSelect($criteria);
    $list = array();
    foreach ($introFriends as $i => $introFriend) {
      $list[$i] = array();
      $list[$i]['essay'] = nl2br($introFriend->getContent());
      $list[$i]['member'] = MemberPeer::retrieveByPk($introFriend->getFromId());
    }
    return $list;
  }

  /**
   * Get ByTo from Component
   * @param int $id member id
   * @return array object array
   */
  public static function getComponentByTo($id)
  {
    $criteria = new Criteria();
    $criteria->add(self::TO_ID, $id);
    $criteria->addDescendingOrderByColumn(self::ID);
    $criteria->setLimit(sfConfig::get('app_max_introfriend'));
    $introFriends = self::doSelect($criteria);
    $list = array();
    foreach ($introFriends as $i => $introFriend) {
      $list[$i] = array();
      $string = $introFriend->getContent();
      $list[$i]['member'] = MemberPeer::retrieveByPk($introFriend->getFromId());
      for ($j = 0, $pos = 0; $j < sfconfig::get('app_line_introfriend'); $j++)
      {
        $pos = mb_strpos($string, "\n", $pos + 1);
        if (!$pos) { break; }
      }
      if ($pos) { $string = mb_substr($string, 0, $pos - 1); }
      $list[$i]['essay'] = nl2br($string);
    }
    return $list;
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

  /**
   * Get to member
   * @param array $introFriends IntroFriend array
   * @return array Member array
   */
  public static function getWriters($introFriends)
  {
    $writers = array();
    foreach ($introFriends as $i => $introFriend) {
      $writers[$i] = MemberPeer::retrieveByPk($introFriend->getFromId());
    }
    return $writers;
  }
}
