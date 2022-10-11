<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    <div class="container">
        <h1 class="text-center">Employment Crud</h1>

        <button type="button" class="btn btn-primary d-flex justify-content-end float-right" data-toggle="modal" data-target="#myModal">Add Employ</button>
        
        <h2>All Record</h2>
        <div id="viewrecord"></div>
            <!-- The Modal -->
        <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Employ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                   
                    <label>Dob</label>
                    <input type="date" name="dob" id="dob" placeholder="DOB" class="form-control">

                    <label>Current CTC</label>
                    <input type="text" name="ctc" id="ctc" placeholder="Current CTC" class="form-control">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>

        <!-- Update Modal -->
        <div class="modal" id="update_modal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Employ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="name" id="update_name" placeholder="Name" class="form-control">
                   
                    <label>Dob</label>
                    <input type="date" name="dob" id="update_dob" placeholder="DOB" class="form-control">

                    <label>Current CTC</label>
                    <input type="text" name="ctc" id="update_ctc" placeholder="Current CTC" class="form-control">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateRecord()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="hidden" id="hiddenid">
            </div>

            </div>
        </div>
        </div>
    </div>


<script>
    $(document).ready(function(){
        
        readRecord();
    });

    function deleteData(deleteid){
        var conf = confirm('Are you sure you want to delete this?');
        if(conf == true){
            
            $.ajax({
                url: 'backened.php',
                type: 'post',
                data: { deleteid:deleteid },
                
                success:function(data,status){
                    readRecord();
                }
            });
        }
    }

    function readRecord(){
        var readrecord = "readrecord"; 

        $.ajax({
            url: 'backened.php',
            type: 'post',
            data: { readrecord:readrecord },

            success:function(data,status){
                $('#viewrecord').html(data);
            }
        });
    }

    function addRecord() {
        var name = $('#name').val();
        var dob = $('#dob').val();
        var ctc = $('#ctc').val();

        $.ajax({
            url: 'backened.php',
            type: 'post',
            data: { name: name, 
                dob: dob,
                ctc: ctc
            },

            success:function(data, status){
                readRecord();
            }
        });
    }

    function updateData(id){
        $("#hiddenid").val(id);

        $.post("backened.php", {
            id:id
        }, function(data,status){
            var employ = JSON.parse(data);
            $("#update_name").val(employ.name);
            $("#update_dob").val(employ.dob);
            $("#update_ctc").val(employ.ctc);
        }
        
        );
        $("#update_modal").modal("show");
    }

    function updateRecord(){
        var nameup = $('#update_name').val();
        var dobup = $('#update_dob').val();
        var ctcup = $('#update_ctc').val();

        var hiddenidup = $("#hiddenid").val();

        $.post('backened.php',{
            hiddenidup:hiddenidup,
            nameup:nameup,
            dobup:dobup,
            ctcup:ctcup     
        },
        function(data,status){
            $("#update_modal").modal("hide");
            readRecord();
        }

        );

    }

    
</script>
</body>
</html>