<?php
class UserController extends User
{


  public function login()
  {
    $session = new Session;


    if (isset($_POST['submit'])) {

      $email = $_POST['email'];
      $password = $_POST['password'];

      $myUser = $this->check_login($email, $password);

      if (!empty($myUser)) {
        $_SESSION['myuser'] = $myUser[0];
        $_SESSION['username'] = $myUser[0]['name'];
        $_SESSION['email'] = $myUser[0]['email'];
        $_SESSION['clientID'] = $myUser[0]['id'];
        $_SESSION['logged'] = true;
        $_SESSION['role'] = $myUser[0]['role'];
        // Check user role
        if ($myUser[0]['role'] == 'client') {
          $session->set('success', 'login Successfuly');

          header('location:home');
        } elseif ($myUser[0]['role'] == 'admin') {

          $session->set('success', 'login Successfuly');
          header('location:dashboard');
        }
      } else {

        $session->set('error', 'login failed');

        header('location:login');
      }
    } else {

      header('location:login');
    }
  }


  public function register()
  {
    $session = new Session;


    if (isset($_POST['register'])) {

      $data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['pass'],
        'dob' => $_POST['dob'],
      );
      $result = $this->userRegister($data);
      if ($result === 'ok') {
        $session->set('success', 'Registred Successfuly');
        header('location:login');
      } else {
        echo $result;
      }
    }
  }
  static public function logout()
  {
    unset($_SESSION["logged"]);
    unset($_SESSION["role"]);
    unset($_SESSION["username"]);
    header("Location:login");
  }
}
