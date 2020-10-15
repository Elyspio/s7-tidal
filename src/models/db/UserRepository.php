<?php


namespace models\db {

	use models\entities\UserEntity;

	require(__DIR__ . "/Repository.php");
	require(__DIR__ . "/../entities/UserEntity.php");



	class UserRepository extends Repository
	{

		/**
		 * @param string $username
		 * @param string $hash
		 * @return UserEntity | null
		 */
		public function get_user(string $username, string $hash): ?UserEntity
		{
			$query = "select password from customers where username = :username";
			$smt = parent::$bdd->prepare($query);
			$smt->execute([":username" => $username]);
			$results = $smt->fetchAll();

			if(count($results) === 0) {
				return null;
			}

			$user = new UserEntity(
				null,
				$results[0]["firstname"],
				$results[0]["familyname"],
				$results[0]["address"],
				$results[0]["username"],
				$results[0]["password"],
			);

			print_r($user);

			return $user;
		}


		/**
		 * @param UserEntity $user
		 * @return bool if the user was succesfully inserted
		 */
		public function add_user(UserEntity $user): bool
		{
			$query = "insert into Customers (firstname, familyname, address, username, password) values (:firstname, :familyname, :address, :username, :password)";
			return parent::$bdd->prepare($query)->execute([
				":firstname" => $user->get_first_name(),
				":familyname" => $user->get_family_name(),
				":address" => $user->get_address(),
				":username" => $user->get_username(),
				":password" => $user->get_password(),
			]);
		}
	}


}