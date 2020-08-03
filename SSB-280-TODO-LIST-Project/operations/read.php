<?php
    date_default_timezone_set('Asia/Dhaka');
    ob_start();
    require 'conn.php';

    $query      = "SELECT * FROM todolist";
    $execution  = mysqli_query($conn, $query);

    $data        = '';

    if(mysqli_num_rows($execution)<1){
        $data = '<p class="center aligned">No Data!</p>';
    }
    else{
        $workStatusArr  = array("Not Done", "Done");

        $data   = '<table class="ui celled table">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th width="32%">Title</th>
                                <th width="12%">From</th>
                                <th width="12%">To</th>
                                <th width="8%">Remaining</th>
                                <th width="12%">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>';

        $count  = 1;

        while($row = mysqli_fetch_assoc($execution)){

            $id = $row['id'];

            $fromDate = $row['fromDate'];

            if(date('Y-m-d')>$row['fromDate']){
                $fromDate=date('Y-m-d');
            }

            $dateDifferenceObject = date_diff(date_create($fromDate), date_create($row['toDate']));
            $dateRemaining        = $dateDifferenceObject->format('%a');
            $dateDifferenceSign   = $dateDifferenceObject->format('%R');
            
            $workName   = $row['workName'];
            $fromDate   = date('d-M-y', strtotime($row['fromDate']));
            $toDate     = date('d-M-y', strtotime($row['toDate']));
            $workStatus = $workStatusArr[$row['workStatus']];

            if($dateRemaining==0){
                $dateRemaining = "Deadline";
            }
            else if($dateDifferenceSign=="-"){
                $dateRemaining = "Expired";
            }
            else if($dateRemaining==1){
                $dateRemaining.=" Day";
            }
            else{
                $dateRemaining.=" Days";
            }

            $data .= '<tr>
                        <td data-label="Serial"><span class="ui circular label">'.$count.'</span></td>
                        <td data-label="Title">'.$workName.'</td>
                        <td data-label="From"><span class="ui olive label">'.$fromDate.'</span></td>
                        <td data-label="To"><span class="ui orange label">'.$toDate.'</span></td>
                        <td data-label="Remaining">'.$dateRemaining.'</td>
                        <td data-label="Status"><span class="ui grey label">'.$workStatus.'</span></td>
                        <td>
                            <button type="button" value="'.$id.'" class="ui green compact button action-btn work-done-btn"><i class="fas fa-check"></i></button>
                            <button type="button" value="'.$id.'" class="ui blue compact button action-btn work-edit-btn"><i class="far fa-edit"></i></button>
                            <button type="button" value="'.$id.'" class="ui red compact button action-btn work-delete-btn"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>';
          ++$count;
        }
        $data .= '</tbody></table>';
    }

    echo $data;

?>