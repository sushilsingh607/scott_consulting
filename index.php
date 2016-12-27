<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Users Details With Teams</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
        <table class = "table table-striped table-response table-bordered table-hover" style="border-radius: 5px;width: 50%;margin: 10% auto;float: none;">
			<thead>
				<tr>
					<th class="col-md-2">Id</th>
					<th class="col-md-3">Name</th>
					<th class="col-md-4">Teams</th>
				</tr>
			</thead>
			<tbody>
				<!-- Load the database class -->
				<?php include_once('Database.php'); ?>
				<?php $db = new Database(); ?>
				<?php 
					$users_data = $db->select('SELECT u.id, CONCAT( u.first_name, " ", u.last_name ) AS name, GROUP_CONCAT( t.name SEPARATOR ", " ) AS teams
												FROM users u
												LEFT JOIN teams_users AS tu ON u.id = tu.user_id
												LEFT JOIN teams AS t ON tu.team_id = t.id
												GROUP BY u.id​');
					// check for empty data
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $users_data->fetch_assoc()) {
							echo  '<tr>' . 
									'<td class="col-md-2">'. $row['id'] . '</td>' . 
									'<td class="col-md-3">'. $row['name'] . '</td>' . 
									'<td class="col-md-4">'. $row['teams'] . '</td>' .
								  '</tr>';
						}
					} else {
						echo "0 results";
					}
				?>
			</tbody>
		</table>
	</body>
</html>
