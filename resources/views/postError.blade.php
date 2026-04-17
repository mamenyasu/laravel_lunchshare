<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset='utf-8'>
    <title>ランチシェア・アップロード</title>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
    <link rel='stylesheet' href='{{asset("/css/bootstrap.min.css")}}'>
    <style>
        body {
            background:url('{{asset("imgsrc/loginbackimg.png")}}') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: "Zen Maru Gothic", sans-serif;
        }

        .upload-message-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 10px;
            margin: 20px;
        }
    </style>
    <meta http-equiv="refresh" content="3;url={{route('showPost')}}">
</head>

<body>
    <div class='upload-message-box'>
        <div class='mb-3'>
            <h1 style="color:red">申し訳ございません。データベースエラーにより投稿が保存できませんでした。</h1>
        </div>
        <p></p>
        <div class='mb-3'>
            <h3>3秒後にリダイレクトします。</h3>
        </div>
    </div>
</body>

</html>