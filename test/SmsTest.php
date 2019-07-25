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

  public function testSetRecipients(){
    $recipients = [];

    array_push($recipients,'0484222222');

    $s = new Quentinrasidy\Onesixty\Sms;

    $test = $s->setRecipients($recipients);

    $this->assertTrue(is_object($test));

    unset($var);
  }

  public function testGetSms(){

    $s = new Quentinrasidy\Onesixty\Sms;

    $this->assertTrue($s->authenticate('mytoken')->get(1));
    
  }

  public function testSend(){
    $recipients = [];

    array_push($recipients,'0485666666');

    try{
      $sms = new Quentinrasidy\Onesixty\Sms;
      $sms->setRecipients($recipients)
      ->setContent('this is a super sms content')
      ->authenticate('mytoken')
      ->send();

      $this->assertTrue(true);
    }catch(Quentinrasidy\Onesixty\SmsException $e){
      echo $e->getMessage();
      $this->assertFalse(true);
    }
  }

}