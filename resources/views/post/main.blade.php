<!DOCTYPE html>
<html lang="ja"> 
<head>
<meta charset='utf-8'>
<title>ランチシェア</title>
<link rel='stylesheet' href='{{asset("/css/bootstrap.min.css")}}'>
<meta name='viewport' content='width=device-width,initial-scale=1'>
<style>
    body{
        background:url(imgsrc/loginbackimg.png) no-repeat center center/cover;
        min-height:100vh;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        font-family:"Zen Maru Gothic", sans-serif;
    }
     .post-box{
        background:rgba(255,255,255,0.85);
        padding:2rem;
        border-radius:10px;
        margin:20px;
     }
</style>
</head>
<body>
    <div class='post-box'>
    <form action='upload.php' method='post' enctype='multipart/form-data'>
        @csrf
        <input type='hidden' name='token' value='<?php echo $token ?>'>
        <div class='mb-3'>
            <label for='user_name'>ユーザー名</label>
            <input type='text' id='user_name' name='user_name' class='form-control form-control-lg'>
        </div>
        <div class='mb-3'>
            <label for='shop_name'>お店の名前</label>
            <input type='text' id='shop_name' name='shop_name' class='form-control form-control-lg' required>
        </div>
        <div class='mb-3'>
            <label for="pref">場所</label>
            <select id='pref' name='pref'>
                <option value="">都道府県を選択してください。</option>
                 @foreach($data as $prefName => $prefData)
                    <option value='{{$prefName)}}'>{{$prefName}}</option>
                 @endforeach;
            </select>
            <select id='city' name='city'>
                <option value=''>市町村を選んでください。</option>
            </select>
        </div>
        <div class='mb-3'>
            <label for='comment'>コメント</label>
            <input type='text' id='comment' name='comment' class='form-control form-control-lg'>
        </div>
        <div class='mb-3'>
            <label for='upload'>画像アップロード</label>
            <input type='file' id='upload' name='image' class='form-control form-control-lg'>
        </div>
        <div class='mb-3'>
            <label for='pass'>削除パスワード</label>
            <input type='password' id='pass' name='pass' class='form-control form-control-lg' required>
        </div>
        <p></p>
            <button type='submit' class='btn btn-outline-secondary w-100 btn-lg'>送信</button>
    </form>
    </div>

    <hr>

    @foreach($posts as $post)
        <div class="post-box">
                <div class='mb-3'>
                    <h4>投稿：{{$post->user_name}}>> ー＞{{$post->created_at}}</h4>
                </div>
                <div class='mb-3'>
                    <h3>店名：{{$posts->shop_name}}</h3>
                </div>
                <div class='mb-3'>
                    <h4>場所：{{$posts->prefcity}}</h4>
                </div>
                <div class='mb-3'>
                    <h4>日時：{{$posts->created_at}}</h4>
                </div>
                <div class='mb-3'>
                    <img style='max-width:100%; height:auto;' src='{{asset("storage/".$post->image_path}}>' alt='投稿画像'>
                </div>
                <div class='mb-3'>
                    <h4>{{$post->comment}}</h4>
                </div>
                <div class='mb-3'>
                    <form class='form-inline' action='{{route("delete")}}' method='post'>
                        @csrf
                        <input type='hidden' name='id' value='{{$post->id}}'>
                        <input type='text' name='delete_pass' placeholder='削除パスワード' pattern='[0-9]+' title='半角数字で入力してください。' required>
                        <button type='submit' class='btn btn-outline-secondary'>削除</button>
                    </form>
                </div>
        </div>
    @endforeach
    
    <hr>
    {{$posts->links()}}
    <hr>

    
    <script src='{{asset("js/bootstrap.bundle.min.js")}}'></script>
    <script>
        document.querySelector('form[action="upload.php"]').addEventListener('submit',function(){
            const userName=document.querySelector('#user_name');
            if(userName.value.trim()==''){
                userName.value="名無し";        
            }
        })
    </script>
    <script>
        document.querySelector('#pref').addEventListener('change',async function(){
                const pref=this.value;
                const citySelect=document.querySelector('#city');
                citySelect.innerHTML='<option value="">市町村を選んでください。</option>';
                    if(pref==''){
                        return;
                    }
                    const response=await fetch('city.php?pref='+encodeURIComponent(pref));
                    const cities=await response.json();
                       for(const city of cities){
                            const opt=document.createElement('option');
                            opt.value=city['name'];
                            opt.textContent=city['name'];
                            citySelect.appendChild(opt);
                        }
            })
    </script>
</body>
</html>