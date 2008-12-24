<?php

class IntroEssayPeer extends BaseIntroEssayPeer
{
  /**
   * Get introEssay from from_id and to_id
   * @param int $from_id member id
   * @param int $to_id member id
   */
  public function getByTo($to_id)
  {
    $criteria = new Criteria();
    $criteria->add(IntroEssayPeer::TO_ID, $to_id);
    $criteria->addDescendingOrderByColumn(IntroEssayPeer::ID);
    return IntroEssayPeer::doSelect($criteria);
  }
  /**
   * Get introEssay from from_id and to_id
   * @param int $from_id member id
   * @param int $to_id member id
   */
  public function getByFromAndTo($from_id, $to_id)
  {
    $criteria = new Criteria();
    $criteria->add(self::FROM_ID, $from_id);
    $criteria->add(self::TO_ID, $to_id);
    return self::doSelectOne($criteria);
  }

  /**
   * Get introEssay pager
   * @param int $to_id member id
   * @param int $page page number
   * @param int $size show number
   */
  public static function getListPager($to_id, $page = 1, $size = 20)
  {
    $c = new Criteria();
    $c->add(IntroEssayPeer::TO_ID, $to_id);
    $c->addDescendingOrderByColumn(IntroEssayPeer::ID);

    $pager = new sfPropelPager('IntroEssay', $size);
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }
}
