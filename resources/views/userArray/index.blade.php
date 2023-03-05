<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <div class="m-4">
        <div class="m-4">
            <h1>active users</h1>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($active_users as $key=>$active )
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$active->name}}</td>
                    <td>{{$active->email}}</td>
                    <td><a class="btn btn-danger" onclick="arrayPush({{$active->id}},'active')">ADD</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-4">
        <div class="m-4">
            <h1>in-active users</h1>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($in_active_users  as $key=>$in_active )
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$in_active->name}}</td>
                    <td>{{$in_active->email}}</td>
                    <td><button class="btn btn-danger"  onclick="arrayPush({{$in_active->id}},'inactive')" >ADD</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form  action="{{route('data.store')}}" method="post">@csrf
    <label>active users</label>
    <input type="text" id="display" name="acive"></input>
    <label>in-active users</label>
    <input type="text" id="displayin" name="inactive"></input>
    <input type="submit"></input>
    </form>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var arrayId=[];
    var arrayactive=[];
    var arrayinactive=[];

    function arrayPush(data,type){

        var dataType=type;
        alert(dataType);
        if(dataType === 'active'){
            arrayactive.push(data);
            console.log("active array ", arrayactive);
            $("#display").val(JSON.stringify(arrayactive));
            $.ajax({
                type:'post',
                dataType:'json',
                url:'{{route('data.process')}}',
                data:{
                    'arrayactive':arrayactive,
                    '_token':'{{csrf_token()}}'
                },
                success:function(data){
                    console.log(data);
                }
            });
        }
        else{
            arrayinactive.push(data);
            console.log("in-active array ", arrayinactive);
            $("#displayin").val(JSON.stringify(arrayinactive));
            $.ajax({
                type:'post',
                dataType:'json',
                url:'{{route('data.process')}}',
                data:{
                    'arrayinactive':arrayinactive,
                    '_token':'{{csrf_token()}}'
                },
                success:function(data){
                    console.log(data);
                }
            });
        }
    }

</script>
