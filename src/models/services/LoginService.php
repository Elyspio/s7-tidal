<?php


namespace models\services;

use models\db\entities\UserEntity;
use models\db\repositories\RepositoryExceptionCode;


class LoginService extends Service
{
	public function create_account(string $firstname, string $lastname, string $address, string $username, string $password, string $mail) {

		$repo = $this->userRepository;

		try {
			$repo->add_user(new UserEntity(null, $firstname, $lastname, $address, $username, $password, $mail));
			echo json_encode($repo->get_user($username));
			exit();
		} catch (\PDOException $ex) {
			$code = $ex->getCode();
			$ret = [];
			if ($code === "23000") {
				$ret = [
					"error" => [
						"username" => $username,
						"message" => "The username '" . $username . "' is already taken",
						"code" =>  RepositoryExceptionCode::$violating_unicity_restriction,
						"field" => "username"
					]
				];
			}
			echo json_encode($ret);
			exit();

		}
	}
}