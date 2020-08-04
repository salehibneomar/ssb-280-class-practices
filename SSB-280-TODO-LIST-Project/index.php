<!-- ============= Details=============
    Coded by: Saleh Ibne Omar
    SBB-280
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List | SSB-280 | Saleh Ibne Omar</title>

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
    <form class="ui small modal" method="POST" id="form">
        <div class="header" id="form-title"></div>
        <div class="ui form content">
            <div class="field">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title">
            </div>
            <div class="field">
                <label for="fromDate">From</label>
                <input type="date" name="fromDate" id="fromDate">
            </div>
            <div class="field">
                <label for="toDate">To</label>
                <input type="date" name="toDate" id="toDate">
            </div>
            <span id="input-err"></span>
        </div>
        <div class="actions">
            <input type="hidden" id="hidden-input">
            <div class="ui cancel button" id="cancel-submit">Cancel</div>
            <button type="submit" class="ui blue button" id="form-submit-btn"></button>
        </div>
    </form>
    <!-- Form modal ends -->

<div class="ui mini modal">

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
                    $('#data-table').html('<p class="center aligned">Data fetching failed!</p>');
                }
            });
        }

        function createOrUpdate(url, data){
            $('#form-submit-btn').addClass("loading");
            $.ajax({
                url:     url,
                method:  "POST",
                data:    data,
                success: function(returnedData){
                    setTimeout(() => {
                        $('#form-submit-btn').removeClass("loading");
                        $('.ui.mini.modal').modal('show');
                        $('.ui.mini.modal').html(returnedData);
                        readAll();
                    }, 500);
                }
            });
        }

//======================= On Click Functions =======================

        $('#add-to-list-btn').on('click', function(){
            $('.ui.small.modal').modal('show');
            $('#form-title').text("Add To List");
            $('#form-submit-btn').text("Submit");
            $('#form-submit-btn').attr("name", "add-to-list");
            $('#hidden-input').attr("name", "create");
        });

        $(document).on('click', '.work-edit-btn', function(){
            $('.ui.small.modal').modal('show');
            $('#form-title').text("Update Work");
            $('#form-submit-btn').text("Update");
            $('#form-submit-btn').attr("name", "update-work");
            $('#hidden-input').attr("name", "update");
        });

        $(document).on('click', '.cancel-btn', function(){
            $('#input-err').text("");
            $('#title').val("");
            $('#fromDate').val("");
            $('#toDate').val("");
        });

//======================= Form Submission Functions =======================

        $('#form-submit-btn').on('click', function(e){
            e.preventDefault();
            var title    = $('#title').val().trim();
            var fromDate = new Date($('#fromDate').val());
            var toDate   = new Date ($('#toDate').val());
            
            if(fromDate=="Invalid Date" || toDate=="Invalid Date" || title==""){
                $('#input-err').text("Empty/Invalid Input field found!");
            }
            else{
                if(title.length>200){
                    $('#input-err').text("Title cannot have more than 200 characters!");
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

                    var data = $('#form').serialize();

//======================= Ajax Function call =======================
                    createOrUpdate(url, data);
                    
                }
            }
        });

//======================= Ajax Function call =======================

        readAll();
                    
    });

    </script>
</body>
</html>