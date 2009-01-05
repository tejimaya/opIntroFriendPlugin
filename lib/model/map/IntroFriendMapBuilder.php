<?php



class IntroFriendMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.opIntroFriendPlugin.lib.model.map.IntroFriendMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(IntroFriendPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IntroFriendPeer::TABLE_NAME);
		$tMap->setPhpName('IntroFriend');
		$tMap->setClassname('IntroFriend');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('FROM_ID', 'FromId', 'INTEGER', 'member', 'ID', false, null);

		$tMap->addForeignKey('TO_ID', 'ToId', 'INTEGER', 'member', 'ID', false, null);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 