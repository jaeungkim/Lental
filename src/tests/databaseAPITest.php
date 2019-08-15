<?php
// This file tests the databse API
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use PHPUnit\Framework\TestCase;

// include '../database/databaseAPI.php';
include_once (dirname(__DIR__) . '/database/databaseAPI.php');

class DatabaseAPITest extends TestCase
{

    protected function setUp(): void
    {
        // should probably be replaced with actual sql statement to make sure data is set correctly (eg. listId)
        register('test@gmail.com', 'password', 'Mikey', 'Teen', '1234567890');
    }

    protected function tearDown(): void
    {
        // include_once (dirname(__DIR__) . '/script/processLogout.php');
    }

    function testDatabaseConnection(){
        $this->assertTrue(connect()!=false);
    }

    // test login
    public function testCanLogin()
    {
        $this->assertTrue(login('TEST@gmail.com', 'password'));
    }

    public function testWrongLogin()
    {
        $this->assertFalse(login('test@test.com', 'pass'));
    }

    public function testWrongLoginPassword()
    {
        $this->assertFalse(login('test@gmail.com', 'pass'));
    }

    // test check email used
    public function testEmailUsed(){
        $this->assertTrue(checkEmailUsed('test@gmail.com'));
    }

    public function testEmailNotUsed(){
        $this->assertFalse(checkEmailUsed('test'));
    }

    // test register
    public function testCanRegister()
    {
        $tEmail = "register@test.com";
        $tPass = 'pass';
        register($tEmail, $tPass, '', '', '');
        $this->assertTrue(login($tEmail, $tPass));
        removeAccount($tEmail);
    }

    // test remove account
    public function testCanCreeateAndRemoveAccount()
    {
        register('testEmail', 'pass', '', '', '');
        $this->assertTrue(removeAccount('testEmail'));
    }

    public function testNonexistentAccountDoesNotRemove()
    {
        $this->assertFalse(removeAccount('EmailDoesNotExist'));
    }

    public function testRegisterDoesNotCreateDuplicateAccount()
    {
        $this->assertFalse(register('test@gmail.com', 'password', '', '', ''));
    }

    // test get account
    public function testGetCorrectAccountDetails(){
        // test@gmail.com, Mikey, Teen, 1234567890, NULL
        $accDetails = getAccountDetails("test@gmail.com");
        $this->assertTrue($accDetails[0] == "test@gmail.com" && $accDetails[1] == "Mikey" && $accDetails[2] == "Teen" && $accDetails[3] == "1234567890" && $accDetails[4] == NULL && $accDetails[5] == "online");
    }

    public function testNoAccountToGetDetailsFrom(){
        $this->assertFalse(getAccountDetails("test"));
    }

    // test get all accounts
    public function testGetAllAccounts(){
        $this->assertTrue(($acc = getAllAccounts()) != false && getAccountDetails($acc[0]) != false);
    }

    // test create property
    public function testCanCreatePropertySuccessfully(){
        $this->assertTrue($propId = createProperty('test@gmail.com', 'title', 'address', 'country', 'province', 'city', 'v1v 1v1', 3,3,3, 'description', 'propertyType', 'online', '2008-04-04','Water,Heat/AC,Internet') != false);
    }

    public function testCreatePropertyNoValidEmail(){
        $this->assertFalse(createProperty('email', 'title', 'address', 'country', 'province', 'city', 'v1v 1v1', 3,3,3, 'description', 'propertyType', 'online', '2008-04-04','something with utilities'));
    }

    public function testCreatePropertyBadPostalCode(){
        $this->assertFalse(createProperty('test@gmail.com', 'title', 'address', 'country', 'province', 'city', 'v1vsdaf 1v1', 3,3,3, 'description', 'propertyType', 'online', '2008-04-04','something with utilities'));
    }

    public function testCreatePropertyLetterInsteadOfInt(){
        $this->assertFalse(createProperty('test@gmail.com', 'title', 'address', 'country', 'province', 'city', 'v1v 1v1', 'letter',3,3, 'description', 'propertyType', 'online', '2008-04-04','something with utilities'));
    }

    // test create listing
    public function testCanCreateListingSuccessfully(){
        // assumed that property with id = 1 exists, (bad test probably)
        $this->assertTrue($listId = createListing(1, 'test@gmail.com', 'Title', '2004-04-04', '2004-04-05', 1000.00, 'listType', 'online', '500', '6 months') != false);
    }

    public function testCreateListingWrongPropId(){
        // assumed that property with id = 1 exists, (bad test probably)
        $this->assertFalse(createListing(0, 'test@gmail.com', 'Title', '2004-04-04', '2004-04-05', 1000.00, 'listType', 'online', 500, '6 months'));
    }

    public function testCreateListingNoValidEmail(){
        // assumed that property with id = 1 exists, (bad test probably)
        $this->assertFalse(createListing(1, 'test', 'Title', '2004-04-04', '2004-04-05', 1000.00, 'listType', 'online', 500, '6 months'));
    }

    public function testCreateListingLetterInsteadOfInt(){
        // assumed that property with id = 1 exists, (bad test probably)
        $this->assertFalse(createListing(1, 'test', 'Title', '2004-04-04', '2004-04-05', 'test', 'listType', 'online', '500', '6 months'));
    }

    // test get listing
    public function testCanRetrieveListingDetailsNoError(){
        $this->assertTrue(getListing(1) != false);
    }

    public function testGetListingReturnsCorrectDetails(){
        $arr = getListing('1');
        $this->assertTrue($arr['email'] == 'test@gmail.com' && $arr['status'] == 'online');
    }

    public function testGetListingNonexistantId(){
        $this->assertFalse(getListing(0));
    }

    // test get property
    public function testGetPropertyDetailsNoError(){
        $this->assertTrue(getProperty(1) != false);
    }

    public function testGetPropertyNonexistantId(){
        $this->assertFalse(getProperty(0));
    }

    public function testGetPropertyReturnsCorrectDetails(){
        $arr = getProperty(1);
        $this->assertTrue($arr['email'] == 'test@gmail.com' && $arr['status'] == 'online');
    }

    // test add images
    public function testAddImagesSuccessfully(){
        addImage('test.jpg',1);
        addImage('test1.png',1);
        $this->assertTrue(addImage('test2.png',1));
    }

    public function testAddImagesNonexistantPropId(){
        $this->assertFalse(addImage('test.jpg',0));
    }

    // test check image exists
    public function testCheckImageExistsSuccessfully(){
        $this->assertTrue(checkImageExists("test.jpg", 1));
    }

    public function testCheckImageExistsError(){
        $this->assertfalse(checkImageExists("test", 1));
    }

    // test get images
    public function testGetPropertyImagesSuccessfully(){
        $this->assertTrue(getPropertyImages(1) != false);
    }

    public function testGetPropertyImagesNonexistantPropId(){
        $this->assertFalse(getPropertyImages(0));
    }

    // test remove images
    public function testDeleteImagesSuccessfullySingleImage(){
        $images = array("test.jpg");
        $this->assertTrue(removeImages($images,1));
    }

    public function testDeleteImagesSuccessfullyMultipleImages(){
        $images = array("test1.png", "test2.png");
        $this->assertTrue(removeImages($images,1));
    }

    public function testDeleteImagesNonexistantPropId(){
        $images = array("test.jpg", "test1.png");
        $this->assertFalse(removeImages($images,0));
    }

    public function testDeleteImagesNonNumberPropId(){
        $images = array("test.jpg", "test1.png");
        $this->assertFalse(removeImages($images,"a"));
    }

    public function testDeleteImagesNoImageNames(){
        $images = array();
        $this->assertFalse(removeImages($images,1));
    }

    // test update account
    function testUpdateUserAccountSuccessfully(){
        $email = "test@gmail.com";
        $test = updateAccount($email, "Mike", "Teen", 123456789, 0);
        $details = getAccountDetails($email);
        $this->assertTrue($test && $details['1'] == "Mike");
        updateAccount($email, "Mikey", "Teen", 1234567890, 0);
    }

    function testUpdateUserAccountNoAccount(){
        $this->assertFalse(updateAccount("test", "","",0,0));
    }

    // test change listing status
    public function testChangeListingStatusSuccessfully(){
        changeListingStatus(1, "offline");
        $list = getListing(1);
        $this->assertEquals($list["status"], "offline");
        changeListingStatus(1, "online");
    }

    public function testChangeListingStatusNonexistantListing(){
        $this->assertFalse(changeListingStatus(0,"offline"));
    }

    public function testChangeListingStatusWrongStatus(){
        $this->assertFalse(changeListingStatus(1,"off"));
    }

    // test change property status
    public function testChangePropertyStatusSuccessfully(){
        changePropertyStatus(1, "offline");
        $prop = getProperty(1);
        $this->assertEquals($prop["status"], "offline");
        changePropertyStatus(1, "online");
    }

    public function testChangePropertyStatusNonexistantListing(){
        $this->assertFalse(changePropertyStatus(0,"offline"));
    }

    public function testChangePropertyStatusWrongStatus(){
        $this->assertFalse(changePropertyStatus(1,"off"));
    }

    // test get all listings of account
    public function testGettAllListingsOfAccountSuccessfully(){
        $this->assertTrue(getAllListingsOfAccount("test@gmail.com") != false);
    }

    public function testGettAllListingsOfAccountNonexistantAccount(){
        $this->assertFalse(getAllListingsOfAccount("test1"));
    }

    // test get email from propid
    public function testGetEmailFromPropIdSuccessfully(){
        $this->assertEquals(getEmailFromPropId(1),'test@gmail.com');
    }

    public function testGetEmailFromPropIdNonexistantEmail(){
        $this->assertFalse(getEmailFromPropId(0));
    }

    // test delete listing
    public function testDeleteListingSuccessfully(){
        $listId = createListing(1, 'test@gmail.com', 'Title', '2004-04-04', '2004-04-05', 1000.00, 'listType', 'online', '500', '6 months');
        removeListing($listId);
        $this->assertFalse(getListing($listId));
    }

    // test delete property
    // public function testDeletePropertySuccesfully(){
    //     $propId = createProperty('test@gmail.com', 'title', 'address', 'country', 'province', 'city', 'v1v 1v1', 3,3,3, 'description', 'propertyType', 'online', '2008-04-04','Water,Heat/AC,Internet');
    //     removeProperty($propId);
    //     $this->assertFalse(getProperty($propId));
    // }


    // test get cities
    public function testGetCities(){
        $cities = getAvailableCities();
        $this->assertEquals($cities[0],"city");
    }

    // test search listings
    public function testSearchListingsSuccessfully(){
        $listings = searchListings(2008, 1, 2, 1,2,2 ,100,2000);
        // fwrite(STDERR, print_r($listings, TRUE));
        $correct = true;
        foreach ($listings as $id){
            $list = getListing($id);
            $prop = getProperty($list['idProp']);
            if ($prop['beds'] > 2 || $prop['baths'] > 2 || $prop['parkSpots'] < 2 || $prop['buildDate'] < 2008){
                $correct = false;
            }
            // fwrite(STDERR, $id .' - '. $prop['city'] . '   ');
        }
        $this->assertTrue($correct);
    }

    // test change account status
    public function testChangeAccountStatusSuccessfully(){
        changeAccountStatus("test@gmail.com","offline");
        $this->assertEquals(getAccountDetails("test@gmail.com")[5],"offline");
        changeAccountStatus("test@gmail.com","online");
    }

    public function testChangeAccountStatusNonexistantAccount(){
        $this->assertFalse(changeAccountStatus('test','offline'));
    }

    public function testChangeAccountStatusWrongStatus(){
        $this->assertFalse(changeAccountStatus('test@gmail.com','off'));
    }

    // test set account token
    public function testSetAccountTokenSuccessfully(){
        setAccountToken('test@gmail.com','someRandomTestToken');
        $this->assertEquals(getTokenAccount('someRandomTestToken'),'test@gmail.com');
    }

    public function testSetAccountTokenNonexistantAccount(){
        $this->assertFalse(setAccountToken('test','test'));
    }

    // test get account token
    public function testGetAccountTokenSuccessfully(){
        $this->assertEquals(getTokenAccount('someRandomTestToken'),'test@gmail.com');
        setAccountToken('test@gmail.com','');
    }

    public function testGetAccountTokenNonexistantToken(){
        $this->assertFalse(getTokenAccount('someRandomTestToken'));
    }

    // test change account password
}
