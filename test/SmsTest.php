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

    array_push($recipients,'0485346512');

    $s = new Quentinrasidy\Onesixty\Sms;

    $test = $s->setRecipients($recipients);

    $this->assertTrue(is_object($test));

    unset($var);
  }

  public function testSendSms(){
    $recipients = [];

    $recipient1 = array(
      "name" => 'Quentin',
      "phone" => '0495346512'
    );

    $recipient2 = array(
      "name" => 'Laetitia',
      "phone" => '0497442828'
    );

    array_push($recipients,$recipient1);
    array_push($recipients,$recipient2);

    $s = new Quentinrasidy\Onesixty\Sms;
    try{
      $this->assertTrue(
        $s->authenticate('backend@gmail.com','bibibibi')
        ->setRecipients($recipients)
        ->setContent('bidzuhdhuduhqdzuzdquhhuhuon')
        ->send()
      );
      
    }catch(Quentinrasidy\Onesixty\SmsException $e){
      $this->assertFalse(true,$e->getMessage());
    }
  }
}