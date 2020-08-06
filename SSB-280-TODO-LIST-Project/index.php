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
                    <button class="ui blue right floated button" id="add-to-list-btn">
                        <i class="fas fa-plus"></i>&ensp;Add To List
                    </button>
                </div>
                <div class="content">
                    <div class="header main-heading">
                        <h3>Basic ToDo List App</h3>
                    </div>
                </div>
                <div class="content table-content" id="data-table">
                    <!-- Data Table section -->
                </div>
            </div>
        </div>
    </section>
    <!-- Main section ends -->

    <footer class="footer">
        &copy; 2020, Saleh Ibne Omar <br>
        <?php echo $_SERVER['REMOTE_ADDR']; ?>
    </footer>


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

    <!-- Mini Modals -->
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
    <!-- Mini Modals -->


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
    
                $('footer, section').fadeIn('slow', function () {
                    $('footer, section').show();
                }); 
            }, 400);
        });
    </script>
    <script src="js/script.js"></script>
</body>
</html>