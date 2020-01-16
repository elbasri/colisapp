@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Prices List')}}
        <a href="#" class="btn btn-primary btn-md float-right" data-toggle="modal" data-target="#addNew">
            <i class="fa fa-plus"></i>   {{__('ADD NEW')}}
        </a>
    </h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('frontend.prices') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price_city" style="text-transform: uppercase;"><strong>{{__('Price City Text')}}</strong></label>
                                <input class="form-control form-control-lg mb-3" name="price_city" value="{{ $setting->price_city ?? old('price_city') }}"  type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price_details" style="text-transform: uppercase;"><strong>{{__('Price Details Text')}}</strong></label>
                                <textarea class="form-control" id="join_us_details" rows="2" name="price_details">{{ $setting->price_details ?? old('price_details') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">{{__('UPDATE')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>{{__('Serial')}}</th>
                                <th>{{__('City')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Details')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pricesList as $key=>$prices)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $prices->city }}</td>
                                <td>{!! $prices->price !!}</td>
                                <td>
                                    {!! str_limit($prices->details, 15,'') !!}
                                    @if(str_word_count($prices->details) > 5)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#commentDetails{{ $prices->id }}">
                                        <i class="fa fa-eye"></i>  {{__('Details')}}
                                    </button>
                                    <div class="modal fade" id="commentDetails{{ $prices->id }}" role="dialog" aria-labelledby="#commentDetails" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-city" style="text-transform: uppercase">&nbsp; {{__('Price Details')}} </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>{!! $prices->details !!}</strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPrice{{ $prices->id }}">
                                        <i class="fa fa-edit"></i>  {{__('Edit')}}
                                    </button>
                                    <div class="modal fade" id="editPrice{{ $prices->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-city" id="myModalLabel"><i class="fa fa-share-square"></i> {{__('Edit Price')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <form method="POST" action="{{ route('frontend.updatePrices',$prices->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="city" class="col-sm-3 control-label bold uppercase"><strong>{{__('City')}} :</strong> </label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control has-error bold " id="name" name="city" value="{{ $prices->city ?? old('city') }}" placeholder="{{__('City')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group error">
                                                                <label for="price" class="col-sm-3 control-label bold uppercase"><strong>{{__('Price')}}</strong> </label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control has-error bold demo" id="price" value="{{ $prices->price ?? old('price') }}" name="price" placeholder="{{__('Price')}}">
                                                                    <small class="text-danger"><strong></strong></small>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="details" class="col-sm-3 control-label bold uppercase"><strong>{{__('Details')}} :</strong> </label>
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control" id="details" rows="2" name="details">{{ $prices->details ?? old('details') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-primary bold uppercase"><i class="fas fa-arrow-alt-circle-up"></i> {{__('Update Price')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm delete_button" data-toggle="modal" data-target="#delete">
                                        <i class="fa fa-times"></i>  {{__('DELETE')}}
                                    </button>
                                    <div class="modal fade" id="delete" role="dialog" aria-labelledby="#delete" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('frontend.deletePrices',$prices->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-city" id="delete"><i class="fa fa-trash"></i>&nbsp;{{__('Delete')}} !</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>{{__('Are you sure, you want to delete ?')}}</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('No')}}</button>
                                                        <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>                 
                            </tr>
                            @endforeach
                        </tbody>
                        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-city" id="myModalLabel"><i class="fa fa-share-square"></i> {{__('')}}Add New Price</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <form method="POST" action="{{ route('frontend.storePrices') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="city" class="col-sm-3 control-label bold uppercase"><strong>{{__('')}}City :</strong> </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control has-error bold " id="city" name="city" value="{{ old('city') }}">

                                                </div>
                                            </div>
                                            <div class="form-group error">
                                                <label for="price" class="col-sm-3 control-label bold uppercase"><strong>{{__('')}}Price</strong> </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control has-error bold demo" id="price" name="price" placeholder="">
                                                    <small class="text-danger"><strong></strong></small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="details" class="col-sm-3 control-label bold uppercase"><strong>{{__('')}}Details :</strong> </label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="details" rows="2" name="details">{{  old('details') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{__('')}}Close</button>
                                            <button type="submit" class="btn btn-primary bold uppercase"><i class="fas fa-arrow-alt-circle-up"></i> {{__('')}}Save Prices</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#frontend").addClass("show");
    $("#frontend li:nth-child(6)").addClass("active");
    bkLib.onDomLoaded(function () {
        new nicEditor({iconsPath: '../assets/admin/img/nicEditorIcons.gif'}).panelInstance('popular_exam_details');
    });
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endsection