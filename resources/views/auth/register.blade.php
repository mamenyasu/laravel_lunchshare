<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アカウント作成フォーム[laravel版]</title>
        <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
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
            .form-box{
                background:rgba(255,255,255,0.85);
                padding:2rem;
                border-radius:10px;
                margin:20px;
            }
        </style>
    </head>
    <body>
        <div class="form-box">
            <h1 class="text-center mb-4">アカウント作成</h1>
            <form action="{{route('register')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name">名前</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control form-control-lg @error('name') is-invalid @enderror" required>
                @foreach($errors->get('name') as $message)
                <div class="invalid-feedback d-block">{{$message}}</div>
                @endforeach
                </div>
                <div class="mb-3">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control form-control-lg @error('email') is-invalid @enderror" required>
                @foreach($errors->get('email') as $message)
                <div class="invalid-feedback d-block">{{$message}}</div>
                @endforeach
                </div>
                <div class="mb-3">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required>
                @foreach($errors->get('password') as $message)
                <div class="invalid-feedback d-block">{{$message}}</div>
                @endforeach
                </div>
                 <div class="mb-3">
                    <label for="password_confirmation">パスワード（確認用）</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required>
                </div>
                <p></p>
                <div>
                    <button type="submit" class="btn btn-outline-secondary w-100 btn-lg">送信</button>
                </div>
            </form>
            <p></p>
            <p class="text-center">ログインページへ<a href="{{route('showlogin')}}">戻る</a></p>
        </div>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>