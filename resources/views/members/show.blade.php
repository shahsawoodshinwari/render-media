@extends('layouts.app', ['title' => 'Members - Details'])

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-xxl-3">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center mb-4">
            <label class="mr-3" for="avatar">
              <img class="cursor-pointer rounded-circle" src="{{ $member->avatar?->getUrl() ?? asset('assets/members/avatar.png') }}" width="80" height="80" alt="">
            </label>
            <div class="media-body">
              <h3 class="mb-0">{{ $member->name }}</h3>
            </div>
          </div>

          <form action="{{ route('members.profile-picture.update', $member) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="avatar" onchange="this.form.submit();" id="avatar" accept="image/*" class="d-none">
          </form>

          <h4>{{ __('About Me') }}</h4>
          <ul class="card-profile__info">
            <li class="mb-1"><strong class="text-dark mr-4">{{ __('Phone') }}</strong> <span>{{ $member->phone }}</span></li>
            <li><strong class="text-dark mr-4">{{ __('Email') }}</strong> <span>{{ $member->email }}</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-xxl-9">
      <div class="card">
        <div class="card-body">
          <form action="#" class="form-profile">
            <div class="form-group">
              <textarea class="form-control" name="textarea" id="textarea" cols="30" rows="2" placeholder="Post a new message"></textarea>
            </div>
            <div class="d-flex align-items-center">
              <ul class="mb-0 form-profile__icons">
                <li class="d-inline-block">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-user"></i></button>
                </li>
                <li class="d-inline-block">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-paper-plane"></i></button>
                </li>
                <li class="d-inline-block">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-camera"></i></button>
                </li>
                <li class="d-inline-block">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-smile"></i></button>
                </li>
              </ul>
              <button class="btn btn-primary px-3 ml-4">Send</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="media media-reply">
            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
            <div class="media-body">
              <div class="d-sm-flex justify-content-between mb-2">
                <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                <div class="media-reply__link">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i></button>
                  <button class="btn btn-transparent text-dark font-weight-bold p-0 ml-2">Reply</button>
                </div>
              </div>

              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
              <ul>
                <li class="d-inline-block"><img class="rounded" width="60" height="60" src="images/blog/2.jpg" alt=""></li>
                <li class="d-inline-block"><img class="rounded" width="60" height="60" src="images/blog/3.jpg" alt=""></li>
                <li class="d-inline-block"><img class="rounded" width="60" height="60" src="images/blog/4.jpg" alt=""></li>
                <li class="d-inline-block"><img class="rounded" width="60" height="60" src="images/blog/1.jpg" alt=""></li>
              </ul>

              <div class="media mt-3">
                <img class="mr-3 circle-rounded circle-rounded" src="images/avatar/4.jpg" width="50" height="50" alt="Generic placeholder image">
                <div class="media-body">
                  <div class="d-sm-flex justify-content-between mb-2">
                    <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                    <div class="media-reply__link">
                      <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                      <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i></button>
                      <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                    </div>
                  </div>
                  <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="media media-reply">
            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
            <div class="media-body">
              <div class="d-sm-flex justify-content-between mb-2">
                <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                <div class="media-reply__link">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i></button>
                  <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                </div>
              </div>

              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
            </div>
          </div>

          <div class="media media-reply">
            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
            <div class="media-body">
              <div class="d-sm-flex justify-content-between mb-2">
                <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                <div class="media-reply__link">
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                  <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i></button>
                  <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                </div>
              </div>

              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection