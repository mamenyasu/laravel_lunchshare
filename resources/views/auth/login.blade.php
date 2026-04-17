<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8'>
    <title>ランチシェア[laravel版]</title>
    <meta name='description' content='今日のランチを簡単シェアしよう！'>
    <link rel='stylesheet' href='{{asset("/css/bootstrap.min.css")}}'>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body{
            background:url('{{asset("imgsrc/loginbackimg.png")}}') no-repeat center center/cover;
            height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            font-family:"Zen Maru Gothic", sans-serif;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 10px;
            margin:20px;
        }
    </style>
    </head>
<body>
    <div class='login-box'>
    <h1 class='text-center mb-4'>ログイン</h1>
    @error('email_or_password')
        <p style="color:red;">{{$message}}</p>
    @enderror
    <form action='{{route("login")}}' method='post'>
        @csrf
        <div class='mb-3'>
            <label for='email'>メールアドレス</label>
            <input type='email' id='email' name='email' value="{{old('email')}}" class='form-control form-control-lg @error("email") is-invalid @enderror' required>
            @error('email')
            <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror
        </div>
        <div class='mb-3'>
            <label for='password'>パスワード</label>
            <input type='password' id='password' name='password' class='form-control form-control-lg @error("password") is-invalid @enderror' required>
            @error('password')
            <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror
        </div>
        <p></p>
        <div>
            <button type='submit' class='btn btn-outline-secondary w-100 btn-lg'>ログイン</button>
        </div>
    </form>
    <p></p>
    <p class='text-center'>アカウントをお持ちでない方は<a href='{{route("showRegister")}}'>こちら</a></p>
    <p></p>
    <p class='text-center'>お問い合わせは<a href='{{route("contact.show")}}'>こちら</a></p>
    </div>
 <script src='{{asset("js/bootstrap.bundle.min.js")}}'></script>
</body>
</html>