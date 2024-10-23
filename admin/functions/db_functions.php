<?php

##### MySQL QUERY FUNCTIONS #####


// MySQL SELECT Wrapper

function db_select($query)
	{
		#echo 'QUERY: '.$query.'<br />';
		
		$process_query = mysql_query($query);
		$num_rows      = mysql_num_rows($process_query);
		$result_array = array();
		
		
		#echo $num_rows;

		if($num_rows > 1)
			{
				$result_array = array();
				for($i=0;$i<$num_rows;$i++)
					{
						$result_array[$i] = mysql_fetch_array($process_query);
					}
			}
		elseif($num_rows == 1)
			{
				$result_array[0] = mysql_fetch_array($process_query);
			}
			
		$result = array(
											'result_array' => $result_array ,
											'result' => $result_array ,
											'num_rows'     => $num_rows											
										);
				
		return $result ;

	}


// MySQL UPDATE Wrapper

function db_update($query)
	{		
		$process_query = mysql_query($query);
		$affected_rows = mysql_affected_rows();

		if($affected_rows == 0)
			{ return false ; }
		elseif($affected_rows > 0)
			{ return true ; }
	}


// MySQL INSERT Wrapper

function db_insert($query)
	{
		#echo $query.'<br />';
		
		$process_query = mysql_query($query);
		$affected_rows = mysql_affected_rows();
				
		$return_array = array();
		
		if($affected_rows == 0)
			{ $return_array['result'] = false ; }
		elseif($affected_rows > 0)
			{ $return_array['result'] = true ; }
			
		$return_array['insert_ID'] = mysql_insert_id();
		
		return $return_array;
	}
	
	
// MySQL DELETE Wrapper

function db_delete($query)
	{
		$process_query = mysql_query($query);
		$affected_rows = mysql_affected_rows();
				
		if($affected_rows == 0)
			{ return false ; }
		elseif($affected_rows > 0)
			{ return true ; }
	}

	
?>