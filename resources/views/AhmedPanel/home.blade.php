@extends('AhmedPanel.layouts.app')

@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-lg-4 col-md-6 col-sm-6" style="cursor: pointer">--}}
{{--            <div class="card card-stats">--}}
{{--                <div class="card-header" data-background-color="black">--}}
{{--                    <i class="material-icons">person</i>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <p class="category">{{__('crud.User.crud_names')}}</p>--}}
{{--                    <h3 class="title">{{\App\Models\User::count()}}</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-md-6 col-sm-6" style="cursor: pointer">--}}
{{--            <div class="card card-stats">--}}
{{--                <div class="card-header" data-background-color="black">--}}
{{--                    <i class="material-icons">card_giftcard</i>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <p class="category">{{__('crud.Brand.crud_names')}}</p>--}}
{{--                    <h3 class="title">{{\App\Models\Brand::count()}}</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--            <div class="card card-stats" style="cursor: pointer">--}}
{{--                <div class="card-header" data-background-color="black">--}}
{{--                    <i class="material-icons">flash_on</i>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <p class="category">{{__('crud.Offer.crud_names')}}</p>--}}
{{--                    <h3 class="title">{{\App\Models\Offer::count()}}</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="{{ config('app.color') }}">
                    <h4 class="title">  {{__('dashboard.Home.n_send_general')}} </h4>
                </div>
                <div class="card-content">
                    <form action="{{url('uni-dashboard/notification/send')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 btn-group required">
                                <label for="title">{{__('dashboard.Home.n_title')}} :</label>
                                <input type="text" required="" name="title" id="title" class="form-control" placeholder="{{__('dashboard.Home.n_enter_title')}}">
                            </div>
                            <div class="col-md-6 btn-group required">
                                <label for="msg">{{__('dashboard.Home.n_text')}} :</label>
                                <input type="text" required="" name="msg" id="msg" class="form-control" placeholder="{{__('dashboard.Home.n_enter_text')}}">
                            </div>
                            <div class="col-md-1 " style="margin-top: 50px">
                                <button type="submit" id="send" class="btn btn-primary">{{__('dashboard.Home.n_send')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
