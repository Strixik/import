
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

<body>
    <div class="container">
        <div class="row">
	<div class="col-md-12 well">
		<h3 class = "text-primary text-center">PHP - імпорт файлу CSV у базу даних MySQL</h3>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
             Добавлено: <?php echo $_COOKIE['add']; ?> / Видалено: <?php echo $_COOKIE['delete']; ?> / Обновлено: <?php echo $_COOKIE['update']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php if($_COOKIE['error']): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo($_COOKIE['error']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
		<hr style = "border-top:1px dotted #ccc;"/>
		<div class="col-md-12" style='overflow:hidden;'>
			<form action="upload.php" class="" method="POST" enctype="multipart/form-data">
				<div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="inputFile">Завантажте файл CSV сюди:</label>
                        </div>
                        <div class="input-group-append">
                            <input name="upload" class="btn btn-outline-primary" type="submit" value="Завантажити"/>
                        </div>
                    </div>
				</div>
			</form>
		</div>
		<div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">uid</th>
                    <th scope="col">firstName</th>
                    <th scope="col">lastName</th>
                    <th scope="col">birthDay</th>
                    <th scope="col">dateChange</th>
                    <th scope="col">description</th>
                </tr>
                </thead>
                <tbody>
					<?php
                    require'conn.php';
                    $db_conn = Database::connect();
                    $query = $db_conn->prepare("SELECT * FROM documets");
                    $query->execute();
                    $documents = $query->fetchAll();
						foreach($documents as $item){
					?>

						<tr>
                            <td scope="row"><?php echo $item['uid']?></td>
                            <td><?php echo $item['firstName']?></td>
                            <td><?php echo $item['lastName']?></td>
                            <td><?php echo $item['birthDay']?></td>
                            <td><?php echo $item['dateChange']?></td>
                            <td><?php echo $item['description']?></td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
