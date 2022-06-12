<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tudip Task</title>
    <!-- bootstrap cs file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        table.sortable th::after, th.sorttable_sorted::after, th.sorttable_sorted_reverse::after {
            content: " ";
            display: inline-block;
            width: 24px;
            height: 24px;
        }
        th.sorttable_sorted::after {
            background: url(my-sorted-icon.png);
            background-size: contain;
        }
        th.sorttable_sorted_reverse::after {
            background: url(my-sorted-reversed-icon.png);
            background-size: cover;
        }
        #sorttable_sortfwdind, #sorttable_sortrevind { display: none; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=base_url();?>">Tudip Task</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=base_url();?>">Question 1 and 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('Recruiter-Application');?>">Question 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?=base_url('Restful-API');?>">Question 4</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container">
        <h6>Question 4. Write Restful API to fetch all the candidates in the grid</h6>
        <form method="post">
            <div class="row">
                <div class="col-3 form-group">
                    <select class="form-control" id="limit" onchange="getCandidates()">
                        <option value="2">2</option>
                        <option value="5">5</option>
                        <option value="7">7</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-6 form-group"></div>
                <div class="col-3 form-group">
                    <input type="text" id="searching" class="form-control" onblur="getCandidates()">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table sortable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Addresss</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    </tbody>
                </table>   
            </div>    
            <div class="row">
                <div class="col-12">
                    Total Records: <span id="current_records">0</span>-<span id="all_records">0</span>
                </div>
            </div> 
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        getCandidates();
        function getCandidates(){
            let offset=0;
            let limit=$('#limit').val();
            let searching=$('#searching').val();
            $.ajax({
                url:'<?=base_url('getCandidates');?>',
                type:'POST',
                dataType: 'JSON',
                data:{
                    offset:offset,
                    limit:limit,
                    searching:searching
                },
                beforeSend:function(){
                    var tbody='';
                    tbody+='<tr>';
                        tbody+='<td colspan="6" style="color:red;text-align:center;">Please Wait.......</td>';
                    tbody+='</tr>';
                    $('.table-group-divider').html(tbody);
                },
                success:function(result){
                    var tbody='';
                    var counter=0;
                    $.each(result.candidates,function(key,value){
                        counter++;
                        tbody+='<tr>';
                            tbody+='<th scope="row">'+counter+'</th>';
                            tbody+='<td><span id="hideName'+value.id+'">'+value.name+'</span><input type="hidden" id="editName'+value.id+'" class="form-control" value="'+value.name+'"></td>';
                            tbody+='<td><span id="hidePhone_Number'+value.id+'">'+value.phone_number+'</span><input type="hidden" id="editPhone_Number'+value.id+'" class="form-control" value="'+value.phone_number+'"></td>';
                            tbody+='<td><span id="hideEmail'+value.id+'">'+value.email+'</span><input type="hidden" id="editEmail'+value.id+'" class="form-control" value="'+value.email+'"></td>';
                            tbody+='<td><span id="hideAddress'+value.id+'">'+value.address+'</span><input type="hidden" id="editAddress'+value.id+'" class="form-control" value="'+value.address+'"></td>';
                            tbody+='<td><span id="hideButton'+value.id+'" class="btn btn-info" onclick="edit('+value.id+')">Edit</span> <span style="display:none;" id="updateBTN'+value.id+'" onclick="update('+value.id+')" class="btn btn-success">Update</span></td>';
                        tbody+='</tr>';
                    });
                    $('.table-group-divider').html(tbody);
                    $('#current_records').text(result.current_records);
                    $('#all_records').text(result.total_rows);
                },
                error:function(err){
                    var tbody='';
                    tbody+='<tr>';
                        tbody+='<td colspan="6" style="color:red;text-align:center;">Something went to wrong</td>';
                    tbody+='</tr>';
                    $('.table-group-divider').html(tbody);
                }
            })
        }

        function edit(id){
            $('#hideButton'+id).hide();
            $('#hideName'+id).hide();
            $('#hidePhone_Number'+id).hide();
            $('#hideEmail'+id).hide();
            $('#hideAddress'+id).hide();

            $('#editName'+id).attr("type","text");
            $('#editPhone_Number'+id).attr("type","number");
            $('#editEmail'+id).attr("type","email");
            $('#editAddress'+id).attr("type","text");

            $('#updateBTN'+id).show();
        }

        function update(id){
            
            let name=$('#editName'+id).val();
            let phone_number=$('#editPhone_Number'+id).val();
            let email=$('#editEmail'+id).val();
            let address=$('#editAddress'+id).val();

            $.ajax({
                url:'<?=base_url('candidates');?>/'+id,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                method:'PUT',
                data:{
                    name:name,
                    phone_number:phone_number,
                    email:email,
                    address:address
                },
                beforeSend:function(){
                    var tbody='';
                    tbody+='<tr id="waiting_msg'+id+'">';
                        tbody+='<td colspan="5" style="color:red;text-align:center;">Please Wait.......</td>';
                    tbody+='</tr>';
                    $('.table-group-divider').append(tbody);
                },
                success:function(result){
                    if(result.status='200'){
                        $('#hideButton'+id).show();
                        $('#hideName'+id).show();
                        $('#hidePhone_Number'+id).show();
                        $('#hideEmail'+id).show();
                        $('#hideAddress'+id).show();
                        
                        
                        $('#hideName'+id).text(name);
                        $('#hidePhone_Number'+id).text(phone_number);
                        $('#hideEmail'+id).text(email);
                        $('#hideAddress'+id).text(address);

                        $('#editName'+id).attr("type","hidden");
                        $('#editPhone_Number'+id).attr("type","hidden");
                        $('#editEmail'+id).attr("type","hidden");
                        $('#editAddress'+id).attr("type","hidden");
                        $('#updateBTN'+id).hide();
                        $('#waiting_msg'+id).remove();
                    }
                    else{                        
                        var tbody='';
                        tbody+='<tr id="waiting_msg'+id+'">';
                            tbody+='<td colspan="5" style="color:red;text-align:center;">'+result.messages+'</td>';
                        tbody+='</tr>';
                        $('.table-group-divider').append(tbody);
                    }
                },
                error:function(err){
                    $('#waiting_msg'+id).remove();
                    var tbody='';
                    tbody+='<tr id="waiting_msg'+id+'">';
                        tbody+='<td colspan="5" style="color:red;text-align:center;">Something went to wrong</td>';
                    tbody+='</tr>';
                    $('.table-group-divider').append(tbody);
                }
            })
        }

    </script>
    <!-- bootstrap js file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>