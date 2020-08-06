<!-- ============= Details=============
    Coded by: Saleh Ibne Omar
    SBB-280
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List | Saleh Ibne Omar | SSB-280</title>

<!-- Link Tags -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Recursive:wght@300;400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <!-- Loader Div starts -->
    <div id="loader">
        <div class="ui active inverted dimmer">
        <div class="ui text loader">Loading</div>
        </div>
    </div>
    <!-- Loader Div ends -->

    <!-- Main section starts -->
    <section id="main-section">
        <div class="wrapper">
            <div class="ui card main-card">
                <div class="content">
                    <div class="header main-heading">
                        <h3>Basic ToDo List App</h3>
                    </div>
                </div>
                <div class="content table-content" id="data-table">
                    <!-- Data Table section -->
                </div>
                <div class="extra content">
                    <button class="ui blue button" id="add-to-list-btn">
                        <i class="fas fa-plus"></i>&ensp;Add To List
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Main section ends -->

    <!-- Form modal starts -->
    <form class="ui small modal form-modal" method="POST">
        <div class="header" id="form-title"></div>
        <div class="ui form content">
            <div class="field">
                <label for="title">Work Name</label>
                <input type="text" name="workName" id="workName" placeholder="Work Name" value="">
            </div>
            <div class="field">
                <label for="fromDate">From</label>
                <input type="date" name="fromDate" id="fromDate" value="">
            </div>
            <div class="field">
                <label for="toDate">To</label>
                <input type="date" name="toDate" id="toDate" value="">
            </div>
            <span id="input-err"></span>
        </div>
        <div class="actions">
            <input type="hidden" id="work-id" value="" name="id">
            <input type="hidden" id="submit-type">
            <div class="ui cancel button" id="cancel-submit">Cancel</div>
            <button type="submit" class="ui blue button" id="form-submit-btn"></button>
        </div>
    </form>
    <!-- Form modal ends -->

<div class="ui mini modal" id="message-modal">
</div>

<div class="ui mini modal" id="confirmation-modal">
    <div class="header">Confirmation&ensp;<i class="exclamation teal icon"></i></div>
    <div class="content">
        <p id="confirm-msg-details">Are you sure? you won't be able to revert this!</p>
    </div>
    <div class="actions">
        <div class="ui cancel red button">No</div>
        <button type="button" class="ui green button" id="confirm-btn">Yes</button>
    </div>
</div>

<!-- Script Tags -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
    <script>

    $(window).on('load', function () {
        setTimeout(() => {
            $('#loader').fadeOut('slow', function () {
                $('#loader').remove();
            });
    
            $('#main-section').fadeIn('slow', function () {
                $('#main-section').show();
            }); 
        }, 400);
    });

    $(document).ready(function(){

//======================= CRUD Ajax functions =======================

        function readAll(){
            $.ajax({
                url:     "operations/readAll.php",
                method:  "POST",
                success: function(data){
                    setTimeout(() => {
                        $('#data-table').html(data);
                    }, 600);
                },
                error:  function(){
                    $('#data-table').html('<p class="center aligned">Network/Server error: Data fetching failed!</p>');
                }
            });
        }

        function createOrUpdate(url, data){
            $.ajax({
                url:     url,
                method:  "POST",
                data:    data,
                success: function(returnedData){
                    setTimeout(() => {
                        $('#message-modal').modal('show');
                        $('#message-modal').html(returnedData);
                        //========= Ajax Function call =========
                        readAll();
                    }, 500);
                },
                error:  function(){
                    $('#input-err').text("Network/Server error: Couldn't perform operation!");;
                }
            });
        }

        function readById(id){
            $.ajax({
                url: "operations/readById.php",
                method: "POST",
                data: 'id='+id,
                success: function(data){
                    var data = JSON.parse(data);
                    if(data==null){
                        //========= Ajax Function call =========
                        readAll();
                    }
                    else{
                        $('#work-id').val(id);
                        $('#workName').val(data.workName);
                        $('#fromDate').val(data.fromDate);
                        $('#toDate').val(data.toDate);
                    }
                },
                error:  function(){
                    $('#input-err').text("Network/Server error: Couldn't fetch data!");
                    $('#form-submit-btn').addClass("disabled");
                }
            });
        }

        function deleteWork(id){
            $.ajax({
                url:     "operations/delete.php",
                method:  "POST",
                data:    'id='+id,
                success: function(data){
                    setTimeout(() => {
                        $('#message-modal').modal('show');
                        $('#message-modal').html(data);
                        //========= Ajax Function call =========
                        readAll();
                    }, 500);
                },
                error:  function(){
                    $('#confirm-btn').addClass("loading");
                    $('#confirm-msg-details').css("color", "red");
                    $('#confirm-msg-details').text("Network/Server error: Couldn't perform operation!");
                }
            });
        }

//======================= On Click Functions =======================

        $('#add-to-list-btn').on('click', function(){
            $('.form-modal').modal('show');
            $('#form-title').text("Add To List");
            $('#form-submit-btn').text("Submit");
            $('#form-submit-btn').attr("name", "add-to-list");
            $('#submit-type').attr("name", "create");
        });

        $(document).on('click', '.work-edit-btn', function(){
            $('.form-modal').modal('show');
            $('#form-title').text("Update Work");
            $('#form-submit-btn').text("Update");
            $('#form-submit-btn').attr("name", "update-work");
            $('#submit-type').attr("name", "update");
            //========= Ajax Function call =========
            readById($(this).val());
        });

        $(document).on('click', '.work-delete-btn', function(){
            var id = $(this).val();
            $('#confirmation-modal').modal('show');
            $('#confirm-btn').on("click", function(){
                $('#confirm-btn').addClass("loading disabled");
                //========= Ajax Function call =========
                deleteWork(id);
            });
        });


        $('.form-modal').modal({
            onHide: function(){
                $('#input-err').text("");
                $('form').find('input').val("");
                $('#form-submit-btn').removeClass("loading");
                setTimeout(() => {
                    $('#form-submit-btn').removeClass("disabled");
                }, 500);
            }
        });

        $('#confirmation-modal').modal({
            onHide: function(){
                $('#confirm-btn').removeClass("loading");
                setTimeout(() => {
                    $('#confirm-btn').removeClass("disabled");
                    $('#confirm-msg-details').css("color", "black");
                    $('#confirm-msg-details').text("Are you sure? you won't be able to revert this!");
                }, 500);
            }
        });

//======================= Form Submission Functions =======================

        $('#form-submit-btn').on('click', function(e){
            e.preventDefault();
            var workName    = $('#workName').val().trim();
            var fromDate = new Date($('#fromDate').val());
            var toDate   = new Date ($('#toDate').val());
            
            if(fromDate=="Invalid Date" || toDate=="Invalid Date" || workName==""){
                $('#input-err').text("Empty/Invalid Input field found!");
            }
            else{
                if(workName.length>200){
                    $('#input-err').text("Work name cannot have more than 200 characters!");
                }
                else{
                    var submitType = $('#form-submit-btn').attr("name");
                    var url = "";
                    if(submitType=="update-work"){
                        url = "operations/update.php";
                    }
                    else if(submitType=="add-to-list"){
                        url = "operations/create.php";
                    }

                    var data = $('form').serialize();
                    $('#form-submit-btn').addClass("loading disabled");
                    //========= Ajax Function call =========
                    createOrUpdate(url, data);
                    
                }
            }
        });

        //========= Ajax Function call =========

        readAll();
                    
    });

    </script>
</body>
</html>