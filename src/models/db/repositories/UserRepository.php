<?php


namespace models\db\repositories {

	use models\db\entities\UserEntity;

	require_once(__DIR__ . "/Repository.php");
	require_once(__DIR__ . "/../entities/UserEntity.php");



	class UserRepository extends Repository
	{

		private function dbToEntity($data): UserEntity {
			return new UserEntity(
				$data["id"],
				$data["firstname"],
				$data["familyname"],
				$data["address"],
				$data["username"],
				$data["password"],
				$data["mail"]
			);
		}


		/**
		 * @param string $username
		 * @param string $hash
		 * @return UserEntity | null
		 */
		public function get_user(string $username): ?UserEntity
		{
			$query = "select * from customers where username = :username";
			$smt = parent::$bdd->prepare($query);
			$smt->execute([":username" => $username]);
			$results = $smt->fetchAll();
			error_log("result: " . json_encode($results));
			if(count($results) === 0) {
				return null;
			}


			return $this->dbToEntity($results[0]);
		}


		/**
		 * @param UserEntity $user
		 * @return bool if the user was succesfully inserted
		 */
		public function add_user(UserEntity $user): bool
		{
			$query = "insert into customers (firstname, familyname, address, username, password, mail) values (:firstname, :familyname, :address, :username, :password, :mail)";
			return parent::$bdd->prepare($query)->execute([
				":firstname" => $user->get_first_name(),
				":familyname" => $user->get_family_name(),
				":address" => $user->get_address(),
				":username" => $user->get_username(),
				":password" => $user->get_password(),
				":mail" => $user->get_mail()
			]);

		}
	}


}