<?php
namespace Common\Model;
use Think\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel
{
	protected $_link = array(
		'AuthGroupAccess'=>array(
			mapping_type=>self::HAS_ONE,
		)
	);
}