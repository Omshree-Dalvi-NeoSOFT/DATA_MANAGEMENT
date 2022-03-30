
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="container">
   <div class="container">
    <p>
    Congratulations on making it to our team! Our whole team is eagerly looking forward to working with you. With your creative insights, we can make positive improvements here.<br>
    We are delighted to have an enthusiastic professional with a creative mind among us. Together, we can make a great team and strive to achieve the impossible.<br>
    On behalf of the whole department, welcome onboard! Your experience and skill will be a valuable asset to our team, and we look forward to your input.
    </p>
    <p>
      <h3>Welcome {{$fname}}</h3>
      <br>
      Following are the Login Credentials :
    </p>
   </div>
    <table class="table text-left" style="text-align: left;">
    <tr>
      <th><b>Name :</b></th>
      <td>{{$fname}} {{$lname}}</td>
    </tr>
    <tr>
    <th><b>Email :</b></th>
    <td>{{$email}}</td>
    </tr>
   <tr>
   <th><b>Password :</b></th>
   <td>{{$password}}</td>
   </tr>
  </tbody>
</table>
<div class="container">
  <p>
    <h2>Thanks & Regards,</h2>
  </p>
</div>
<div class="container">
  <p>
    <h6>this is system generated mail..</h6><br>
</p>
</div>

</body>
</html>