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

    $this->assertTrue($s->authenticate('n0LPEy1y0GL3nmx7xt2g6xxOLSXqcntiHxCPzjSTgaNEaS9odja2aWYFOVuM')->get(1));
    
  }

  public function testSend(){
    $recipients = [];

    array_push($recipients,'0492234222');
    array_push($recipients,'0492845355');

    try{
      $sms = new Quentinrasidy\Onesixty\Sms;
      $results = $sms->setRecipients($recipients)
      ->setContent('this is a super sms content')
      ->authenticate('n0LPEy1y0GL3nmx7xt2g6xxOLSXqcntiHxCPzjSTgaNEaS9odja2aWYFOVuM')
      ->send();

      foreach($results as $result){
        var_dump($result);
      }

      $this->assertTrue(true);
    }catch(Quentinrasidy\Onesixty\SmsException $e){
      echo $e->getMessage();
      $this->assertFalse(true);
    }
  }

}