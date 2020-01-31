<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User
{

	function generate($length, $char = NULL, $mode = NULL)
	{
		switch ($mode) {
			case 1: // User = Password
				switch ($char) {
					case 'alpha':
						$data = random_string('alpha', $length);
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;

					case 'alphalower':
						$data = strtolower(random_string('alpha', $length));
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;

					case 'alphaupper':
						$data = strtoupper(random_string('alpha', $length));
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;

					case 'alnum':
						$data = random_string('alnum', $length);
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;

					case 'alnumlower':
						$data = strtolower(random_string('alnum', $length));
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;

					case 'alnumupper':
						$data = strtoupper(random_string('alnum', $length));
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;

					default:
						$data = random_string('numeric', $length);
						return [
							'user' 		=> $data,
							'password' 	=> $data
						];
						break;
				}
				break;

			default: // User != Password
				switch ($char) {
					case 'alpha':
						$user = random_string('alpha', $length);
						$password = random_string('alpha', $length);
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;

					case 'alphalower':
						$user = strtolower(random_string('alpha', $length));
						$password = strtolower(random_string('alpha', $length));
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;

					case 'alphaupper':
						$user = strtoupper(random_string('alpha', $length));
						$password = strtoupper(random_string('alpha', $length));
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;

					case 'alnum':
						$user = random_string('alnum', $length);
						$password = random_string('alnum', $length);
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;

					case 'alnumlower':
						$user = strtolower(random_string('alnum', $length));
						$password = strtolower(random_string('alnum', $length));
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;

					case 'alnumupper':
						$user = strtoupper(random_string('alnum', $length));
						$password = strtoupper(random_string('alnum', $length));
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;

					default:
						$user = random_string('numeric', $length);
						$password = random_string('numeric', $length);
						return [
							'user' 		=> $user,
							'password' 	=> $password
						];
						break;
				}
				break;
		}
	}
}
