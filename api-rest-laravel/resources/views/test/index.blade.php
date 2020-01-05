<h1>{{$tittle}}</h1>
<ul>
    @foreach($animals as $animal)
        <li>{{$animal}}</li>
    @endforeach
</ul>