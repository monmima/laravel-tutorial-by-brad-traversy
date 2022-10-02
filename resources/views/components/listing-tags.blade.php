@props(['tagsCsv'])
@php
    // splitting the props $tagsCsv into an array of tags
    $tags = explode(",", $tagsCsv);
@endphp

<ul class="flex">
    @forEach($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>