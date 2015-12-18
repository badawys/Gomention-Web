<div onclick="window.open('{{ $mention['url'] }}','_blank')" style="cursor: pointer;">
    <img style="width: 15px; height: 15px;" src="{{ $mention['favicon_url'] }}"/>
    <a>{!! $mention['title'] !!}</a>
    <p style="font-size: 9px; ">{!! str_limit($mention['provider_url'], 50) !!}</p>
    <p>{!! str_limit($mention['description'], 200) !!}</p>
</div>
