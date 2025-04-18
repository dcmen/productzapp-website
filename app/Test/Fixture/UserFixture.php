<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'provider' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_at' => array('type' => 'timestamp', 'null' => false),
		'updated_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'encrypted_password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'reset_password_token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'reset_password_sent_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'remember_created_at' => array('type' => 'datetime', 'null' => true, 'default' => '0000-00-00 00:00:00'),
		'sign_in_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'current_sign_in_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'last_sign_in_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'current_sign_in_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_sign_in_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'uid' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'phone' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'company_phone' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'company_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'authentication_token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'dealer_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'dealer_solution_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'confirmation_token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'confirmed_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'confirmation_sent_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'role_id' => array('type' => 'integer', 'null' => true, 'default' => '2', 'unsigned' => false),
		'invitation_token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'invitation_created_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'invitation_sent_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'invitation_accepted_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'invitation_limit' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'invited_by_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'invited_by_type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'invitations_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'avatar_file_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'avatar_content_type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'avatar_file_size' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'avatar_updated_at' => array('type' => 'timestamp', 'null' => true, 'default' => '0000-00-00 00:00:00'),
		'license_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'easy_car_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'dealer_principle' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tel' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'company_email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'company_website' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'main_tel' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'main_fax' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'abn' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'acn' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'dun' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'provider' => 'Lorem ipsum dolor sit amet',
			'url' => 'Lorem ipsum dolor sit amet',
			'created_at' => 1439880828,
			'updated_at' => 1439880828,
			'email' => 'Lorem ipsum dolor sit amet',
			'encrypted_password' => 'Lorem ipsum dolor sit amet',
			'reset_password_token' => 'Lorem ipsum dolor sit amet',
			'reset_password_sent_at' => '2015-08-18 08:53:48',
			'remember_created_at' => '2015-08-18 08:53:48',
			'sign_in_count' => 1,
			'current_sign_in_at' => 1439880828,
			'last_sign_in_at' => 1439880828,
			'current_sign_in_ip' => 'Lorem ipsum dolor sit amet',
			'last_sign_in_ip' => 'Lorem ipsum dolor sit amet',
			'uid' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'company_phone' => 'Lorem ipsum dolor sit amet',
			'company_name' => 'Lorem ipsum dolor sit amet',
			'authentication_token' => 'Lorem ipsum dolor sit amet',
			'dealer_number' => 'Lorem ipsum dolor sit amet',
			'dealer_solution_number' => 'Lorem ipsum dolor sit amet',
			'confirmation_token' => 'Lorem ipsum dolor sit amet',
			'confirmed_at' => 1439880828,
			'confirmation_sent_at' => 1439880828,
			'role_id' => 1,
			'invitation_token' => 'Lorem ipsum dolor sit amet',
			'invitation_created_at' => 1439880828,
			'invitation_sent_at' => 1439880828,
			'invitation_accepted_at' => 1439880828,
			'invitation_limit' => 1,
			'invited_by_id' => 1,
			'invited_by_type' => 'Lorem ipsum dolor sit amet',
			'invitations_count' => 1,
			'avatar_file_name' => 'Lorem ipsum dolor sit amet',
			'avatar_content_type' => 'Lorem ipsum dolor sit amet',
			'avatar_file_size' => 1,
			'avatar_updated_at' => 1439880828,
			'license_number' => 'Lorem ipsum dolor sit amet',
			'easy_car_number' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'dealer_principle' => 'Lorem ipsum dolor sit amet',
			'tel' => 'Lorem ipsum dolor sit amet',
			'company_email' => 'Lorem ipsum dolor sit amet',
			'company_website' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet',
			'main_tel' => 'Lorem ipsum dolor sit amet',
			'main_fax' => 'Lorem ipsum dolor sit amet',
			'abn' => 'Lorem ipsum dolor sit amet',
			'acn' => 'Lorem ipsum dolor sit amet',
			'dun' => 'Lorem ipsum dolor sit amet'
		),
	);

}
