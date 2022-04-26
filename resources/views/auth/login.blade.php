<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemerintah Kabupaten Sidoarjo</title>
  <link rel=”icon” href=”<?= asset('img') ?>/sidoarjo-logo.png”>
  <style>
    body{
    /* background-image: url("https://desain123.com/wp-content/uploads/2021/09/blue-square-abstract-background-01.jpg"); */
    font-family: 'Google Sans','Noto Sans Myanmar UI',arial,sans-serif;
    
    }
    img{
    max-width: 100px;
    max-height: 50px;
    }
    .maindiv{
    position: absolute;
    top: 50%;
    left:50%;
    transform: translate(-50%,-50%);
    width: 350px;
    min-height: 400px;
    padding:3rem;
    border-radius:0.5rem;
    border:1px solid #e1e1e1;
    text-align: center;
    }
    .maindiv .Fields{
    display: inline-block;
    height: 90px;
    position: relative;
    }
    h1{
    font-size:24px;
    font-weight: 200px;
    }
    h3{
    color:#202124;
    font-size: 16px;
    font-weight: 400;
    }
    input{
    outline: none;
    }
    .Before-FS{
    width:344px;
    border: 1px solid #c2c2c2;
    border-radius: 3px;
    height: 28px;
    font-size:16px;
    margin: 1px 1px 0 1px;
    padding: 13px 15px;
    transition: 0.1s;
    }
    .Before-FS:focus{
    border: 2px solid #1a73e8;
    border-top:1px solid transparent;
    }
    .Fs-H{
    opacity: 0;
    transition:0.2s;
    }
    .Fieldset > h1{
    font:1em normal;
    margin:-5px 2.5px -8px;
    position:relative;
    top:-60px
    }
    .Fieldset > h1 > span {
    float: left;
    color:#1a73e8;
    font-family: 'Google Sans','Noto Sans Myanmar UI','arial','sans-serif';
    font-size: 13px;
    }
    
    .Fieldset >h1::before{
    border-top:2px solid #1a73e8;
    content:' ';
    float: left;
    margin: 0.5em 2px 0 -1px;
    width:0.75em
    
    }
    .Fieldset > h1::after{
    
    border-top:2px solid #1a73e8;
    content: ' ';
    display: block;
    height:1.5em;
    left:2px;
    margin: 0 1px 0 0;
    overflow: hidden;
    position: relative;
    top:0.5em;
    }
    .placeholder{
    position: absolute;
    left:20px;
    top:19px;
    color:#80868b;
    font-size: 16px;
    font-weight: 400;
    pointer-events: none;
    transition:0.4s
    }
    
    input:focus ~ label.placeholder,
    input:valid ~ label.placeholder {
    top:3px;
    font-size: 10px;
    opacity: 0;
    }
    
    input:focus + .Fs-H,input:valid + .Fs-H{
    opacity: 1;
    }
    
    button{
    cursor: pointer;
    border:1px solid transparent;
    padding: 6px 12px;
    font-size: 18px;
    line-height: 1.42;
    color:white;
    border-radius: 4px;
    background-color: #1a73e8;
    outline: none;
    min-width: 88px;
    position: absolute;
    left: 75%;
    font-weight: 700;
    }
    .forget{
      text-align: left;
      margin-bottom: 20px;
      color: #1a73e8;
      text-decoration: none;
    }
    .lupa{
      color: #1a73e8;
      text-decoration: none;
      font-weight: 700;
    }
    .lupa:hover{
      color: #0b65da;
    }
    button:hover{
      background-color: #2059a3;
    }
    .alert-danger{
      color: #e03232;
    }
  </style>
</head>

<body>
  <div class="maindiv">
    <img src="{{ asset('img') }}/sidoarjo-logo.png" height="100" alt="Google">
    <h1>Sign In</h1>
    <h3>Silahkan masuk menggunakan akun e-kinerja</h3>
    @if ($message = Session::get('tidaklogin'))
    <div class="alert alert-danger alert-block">
      <p>{{ $message }}</p>
    </div>
    @endif
    @error('username')
    <div class="alert alert-danger alert-block">
      <p>{{ $message }}</p>
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger alert-block">
      <p>{{ $message }}</p>
    </div>
    @enderror
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="inputs">
        <div class="Fields">
          <div class="Fieldset">
            <input type="text" class="Before-FS @error('username') is-invalid @enderror" required="" value="{{ old('username') }}" id="username" name="username">
            <h1 class="Fs-H"><span>Username</span></h1>
            <label class="placeholder">Username</label>
          </div>
        </div>
        <div class="Fields">
          <div class="Fieldset">
            <input type="password" class="Before-FS @error('password') is-invalid @enderror" required="" id="password" name="password">
            <h1 class="Fs-H"><span>Password</span></h1>
            <label class="placeholder">Password</label>
          </div>
        </div>
        <div class="forget">
          <a href="{{ route('ForgetPasswordGet') }}" class="text-body lupa">Lupa password?</a>
        </div>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>

</html>