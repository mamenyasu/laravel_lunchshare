<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>問い合わせ[laravel版]</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <style>
        body{
            background:url("{{asset('imgsrc/loginbackimg.png')}}") no-repeat center center/cover;
            min-height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            font-family:"Zen Maru Gothic", sans-serif;
        }
        .contact-box{
            background:rgba(255,255,255,0.85);
            padding:2rem;
            border-radius:10px;
            margin:20px;
        }
    </style>
</head>
<body>
    <div class="contact-box">
        <div class="mb-3">
            <h2>問い合わせフォーム</h2>
        </div>
        <form action="{{route('contact')}}" method="post">
            @csrf
            <div class="mb-3">
                お名前：<input type="text" name="name" required title="名前を入力してください。">
            </div>
            <div class="mb-3">
                メールアドレス：
            </div>
            <div class="mb-3">
                <input type="email" style="width:100%" name="email" required title="メールアドレスを入力してください。">
            </div>
            <div class="mb-3">
                お問い合わせ内容：
            </div>
            <div class="mb-3">
                <textarea name="text" rows="5" cols="30" style="width:100%" required title="本文を入力してください。"></textarea>
            </div>
            <input type="text" hidden name="date" value="{{date('Y年m月d日H時i分s秒')}}">
            <p></p>
            <button type="submit" class="btn btn-outline-secondary w-100 btn-lg">送信</button>
        </form>
         <p></p>
        <p class='text-center'><a href='{{route("showlogin")}}'>戻る</a></p>
    </div>
</body>
</html>