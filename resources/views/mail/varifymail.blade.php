welcome {{$user->name}}
thank you fo join us 
please virify your email by checking this link :
{{route('varify',['token'=> $user->varified_token])}}