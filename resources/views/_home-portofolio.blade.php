<section class="portofolio-container">
    <div class="container">
      <div class="row center-xs">
        <div class="col-xs-11 portofolios-header">
          <h3>portofolio</h3>
          @if ($auth = auth()->user())
            @if ($auth->id==$user->id)
          {!! Form::button('Add portofolio', array('class' => 'btn btn-outline btn-sm', 'id' => 'add-portofolio', 'type' => 'button')) !!}
            @endif
          @endif
        </div>
      </div>
      <div class="row center-xs">
        <a class="col-xs-11 portofolios">
          @foreach($user->portofolio as $portofolio)
          <div class="item-wrapper" id="show-portofolio" data-portofolio-id="{{$portofolio->id}}">
            {!! Html::image(asset('storage/portofolio/'.$portofolio->thumbnail), null, array('class' => 'profile-img')) !!}
            <div class="item-body">
            <span>{{$portofolio->project_name}}</span>
            </div>
          </div>
          @endforeach
        </a>
      </div>
    </div>
  </section>