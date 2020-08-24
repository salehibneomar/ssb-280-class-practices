<?php 
    include 'inc/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-12 mx-auto my-5">
                <div class="card my-3 border-secondary">
                    <div class="card-header">
                        <h4 class="card-title text-center p-2">Student List</h4>
                        <a href="add-student.php" class="btn btn-outline-primary float-right"><i class="fa fa-user-plus" aria-hidden="true"></i>&ensp;Register New</a>
                    </div>
                    <div class="card-body" style="overflow-x: auto !important;">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Joined Date</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    $sr=1; 
                                    $query = "SELECT * FROM first_crud_project ORDER BY name";
                                    $result = mysqli_query($conn, $query);

                                    while($row=mysqli_fetch_assoc($result)){ 
                                    
                                        $id         = $row['id'];
                                        $name       = $row['name'];
                                        $phone      = $row['phone'];
                                        $email      = $row['email'];
                                        $joineddate = $row['joinedDate'];
                                        $gender     = $row['gender'];
                                ?>
                                <tr>
                                    <td><?=$sr;?></td>
                                    <td><?=$name;?></td>
                                    <td><?=$phone;?></td>
                                    <td><?=$email;?></td>
                                    <td><?=$joineddate;?></td>
                                    <td><?php 
                                        if($gender==1){
                                            echo '<span class="badge badge-success p-2">Male</span>';
                                        }
                                        else if($gender==2){
                                            echo '<span class="badge badge-danger p-2">Female</span>';
                                        }
                                        else{
                                            echo '<span class="badge badge-secondary p-2">Undefined</span>';
                                        }
                                    ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info d-inline-block mr-2 mb-1" data-toggle="modal" data-target="<?="#updateModal_".$id?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger d-inline-block mb-1" data-toggle="modal" data-target="<?="#deleteModal_".$id?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                
                                <!-- Delete Modal -->
                                <div class="modal fade" id="<?="deleteModal_".$id?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        You won't be able to revert <b><?=$name."'s </b> data!";?>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?=$id;?>">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-success" name="deleteConfirmBtn">Yes</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>


                                <!-- Update Modal -->
                                <div class="modal fade" id="<?="updateModal_".$id?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update <b><?=$name."'s </b> data?";?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <form action="" method="post">
                                    <div class="modal-body p-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="tel" name="phone" id="phone" class="form-control" value="<?=$phone;?>"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" id="date" class="form-control" value="<?=$joineddate;?>"  required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="gender" id="male" value="1" <?php if($gender==1){ echo 'checked'; } ?>>
                                                <label class="custom-control-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="gender" id="female" value="2" <?php if($gender==2){ echo 'checked'; } ?>>
                                                <label class="custom-control-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?=$id;?>">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success" name="updateConfirmBtn">Update</button>
                                    </div>
                                </form>
                                    </div>
                                </div>
                                </div>

                                <?php $sr++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 

    //Delete Code Block starts

        if(isset($_POST['deleteConfirmBtn'])){

            $id = $_POST['id'];

            $query  = "DELETE FROM first_crud_project WHERE id = '$id' LIMIT 1";

            $delete = mysqli_query($conn, $query);

            if(!$delete){
                die("<br><b>Error: </b> <br>".mysqli_error($conn));
            }
            else{
                header("Location: index.php");
            }
        }

    //Delete Code Block ends

    ?>

    <?php 

    //Update Code Block starts

        if(isset($_POST['updateConfirmBtn'])){

            $id         = $_POST['id'];
            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $phone      = $_POST['phone'];
            $joineddate = $_POST['date'];
            $gender     = $_POST['gender'];

            $query  = "UPDATE first_crud_project SET name='$name', email='$email', phone='$phone', joinedDate='$joineddate', gender='$gender' WHERE id = '$id' LIMIT 1";
            
            $update = mysqli_query($conn, $query);

            if(!$update){
                die("<br><b>Error: </b> <br>".mysqli_error($conn));
            }
            else{
                header("Location: index.php");
            }
        }

    //Update Code Block ends

    ?>


<?php 
    include 'inc/footer.php';
?>