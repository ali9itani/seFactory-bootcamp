<?php
/*this class is responsible for outputing result after a request is processed
 *those results are certain status code + resulted data or an error message
 */
class output
{
	//result can be data or an error message
	private $result;
	private $status_code;

	function output($message, $status_code) {
		$this->message = $message;
		$this->status_code = $status_code;

		$this->returnResult();
	}

	public function returnResult() {
		$result_array = ['statusCode' => $this->status_code , 'message' => $this->message];

		print_r(json_encode($result_array));
	}
}
?>