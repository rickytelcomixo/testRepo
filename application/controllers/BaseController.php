<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->database();
		$this->load->model('users');
		$this->load->model('menu_model');
	}
	
	//set page only can be accessed by entitlement
	public function isRestricted(){
		print_r($this->session);
		exit();
		if($this->session->userdata('loggedIn') == null){
			redirect('access/login');
		} else {
			$user = $this->session->userdata('loggedIn');
			$menuAccess = $this->session->userdata('menuAccess');
			$entitled = false;
			if(count($menuAccess)>0){
				foreach($menuAccess as $arr){
					if($arr['METHOD'] == $this->uri->segment(1)){
						$entitled = true;
					}
				}
			}
			if(!$entitled){
				//flash('error','You not entitled to access this page.','Restricted');
				redirect($menuAccess[0]['METHOD']);
			}
		}
	}

	//Get start and end date for given number of week and date
	public function getStartAndEndDate($week, $date) {
	  	$year = date('Y',strtotime($date));
		$dto = new DateTime();
		$dto->setISODate($year, $week);
		$ret['week_start'] = $dto->format('Y-m-d');
		$dto->modify('+6 days');
		$ret['week_end'] = $dto->format('Y-m-d');
		return $ret;
	}

	//get task status
	public function getTaskStatus(){
		return array(
			1 => "In progress",
			2 => "Pending",
			3 => "Completed"
		);
	}


	//Evaluate calculation
	public function calc_eval($equation)
	{
	    // Remove whitespaces
	    $equation = preg_replace('/\s+/', '', $equation);
	    //echo "$equation\n";

	    $number = '(?:\d+(?:[,.]\d+)?|pi|π)'; // What is a number
	    $functions = '(?:abs|atan|ceil|cos|exp|gmp_fact|intval|log(10)?|rand|round|sin|sqrt|tan)'; // Allowed PHP functions
	    $operators = '[\/*\^\+-]'; // Allowed math operators
	    $regexp = '/^([+-]?('.$number.'|'.$functions.'\s*\((?1)+\)|\((?1)+\))(?:'.$operators.'(?1))?)+$/'; // Final regexp, heavily using recursive patterns

	    if (preg_match($regexp, $equation))
	    {
	        $equation = preg_replace('!pi|π!', 'pi()', $equation); // Replace pi with pi function
	        //echo "$equation\n";
	        eval('$result = '.$equation.';');
	    }
	    else
	    {
	        $result = false;
	    }
	    return $result;
	}

	function upload($inputFile=""){
	    $target_dir = "assets/upload/";
	    $target_file = $target_dir . basename($_FILES[$inputFile]["name"]);
	    
	    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$fileName =  basename($_FILES[$inputFile]["name"],'.'.$fileType);
		if($fileName != ''){
			$fileName = $fileName."_".date('YmdHis').'.'.$fileType;
		    $target_file = $target_dir . $fileName;

		    move_uploaded_file($_FILES[$inputFile]["tmp_name"], $target_file);
		    return $fileName;
		} else {
			return false;
		}
	    
	}

	//get number of months between 2 dates
	public function getNoOfMonths($date1, $date2)
	{
	    $begin = new DateTime( $date1 );
	    $end = new DateTime( $date2 );
	    $end = $end->modify( '+1 month' );

	    $interval = DateInterval::createFromDateString('1 month');

	    $period = new DatePeriod($begin, $interval, $end);
	    $counter = 0;
	    foreach($period as $dt) {
	        $counter++;
	    }

	    return $counter;
	}

	//get number of days between 2 dates
	public function getNoOfDays($date1, $date2)
	{
	    $begin = new DateTime( $date1 );
	    $end = new DateTime( $date2 );
	    $end = $end->modify( '+1 day' );

	    $interval = DateInterval::createFromDateString('1 day');

	    $period = new DatePeriod($begin, $interval, $end);
	    $counter = 0;
	    foreach($period as $dt) {
	        $counter++;
	    }

	    return $counter;
	}

	public function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add($this->add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }

    function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }
}
