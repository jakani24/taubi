<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	 <title>Jakach-Taubi install</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>We are creating the databases used in jakach-taubi, please stand by</h4>
                </div>
                <div class="card-body">
					<p>If the creation fails, please wait a minute and try again. The database server might still be starting at the time.</p>
					<br>
                </div>
			<?php
			$success=1;
			include "config_setup.php";

			// Create connection
			$conn = new mysqli($DB_SERVERNAME, $DB_USERNAME, $DB_PASSWORD);

			// Check connection
			if ($conn->connect_error) {
				$success=0;
				die("Connection failed: " . $conn->connect_error);
			}

			// Create database
			$sql = "CREATE DATABASE IF NOT EXISTS $DB_DATABASE";
			if ($conn->query($sql) === TRUE) {
				echo '<br><div class="alert alert-success" role="alert">
					Database created successfully!
					</div>';
			} else {
				$success=0;
				echo '<br><div class="alert alert-danger" role="alert">
						Error creating database: ' . $conn->error .'
				</div>';
			}

			$conn->close();

			// Connect to the new database
			$conn = new mysqli($DB_SERVERNAME, $DB_USERNAME, $DB_PASSWORD,$DB_DATABASE);

			// Check connection
			if ($conn->connect_error) {
				$success=0;
				die("Connection failed: " . $conn->connect_error);
			}

			// Create user table
			$sql="CREATE TABLE IF NOT EXISTS users (
			    id INT AUTO_INCREMENT PRIMARY KEY,
			    username VARCHAR(255) NOT NULL UNIQUE,
			    role VARCHAR(255),
			    email VARCHAR(255) NOT NULL UNIQUE,
				password VARCHAR(255),
			    last_login VARCHAR(255),
				banned INT
			);";


			if ($conn->query($sql) === TRUE) {
				echo '<br><div class="alert alert-success" role="alert">
						Table users created successfully!
				</div>';
			} else {
				$success=0;
				echo '<br><div class="alert alert-danger" role="alert">
						Error creating table users: ' . $conn->error .'
				</div>';
			}

			// Create books table
                        $sql="CREATE TABLE IF NOT EXISTS books (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            reserved_by INT,
			    publisher VARCHAR(255),
			    book_condition VARCHAR(255),
			    language VARCHAR(255),
			    image_url VARCHAR(255),
				image BLOB, 
			    title VARCHAR(255),
			    pages INT,
			    date_published VARCHAR(255),
			    author VARCHAR(255),
			    isbn VARCHAR(255),
			    sold_by INT,
			    price VARCHAR(255)
                        );";


                        if ($conn->query($sql) === TRUE) {
                                echo '<br><div class="alert alert-success" role="alert">
                                                Table books created successfully!
                                </div>';
                        } else {
                                $success=0;
                                echo '<br><div class="alert alert-danger" role="alert">
                                                Error creating table books: ' . $conn->error .'
                                </div>';
                        }

			// Create tags table
                        $sql="CREATE TABLE IF NOT EXISTS tags (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL UNIQUE
                        );";


                        if ($conn->query($sql) === TRUE) {
                                echo '<br><div class="alert alert-success" role="alert">
                                                Table tags created successfully!
                                </div>';
                        } else {
                                $success=0;
                                echo '<br><div class="alert alert-danger" role="alert">
                                                Error creating table tags: ' . $conn->error .'
                                </div>';
                        }

			// Create book_tags table
							$sql="CREATE TABLE IF NOT EXISTS book_tags (
								id INT AUTO_INCREMENT PRIMARY KEY,
					book_id INT,
					tag_id INT
							);";


                        if ($conn->query($sql) === TRUE) {
                                echo '<br><div class="alert alert-success" role="alert">
                                                Table book tags created successfully!
                                </div>';
                        } else {
                                $success=0;
                                echo '<br><div class="alert alert-danger" role="alert">
                                                Error creating table book tags: ' . $conn->error .'
                                </div>';
                        }


			if($success!==1){
				echo '<br><div class="alert alert-danger" role="alert">
						There was an error creating the databases. Please try again or contact support at: <a href="mailto:info.jakach@gmail.com">info.jakach@gmail.com</a>
				</div>';
			}else{
				echo '<br><div class="alert alert-success" role="alert">
						Database created successfully!
				</div>';
			}

			


			$conn->close();
			?>
			</div>
		</div>
    </div>
</div>
</body>
</html>
