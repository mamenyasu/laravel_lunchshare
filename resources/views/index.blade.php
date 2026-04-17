{{--index.blade.php--}}

<div>
    <h1>記事一覧</h1>
    <ul>
        @foreach($posts as $post)
        <li>
            <a href="/post/{{$post['id']}}">{{$post['title']}}</a>
        </li>
        @endforeach
    </ul>
</div>
