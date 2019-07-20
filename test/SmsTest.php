<?php 
use PHPUnit\Framework\TestCase;
//require __DIR__ . "/../src/Quentinrasidy/Sms.php";
/**
*  Corresponding Class to test YourClass class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class SmsTest extends TestCase
{
    


  /*
  ======VALID TESTS======
  */
  public function testIsThereAnySyntaxError()
  {
	$var = new Quentinrasidy\Onesixty\Sms;
	$this->assertTrue(is_object($var));
	unset($var);
  }

  public function test_connection(){
    $var = new Quentinrasidy\Onesixty\Sms;

    $test = $var->authenticate('backend@gmail.com','bibibibi');
    $this->assertTrue(is_object($test));
    unset($var);
  }

  public function testSetRecipients(){
    $recipients = [];

    $recipient1 = array(
      "name" => 'Quentin',
      "phone" => '0495346512'
    );

    array_push($recipients,$recipient1);

    $s = new Quentinrasidy\Onesixty\Sms;

    $test = $s->setRecipients($recipients);

    $this->assertTrue(is_object($test));

    unset($var);
  }

  

  public function testGetStatus(){
    $s = new Quentinrasidy\Onesixty\Sms;
    try{
      $this->assertTrue(is_numeric($s->authenticate('xxxxx@gmail.com','xxxxxx')->getStatus(3)));
    }catch(Quentinrasidy\Onesixty\SmsException $e){
      $this->assertTrue(false,$e->getMessage());
    }
  }

  public function testSendSms(){
    $recipients = [];

    $recipient1 = array(
      "name" => 'Quentin',
      "phone" => '0495346512'
    );

    $recipient2 = array(
      "name" => 'Gerard',
      "phone" => '0497442828'
    );

    array_push($recipients,$recipient1);
    array_push($recipients,$recipient2);

    $s = new Quentinrasidy\Onesixty\Sms;
    try{
      $this->assertTrue(
        $s->authenticate('xxxxx@gmail.com','xxxxx')
        ->setRecipients($recipients)
        ->setContent('bidzuhdhuduhqdzuzdquhhuhuon')
        ->send()
      );
      
    }catch(Quentinrasidy\Onesixty\SmsException $e){
      $this->assertFalse(true,$e->getMessage());
    }
  }


  /*
  ======FAILING TESTS======
  */

  //Fail recipient
  public function testFailSetRecipient()
  {
    $recipients = [];

    $recipient1 = array(
      "name" => 'Quentin',
      "phone" => '04953465512'
    );

    $recipient2 = array(
      "name" => 'Gerard',
      "phone" => '0497442828'
    );

    array_push($recipients,$recipient1);
    array_push($recipients,$recipient2);

    $s = new Quentinrasidy\Onesixty\Sms;
    try{
        $s->authenticate('xxxx@gmail.com','xxxx')
        ->setRecipients($recipients);
      
    }catch(Quentinrasidy\Onesixty\SmsException $e){
      $this->assertFalse(true,$e->getMessage());
    }

  }


  //Trying to get status of an SMS that does not belong to us

}