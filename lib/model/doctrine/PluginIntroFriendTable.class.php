<?php
/**
 */
class PluginIntroFriendTable extends Doctrine_Table
{
  /**
   * Get introFriend from member_id_to
   * @param int $memberIdTo member id
   * @return array array
   */
  public function getByTo($memberIdTo)
  {
    $introFriends = $this->createQuery()
      ->select('content, member_id_from')
      ->where('member_id_to = ?', $memberIdTo)
      ->orderBy('id')
      ->execute(array(), Doctrine::HYDRATE_NONE);

    $list = array();
    foreach ($introFriends as $i => $introFriend) {
      $list[$i] = array();
      $list[$i]['essay'] = $introFriend[0];
      $list[$i]['member'] = $introFriend[1];
    }

    return $list;
  }

  /**
   * Get ByTo from Component
   * @param int $memberIdTo member id
   * @return array object array
   */
  public function getComponentByTo($memberIdTo)
  {
    $introFriends = $this->createQuery()
      ->where('member_id_to = ?', $memberIdTo)
      ->orderBy('id')
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
    $q = Doctrine::getTable('IntroFriend')->createQuery()
      ->where('member_id_to = ?', $memberIdTo)
      ->orderBy('id');

    $pager = new sfDoctrinePager('IntroFriend', $size);
    $pager->setQuery($q);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  /**
   * Get Count
   * @param int $memberIdTo member id
   * @return int count
   */
  public function getCount($memberIdTo)
  {
    return $this->createQuery()
      ->where('member_id_to = ?', $memberIdTo)
      ->count();
  }

  /**
   * Get to member
   * @param array $introFriends IntroFriend array
   * @return array Member array
   */
  public function getWriters($introFriends)
  {
    $writers = array();
    foreach ($introFriends as $i => $introFriend) {
      $writers[$i] = $this->getTable('Member')->find($introFriend->getMemberIdFrom());
    }
    return $writers;
  }
}
