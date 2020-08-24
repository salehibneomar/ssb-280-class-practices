<?php 
    include 'inc/header.php';
?>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12 mx-auto my-5">
                <div class="card my-3 border-secondary">
                    <div class="card-header">
                        <h4 class="card-title text-center d-block">Register New Student</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="gender" id="male" value="1">
                                    <label class="custom-control-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="gender" id="female" value="2">
                                    <label class="custom-control-label" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-success float-right" name="addNew">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['addNew'])){
            $name   = $_POST['name'];
            $email  = $_POST['email'];
            $phone  = $_POST['phone'];
            $joinedDate  = $_POST['date'];
            $gender = "";
            if(!empty($_POST['gender'])){
                $gender=$_POST['gender'];
            }

            $query = "INSERT INTO first_crud_project(name, email, phone, joinedDate, gender)
                                  VALUES('$name', '$email', '$phone', '$joinedDate', '$gender')";

            $addNew = mysqli_query($conn, $query);

            if($addNew){
                header("Location: index.php");
            }
            else{
                die("<br><b>Connection Error: </b> <br>".mysql_error($db));
            }
        }
    ?>

<?php 
    include 'inc/footer.php';
?>