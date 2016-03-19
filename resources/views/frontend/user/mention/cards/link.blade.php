<div dir="auto" onclick="window.open('{{ $mention->data['url'] }}','_blank')" style="cursor: pointer; text-align: justify;">
    <img style="width: 15px; height: 15px;" src="{{ $mention->data['favicon_url'] }}"/>
    <a>{!! $mention->data['title'] !!}</a>
    <p style="font-size: 9px; ">{!! str_limit($mention->data['provider_url'], 50) !!}</p>
    <p>{!! str_limit($mention->data['description'], 200) !!}</p>
</div>
