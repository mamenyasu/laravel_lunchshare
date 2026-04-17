<div>
    <div class='mb-3'>
    <label for="pref">場所</label>
    <select id='pref' name='pref' wire:model='selectedPref'>
        <option value="">都道府県を選択してください。</option>
        @foreach($pref as $prefName => $prefData)
        <option value='{{$prefName}}'>{{$prefName}}</option>
        @endforeach
    </select>
    <select id='city' name='city' @disabled(empty($cities))>
        <option value=''>市町村を選んでください。</option>
        @foreach($cities as $city)
        <option value='{{$city["name"]}}'>{{$city["name"]}}</option>
        @endforeach
    </select>
    </div>
</div>