<div class="panel panel-default" style="margin: 0px; width: 450px; margin: 0 auto;">
    <div class="panel-body" style="padding: 0px;">

        <div id="{{$mention->id}}" class="item col-md-12 col-sm-12 col-xs-12" style="list-style: none; padding: 0;">
			{{--@include('frontend.user.mention.cards.includes.header', ['mention' => $mention])--}}

			<div class="panel panel-default" style="margin: 0;">
				<div class="panel-body {{'card-body-'.$mention->type }}">
					<div class="{{'card-'.$mention->type }}">

						@if($mention->type == 'text')
							@include('frontend.user.mention.page.cards.text', ['mention' => $mention])

						@elseif($mention->type == 'link')
							@include('frontend.user.mention.page.cards.link', ['mention' => $mention])

						@elseif($mention->type == 'photo' )
							@include('frontend.user.mention.page.cards.photo', ['mention' => $mention])

						@elseif($mention->type == 'video' )
							@include('frontend.user.mention.page.cards.video', ['mention' => $mention])

						@elseif($mention->type == 'sound_cloud' )
							@include('frontend.user.mention.page.cards.sound', ['mention' => $mention])

						@endif
					</div>

					@if(isset($mention->data['text']) && $mention->data['text'] != '')
						<div class="mentionText text-{{$mention->type}}">
							<p dir="auto" style="text-align: justify;">{{($mention->data['text'])}}</p>
						</div>
					@endif

				</div>

				<div class="panel-footer" style="background-color: #ffffff; padding: 0; border: none;">

					@include('frontend.user.mention.cards.includes.footer', ['mention' => $mention])

				</div>
			</div>
		</div>

    </div>
	<button title="Close (Esc)" type="button" class="mfp-close" style=" position: fixed; margin: 0px 30px;font-size: 43px;">×</button>
</div>
