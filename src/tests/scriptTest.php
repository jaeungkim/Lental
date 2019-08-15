<?php
// This file tests the php used by ajax
use PHPUnit\Framework\TestCase;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


class AJAXScriptTest extends TestCase
{
    protected function setUp(): void
    {
        include_once (dirname(__DIR__) . '/database/databaseAPI.php');
        register('test@gmail.com', 'password', 'Mikey', 'Teen', '1234567890');
    }

    function testSuccessfulProcessLogin(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = 'test@gmail.com';
        $_POST['password'] = 'password';

        ob_start();
        include(dirname(__DIR__) . '/script/processLogin.php');
        $actual = ob_get_clean();
        $expected = 1;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
    }

    function testFailedProcessLogin(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = 'test';
        $_POST['password'] = 'password';

        ob_start();
        include(dirname(__DIR__) . '/script/processLogin.php');
        $actual = ob_get_clean();
        $expected = 0;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
    }

    function testSuccessfulRegister(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email = 'test@test.com';
        $_POST['password'] = 'password';
        $_POST['phoneNum'] = '12324324';
        $_POST['firstName'] = 'Mikey';
        $_POST['lastName'] = 'Teen';

        ob_start();
        include(dirname(__DIR__) . '/script/processRegister.php');
        $actual = ob_get_clean();
        $expected = 1;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
        removeAccount($email);
    }

    function testFailRegister(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email = 'test@gmail.com';
        $_POST['password'] = 'password';
        $_POST['phoneNum'] = '12324324';
        $_POST['firstName'] = 'Mikey';
        $_POST['lastName'] = 'Teen';

        ob_start();
        include(dirname(__DIR__) . '/script/processRegister.php');
        $actual = ob_get_clean();
        $expected = 0;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
    }

    function testPasswordTooShortRegister(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email = 'test@test.com';
        $_POST['password'] = 'pass';
        $_POST['phoneNum'] = '12324324';
        $_POST['firstName'] = 'Mikey';
        $_POST['lastName'] = 'Teen';

        ob_start();
        include(dirname(__DIR__) . '/script/processRegister.php');
        $actual = ob_get_clean();
        $expected = 0;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
    }

    function testBadEmailRegister(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email = 'test.com';
        $_POST['password'] = 'password';
        $_POST['phoneNum'] = '12324324';
        $_POST['firstName'] = 'Mikey';
        $_POST['lastName'] = 'Teen';

        ob_start();
        include(dirname(__DIR__) . '/script/processRegister.php');
        $actual = ob_get_clean();
        $expected = 0;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
    }

    function testPhoneNumTooLongRegister(){
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email = 'test@test.com';
        $_POST['password'] = 'password';
        $_POST['phoneNum'] = '12345678910111213';
        $_POST['firstName'] = 'Mikey';
        $_POST['lastName'] = 'Teen';

        ob_start();
        include(dirname(__DIR__) . '/script/processRegister.php');
        $actual = ob_get_clean();
        $expected = 0;

        $this->assertEquals($expected, $actual);
        unset($_SESSION['userEmail']);
    }

    /**
    * @runInSeparateProcess
    */
    function testSuccessfulLogout(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['userEmail'] = 'test';
        ob_start();
        include(dirname(__DIR__) . '/script/processLogout.php');
        $actual = ob_get_clean();

        $this->assertFalse(isset($_SESSION['userEmail']));

        if (isset($_SESSION['userEmail'])){
            unset($_SESSION['userEmail']);
        }
    }

    /**
    * @runInSeparateProcess
    */
    // attempt to access site not logged in where you need to be logged in
    function testAccessDeniedNotLoggedIn(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['userEmail'])){
            $_SESSION['userEmail'] = '';
        }
        unset($_SESSION['errorMsg']);
        ob_start();
        include(dirname(__DIR__) . '/script/loggedInCheck.php');
        $actual = ob_get_clean();

        $this->assertTrue(isset($_SESSION['errorMsg']));
        unset($_SESSION['errorMsg']);
    }

    function testAccessDeniedLoggedIn(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userEmail'])){
            $_SESSION['userEmail'] = 'test';
        }
        unset($_SESSION['errorMsg']);
        ob_start();
        include(dirname(__DIR__) . '/script/loggedInCheck.php');
        $actual = ob_get_clean();

        $this->assertFalse(isset($_SESSION['errorMsg']));
        unset($_SESSION['errorMsg']);
    }

    // test iamge upload
    // function testImagesCanBeUploadedCorrectly(){
    // }
}

?>
