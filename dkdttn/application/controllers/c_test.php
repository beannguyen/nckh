<?php
class C_test extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    function get_salt($seed = '', $plaintext = '')
    {
        $salt = '';
				if ($seed)
				{
					$salt = $seed;
				}
				return $salt;
    }
    function _create_salt($plaintext)
    {
        $salt = $this->get_salt($salt, $plaintext);
        $encrypted = ($salt) ? md5($plaintext . $salt) : md5($plaintext);
        return ($show_encrypt) ? '{MD5}' . $encrypted : $encrypted;
    }
    public function get_pass()
    {
          echo "fa3da2c0a60fdd8f66fd2b3f42b564f3:hJu8bC8clJybz1YG5t1TuhqpVudxezFZ"."<br>";
          $password = "123456";
          $salt = $this->_create_salt($password);
          echo $salt."<br>";
          $pass_1 = md5($password.$salt);
          echo $pass_1;
    }
}
?>