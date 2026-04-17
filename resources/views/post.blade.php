<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset='utf-8'>
    <title>ランチシェア[laravel版]</title>
    <link rel='stylesheet' href='{{asset("/css/bootstrap.min.css")}}'>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
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

        .post-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 10px;
            margin: 20px;
        }
    </style>

</head>

<body>
    <div class='post-box'>
        <form action="{{route('post')}}" method='post' enctype='multipart/form-data'>
            @csrf
            <div class='mb-3'>
                <label for='user_name'>ユーザー名</label>
                <input type='text' id='user_name' name='user_name' class='form-control form-control-lg @error("user_name") is-invalid @enderror' required>
                @error('user_name')
                <div class="invalid-feedback d-block">{{$message}}</div>
                @enderror
            </div>
            <div class='mb-3'>
                <label for='shop_name'>お店の名前</label>
                <input type='text' id='shop_name' name='shop_name' class='form-control form-control-lg  @error("shop_name") is-invalid @enderror' required>
                @error('shop_name')
                <div class="invalid-feedback d-block">{{$message}}</div>
                @enderror
            </div>
            <div class='mb-3'>
                <label for="pref">場所</label>
                <select id='pref' name='pref'>
                    <option value="">都道府県を選択してください。</option>
                    @foreach($data as $prefName => $prefData)
                    <option value='{{$prefName}}'>{{$prefName}}</option>
                    @endforeach
                </select>
                <select id='city' name='city'>
                    <option value=''>市町村を選んでください。</option>
                </select>
            </div>
            <div class='mb-3'>
                <label for='comment'>コメント</label>
                <textarea id='comment' name='comment' class='form-control form-control-lg @error("comment") is-invalid @enderror'></textarea>
                @error('comment')
                <div class="invalid-feedback d-block">{{$message}}</div>
                @enderror
            </div>
            <div class='mb-3'>
                <label for='upload'>画像アップロード</label>
                <input type='file' id='upload' name='image' class='form-control form-control-lg  @error("image") is-invalid @enderror' required>
                @error('image')
                <div class="invalid-feedback d-block">{{$message}}</div>
                @enderror
            </div>
            <div class='mb-3'>
                <label for='pass'>削除パスワード</label>
                <input type='password' id='pass' name='delete_pass' class='form-control form-control-lg @error("delete_pass") is-invalid @enderror' required>
                @error('delete_pass')
                <div class="invalid-feedback d-block">{{$message}}</div>
                @enderror
            </div>
            <p></p>
            <button type='submit' class='btn btn-outline-secondary w-100 btn-lg'>送信</button>
        </form>
        <p></p>
        <p class='text-center'>お問い合わせは<a href='{{route("contact.show")}}'>こちら</a></p>
        <p></p>
        <p class='text-center'><a href='#' onclick='event.preventDefault(); document.querySelector("#logout-form").submit();'>ログアウト</a></p>
        <form id='logout-form' action='{{route("logout")}}' method='post' style='display:none;'>
            @csrf
        </form>
    </div>

    <hr>

    @foreach($posts as $post)
    <div class="post-box" style="width:800px">
        <div class='mb-3'>
            <h4>投稿：{{$post->user_name}}>> ー＞{{$post->created_at}}</h4>
        </div>
        <div class='mb-3'>
            <h3>店名：{{$post->shop_name}}</h3>
        </div>
        <div class='mb-3'>
            <h4>場所：{{$post->pref_city}}</h4>
        </div>
        <div class='mb-3'>
            <h4>日時：{{$post->created_at}}</h4>
        </div>
        <div class='mb-3'>
            <img style='max-width:100%; height:auto;' src='{{asset("storage/".$post->image_path)}}' alt='投稿画像'>
        </div>
        <div class='mb-3'>
            <h4>{{$post->comment}}</h4>
        </div>
        <div class='mb-3'>
            <form class='form-inline' action='{{route("delete",$post)}}' method='post'>
                @csrf
                @method('DELETE')
                <input type='text' name='post_delete_pass' placeholder='削除パスワード' pattern='[0-9]+' title='半角数字で入力してください。' class='@error("post_delete_pass") is-invalid @enderror' required>
                @error('post_delete_pass')
                <div class="invalid-feedback d-block">{{$message}}</div>
                @enderror
                <button type='submit' class='btn btn-outline-secondary'>削除</button>
            </form>
        </div>
    </div>
    @endforeach

    <hr>
    {{$posts->links()}}
    <hr>

    <script>
        document.querySelector('#pref').addEventListener('change', async function() {
            const pref = this.value;
            const citySelect = document.querySelector('#city');
            citySelect.innerHTML = '<option value="">市町村を選んでください。</option>';
            if (pref == '') {
                return;
            }
            const response = await fetch('/city?pref=' + encodeURIComponent(pref));
            const cities = await response.json();
            for (const city of cities) {
                const opt = document.createElement('option');
                opt.value = city['name'];
                opt.textContent = city['name'];
                citySelect.appendChild(opt);
            }
        })
    </script>
</body>

</html>