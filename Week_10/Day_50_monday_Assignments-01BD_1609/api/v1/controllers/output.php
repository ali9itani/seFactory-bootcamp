<?php
/*this class is responsible for outputing result after a request is processed
 *those results are certain status code + resulted data or an error message
 */
class output
{
	//result can be data or an error message
	private $result;
	private $status_code;
	private $status_code_meaning = [101 => 'No records in database',
									501 => 'server error, cannot serve you',
									402 => 'Invalid data in post request',
									403 => 'Post request has no data',
									404 => 'Requested page not found',
									412 => 'Invalid data in get request',
									413 => 'Get request has no data',
									422 => 'Invalid data in put request',
									423 => 'Put request has no data'
									];

	function output($status_code, $message = '' ) {
		$this->status_code = $status_code;

		//to add the meaning of status code -for all but not 200 (success case)
		if($this->status_code == 200){
			$this->message =  $message;
		} else {
			$this->message = $this->status_code_meaning[$this->status_code].' '.$message;
		}
		//to json + change key
		$this->returnResult();
	}

	//encode message in json
	//and change all keys from snake_case to camel_case
	public function returnResult() {
		//change array_keys to camel case
		if($this->status_code == 200) {
			foreach ($this->message[0] as $key => $value) {

				// replace underscores with spaces, uppercase first letter of all words,
				// join them, lowercase the very first letter of the name
				$new_key = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));

				//change key in array
				$this->message[$new_key] = $value;
				unset($this->message[$key]);
			}
		}

		$result_array = ['statusCode' => $this->status_code , 'message' => $this->message];
		echo json_encode($result_array);
	}
}
?>