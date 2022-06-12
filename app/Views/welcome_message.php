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
        hr{
            margin: 4px 0;
            border-top: 0px solid;
        }
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
            <a class="nav-link active" aria-current="page" href="<?=base_url();?>">Question 1 and 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('Recruiter-Application');?>">Question 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('Restful-API');?>">Question 4</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container">
        <h6>Question 1. Write a program to remove all the extra spaces from a paragraph/string, consider below sample input, output strings</h6>
        <form action="javascript:void(0)" method="post">
            <div class="row">
                <div class="col-12 form-group">
                    <label for="search">Enter a paragraph/String</label>
                    <textarea class="form-control" id="getstring" rows="3" placeholder="remove all the extra spaces from a paragraph/string"></textarea>
                </div>
            </div>      
            <hr >
            <div class="row">
                <div class="col-12 form-group">
                    <button onclick="getResult()" class="btn btn-sm btn-success"> Get Result </button>
                </div>
            </div>       
            <hr > 
            <div class="row">
                <div class="col-sm form-group">
                    Resposne: <span id="putmessage"></spna>                
                </div>
            </div>
        </form>
    </div>
    <hr >
    <div class="container">
        <h6>Question 2. </h6>
        <p>
            If a number is divisible by 5, then print Hello <br>
            If a number is divisible by 7, then print World <br>
            If a number is divisible by both 5 and 7, then print Hello World <br>
        </p>
        <form action="javascript:void(0)" method="post">
            <div class="row">
                <div class="col-12 form-group">
                    <label for="search">Enter a paragraph/String</label>
                    <input type="text" class="form-control" id="getstring1" placeholder="please enter like 5/7/5 and 7 ">
                </div>
            </div>      
            <hr >
            <div class="row">
                <div class="col-12 form-group">
                    <button onclick="getResult1()" class="btn btn-sm btn-success"> Get Result </button>
                </div>
            </div>       
            <hr > 
            <div class="row">
                <div class="col-sm form-group">
                    Resposne: <span id="putmessage1"></spna>                
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function getResult(){
            var message=$('#getstring').val();
            if(message==''){                
                $('#getstring').focus();
            }
            message=message.replace(/\s+/g,' ').trim();
            $('#putmessage').text(message)
        }    
        
        function getResult1(){
            var input=$('#getstring1').val();
            let message='';
            input=input.replace(/\s+/g,' ').trim();
            if(input=='5'){
                message='print Hello';
            }
            else if(input=='7'){
                message='print World';
            }
            else if(input=='5 and 7' || input=='7 and 5'){                
                message='print Hello World';
            }
            else{
                message='Wrong input';
            }
            $('#putmessage1').text(message)
        }
    </script>
    <!-- bootstrap js file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>