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
    
            function markWorkAsDone(id){
                $.ajax({
                    url:     "operations/update.php",
                    method:  "POST",
                    data:    'id='+id+'&workDone=',
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
                    $('#confirm-msg-details').text("Are you sure you want to delete this work? you won't be able to revert this!");
                    //========= Ajax Function call =========
                    deleteWork(id);
                });
            });
    
            $(document).on('click', '.work-done-btn', function(){
                var id = $(this).val();
                $('#confirmation-modal').modal('show');
                $('#confirm-btn').on("click", function(){
                    $('#confirm-btn').addClass("loading disabled");
                    $('#confirm-msg-details').text("Are you sure you want to mark this work as done?");
                    //========= Ajax Function call =========
                    markWorkAsDone(id);
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
                        $('#confirm-msg-details').text("");
                    }, 500);
                }
            });

            $('#message-modal').modal({
                onHide: function(){
                    $('#message-modal').html("");
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