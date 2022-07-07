<h1>Welcome</h1>
<br>Hello {{$data['name']}},
hi.. Many Mnay congratulation to create your accounnt in our portal.<br>
your email id is==>{{$data['email']}}<br>
password is=>{{$data['password']}}

TO veerify <a href='{{ route('email_verfiy',['verifyToken'=>$token]) }}''> click here  to veryfy Registration</a>
         

