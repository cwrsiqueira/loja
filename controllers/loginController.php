<?php 

class loginController extends controller {

	public function logout() {
		unset($_SESSION['shipping']);
		unset($_SESSION['lang']);
		unset($_SESSION['cart']);
		header("Location: ".BASE_URL);
	}
}