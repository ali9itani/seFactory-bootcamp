<?php
require_once 'main.php';

class Film extends Main
{
	//film colmuns names for the sender 
	function Film()
	{
		$this->table_name = 'film';
		$this->table_id = 'film_id';
		$this->columns_name = ['title','description','releaseYear','languageId',
								'originalLanguageId','rentalDuration','replacementCost',
								'rentalRate','length','rating','specialFeatures']; 
	}

	//extract needed data from input (put data / post data)
	protected function extractDataFromInput()
	{
		$input_data;
		parse_str(file_get_contents("php://input"),$input_data);
		return $data_array = [	'title' => $input_data['title'],
								'description' => $input_data['description'],
								'release_year' => $input_data['releaseYear'],
								'language_id' => $input_data['languageId'],
								'original_language_id' => $input_data['originalLanguageId'],
								'rental_duration' => $input_data['rentalDuration'],
								'replacement_cost' => $input_data['replacementCost'],
								'rental_rate' => $input_data['rentalRate'],
								'length' => $input_data['length'], 'rating' => $input_data['rating'],
								'special_features' => $input_data['specialFeatures']			
							 ];
	}
}
?>
