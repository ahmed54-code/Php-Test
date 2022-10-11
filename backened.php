<?php 
    $conn = mysqli_connect("localhost","root","","employ");

    extract($_POST);

    if (isset($_POST['readrecord'])){
        
        $data = '<table class="table table-bordered table-striped mt-4">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Dob</th>
                    <th>Current Ctc</th>
                    <th>Edit Action</th>
                    <th>Delete Action</th>
                </tr>';

        $displayquery = "SELECT * FROM `employes`";
        $result = mysqli_query($conn,$displayquery);

        if(mysqli_num_rows($result) > 0){
            
            $number = 1;
            
            while($row = mysqli_fetch_array($result)){
                $data .= '<tr>
                            <td>'.$number.'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['dob'].'</td>
                            <td>'.$row['ctc'].'</td>
                            <td>
                                <button onclick="updateData('.$row['id'].')" class="btn btn-primary">Edit</button>
                            </td>
                            <td>
                                <button onclick="deleteData('.$row['id'].')" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>';
                $number++;

            }
        }
        $data .= '</table>';
            echo $data;
    }

    if(isset($_POST['name']) && isset($_POST['dob']) && isset($_POST['ctc']) ){
        $query = "INSERT INTO `employes`(`name`, `dob`, `ctc`) 
            VALUES ('$name', '$dob', '$ctc')";

    mysqli_query($conn, $query);
}

// Delete Recoed

if (isset($_POST['deleteid'])) {
    $employid = $_POST['deleteid'];
    $delete = "delete from employes where id='$employid'";
    mysqli_query($conn, $delete);

}

// Edit Record

if (isset($_POST['id']) && isset($_POST['id']) != "") 
{
    $employid = $_POST['id'];
    $query = "SELECT * FROM employes WHERE id = '$employid'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }    

    $response = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data Not Found!";
    }
    echo json_encode($response);
}

else{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}

// Update Record

if (isset($_POST['hiddenidup'])) 
{
    $hiddenidup = $_POST['hiddenidup'];
    $nameup = $_POST['nameup'];
    $dobup = $_POST['dobup'];
    $ctcup = $_POST['ctcup'];
   
    $query = "UPDATE `employes` SET `name`='$nameup', `dob`='$dobup', `ctc`='$ctcup' WHERE id='$hiddenidup'";
    if (!$result = mysqli_query($conn,$query)){
        exit(mysqli_error());
    }
   
}

?>