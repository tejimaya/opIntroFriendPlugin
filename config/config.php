<?php

$this->dispatcher->connect('op_action.post_execute_friend_unlink', array('opIntroFriendPluginObserver', 'listenToPostActionEventSendFriendUnlinkDeleteIntroFriend'));

