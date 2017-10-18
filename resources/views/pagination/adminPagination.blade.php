@php
    if($result->lastPage() == 1) return;
    $url = parse_url($_SERVER['REQUEST_URI'])['query']?? '';
    $query = preg_replace('/[&]?page=\d+/', '', $url);
    if(strlen($query)){
        $query = Request::url().'?'.$query.'&page=';
    }else{
        $query .= Request::url().$query.'?page=';
    }
@endphp
<ul class="pagination">
    <ul class="pagination">
        @for($p = 1; $p <= $result->lastPage(); $p++)
            <li {{$result->currentPage() == $p? "class=active": ''}}>
                <a href="{{$query.$p}}">{{ $p }}</a>
            </li>
        @endfor
    </ul>

</ul>