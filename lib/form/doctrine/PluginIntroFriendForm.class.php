<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginIntroFriend form.
 *
 * @package    OpenPNE
 * @subpackage form
 * @author     Masato Nagasawa <nagasawa@tejimaya.com>
 */
abstract class PluginIntroFriendForm extends BaseIntroFriendForm
{
  public function setup()
  {
    parent::setup();
    unset($this['created_at'], $this['updated_at'], $this['member_id_to'], $this['member_id_from']);
    $this->setWidget('content', new sfWidgetFormTextarea());
    $this->widgetSchema->setLabel('content', 'Introductory essay');

    $this->widgetSchema->setNameFormat('intro_friend[%s]');
    $this->setValidator('content', new sfValidatorString(array('required' => true)));
    $this->widgetSchema['content']->setAttributes(array('rows' => 8, 'cols' => 88));
  }
}
