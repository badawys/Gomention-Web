<img style="width: 15px; height: 15px;" src="{{ $mention->data['favicon_url'] }}"/>
<a>{!! $mention->data['title'] !!}</a>
<p>{!! str_limit($mention->data['description'], 200) !!}</p>