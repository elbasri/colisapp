@extends('staff.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Create Courier')}}</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('currier.store') }}" method="POST" id="form">
                @csrf
                <div class="row">
				@if (Auth::user()->type == "Staff")
                    <div class="col-lg-6" style="display:none">
				@else
					<div class="col-lg-6">
				@endif
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="mb-2 text-uppercase">{{__('Sender Info')}}<hr></h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="sender_name" style="text-transform: uppercase;"><strong>{{__('Sender Name')}}&nbsp;<span class="mark">*</span></strong></label>
                                            <input class="form-control form-control-lg" type="text" id="sender_name" name="sender_name" value="{{ Auth::user()->name }}">
                                            <input type="hidden" name="sender_branch_id" value="{{ Auth::user()->branch_id }}">
                                            <input type="hidden" name="sender_branch_staff_id" value="{{ Auth::user()->id }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="sender_phone" style="text-transform: uppercase;"><strong>{{__('Sender Phone')}}&nbsp;<span class="mark">*</span></strong></label>
                                            <input class="form-control form-control-lg" type="text" id="sender_phone" name="sender_phone" value="{{ Auth::user()->phone }}" placeholder="{{__('Sender Phone')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="sender_email" style="text-transform: uppercase;"><strong>{{__('Sender Email')}}</strong></label>
                                            <input class="form-control form-control-lg" type="text" name="sender_email" value="{{ Auth::user()->email }}" placeholder="{{__('Sender Email')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="sender_address" style="text-transform: uppercase;"><strong>{{__('Sender Address')}}&nbsp;</strong></label>
                                            <textarea class="form-control  form-control-lg" rows="1" name="sender_address" placeholder="{{__('Sender Address')}}">{{ Auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					@if (Auth::user()->type != "Staff")
                    <div class="col-lg-6">
					@else
                    <div class="col-lg">
					@endif
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="mb-2 text-uppercase">{{__('Receiver Info')}}<hr></h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="receiver_name" style="text-transform: uppercase;"><strong>{{__('Receiver Name')}}&nbsp;<span class="mark">*</span></strong></label>
                                            <input class="form-control form-control-lg mb-3" type="text" id="receiver_name" name="receiver_name" value="{{ old('receiver_name') }}" placeholder="{{__('Receiver Name')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="price_id" style="text-transform: uppercase;"><strong>City&nbsp;<span class="mark">*</span></strong></label>
                                            <select class="form-control form-control-lg" name="price_id" id="price_id" onchange="currier_quantity()">
												<option value="" >{{__('Choose City')}}</option>
                                                @foreach($priceList as $price)
                                                <option value="{{ $price->id }}" {{ old('price_id')==$price->id ? 'selected' : '' }}>{{ $price->city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="receiver_phone" style="text-transform: uppercase;"><strong>{{__('Receiver Phone')}}&nbsp;<span class="mark">*</span></strong></label>
                                            <input class="form-control form-control-lg mb-3" type="text" id="receiver_phone" name="receiver_phone" value="{{ old('receiver_phone') }}" placeholder="{{__('Receiver Phone')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="receiver_email" style="text-transform: uppercase;"><strong>{{__('Receiver Email')}}</strong></label>
                                            <input class="form-control form-control-lg mb-3" type="text" name="receiver_email" value="{{ old('receiver_email') }}" placeholder="{{__('Receiver Email')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="receiver_address" style="text-transform: uppercase;"><strong>{{__('Receiver Address')}}&nbsp;</strong></label>
                                            <textarea class="form-control  form-control-lg" rows="1" name="receiver_address" placeholder="{{__('Receiver Address')}}">{{ old('receiver_address') }}</textarea>
                                        </div>
                                    </div>
									
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="receiver_branch_id" style="text-transform: uppercase;"><strong>{{__('Receiver Branch')}}&nbsp;<span class="mark">*</span></strong></label>
                                            <select class="form-control form-control-lg" name="receiver_branch_id" id="receiver_branch_id">
                                                @foreach($branchList as $branch)
                                                <option value="{{ $branch->id }}" {{ old('receiver_branch_id')==$branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="mb-2 text-uppercase">{{__('Courier Details')}}<hr></h3>
                                <div id="currierDetailsRow" class="currierDetailsRow">
                                    <div class="RowDiv_0">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="currier_type" class="text-uppercase"><strong>{{__('Courier Type')}}&nbsp;<span class="mark">*</span></strong></label>
                                                    <select class="form-control form-control-lg currier_type requiredSK" name="currier_type[]" id="courier_type_0" onchange="currier_type(0)">
                                                        <option value="">{{__('Choose Type')}}</option>
                                                        @foreach($courierTypeList as $courierType)
                                                        <option value="{{ $courierType->id }}" data-price="{{ $courierType->price }}" data-currency="{{ $gs->base_currency }}" data-unit="{{ $courierType->unit->name }}" >{{ $courierType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="currier_quantity" class="text-uppercase"><strong>{{__('Quantity')}}&nbsp;<span class="mark">*</span></strong></label>
                                                <div class="input-group input-group-lg">
                                                    <input class="form-control currier_quantity_0 currier_quantity requiredSK" max="300" type="number" name="currier_quantity[]" disabled   placeholder="Quantity">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="unit_0"><i class="fas fa-balance-scale"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row no-gutters">
                                                    <div class="col-lg-7">
                                                        <div class="form-group">
                                                            <label for="currier_fee" class="text-uppercase"><strong>{{__('Courier fee')}}&nbsp;<span class="mark">*</span></strong></label>
                                                            <input class="form-control form-control-lg mb-3 currier_fee_0 currier_fee" max="300" type="text" readonly=""  name="currier_fee[]" placeholder="{{__('Courier Fee')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <button type="button" id="btnAddNewRow" name="btnAddNewRow" class="btn btn-primary float-right"><i class="fa fa-plus"></i>{{__('Add New')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{__('Create New Courier')}}</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
@section('script')

<script type="text/javascript">
    $("#price_id").select2({
        theme: "bootstrap"
    });
    $("#home").addClass("active");
    $("#siddebar").addClass("toggled");
    $("form").submit(function (e) {
        if ($('#sender_name').val() == '') {
            e.preventDefault();
            toastr.error("The sender name field is required");
        }
        if ($('#sender_phone').val() == '') {
            e.preventDefault();
            toastr.error("The sender phone field is required");
        }
        if ($('#receiver_name').val() == '') {
            e.preventDefault();
            toastr.error("The receiver name field is required");
        }
        if ($('#receiver_phone').val() == '') {
            e.preventDefault();
            toastr.error("The receiver phone field is required");
        }
        $(".currier_type").each(function () {
            if ($(this).val() === '') {
                toastr.error("The currier type field is required");
            }
        });
        $(".currier_quantity").each(function () {
            if ($(this).val() === '') {
                toastr.error("The currier quantity field is required");
            }
        });

    });
    function currier_type(id) {
        $(".currier_quantity_" + id).val('');
        //$(".currier_fee_" + id).val('');
		currier_quantity();
        $("#rate_" + id).html('');
        let
        unit = $("#courier_type_" + id).find(':selected').data('unit');
        let
        price = $("#courier_type_" + id).find(':selected').data('price');
        let
        currency = $("#courier_type_" + id).find(':selected').data('currency');
        $("#unit_" + id).html(unit);
        $("#rate_" + id).html(`&nbsp; [ 1 ${unit} = ${price} ${currency}]`);
                if ($('#courier_type_' + id).val() == '') {
            $(".currier_quantity_" + id).attr("disabled", true);
            //$("#rate_" + id).html('');
            //$("#unit_" + id).html('<i class="fas fa-balance-scale"></i>');
        }
        if ($('#courier_type_' + id).val()) {
            $(".currier_quantity_" + id).removeAttr("disabled");
        }
    }
    function currier_quantity() {
		//cityvalue = cityid.value;
		var cityvalue = $('#price_id').val()
		<?php $jscities = json_encode($priceList); ?>
		var jscities = <?=$jscities?>;
		var cityinfo = $.grep(jscities, function(e){ return e.id === parseInt(cityvalue)});
		var price = cityinfo[0].price;
		/*for (var i = 0; i < jscities.length; i++) {
			if (jscities[i].id === parseInt(cityvalue)) {
			  price = jscities[i].price;
			}
			console.log(jscities[i].id);
		  }*/
		//console.log(jscities);
		console.log(price+" "+cityvalue);
		var id = 0;
        $(".currier_fee").val(price);
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {

        var id = 0;
        $("#btnAddNewRow").click(function () {
            var flag = 0;
            $(".currier_type").each(function () {
                if ($(this).val() === '') {
                    flag++;
                    $(this).addClass("is-invalid");
                    toastr.error("Currier type is required");
                }
            });
            $(".currier_quantity").each(function () {
                if ($(this).val() === '') {
                    flag++;
                    $(this).addClass("is-invalid");
                    toastr.error("Currier quantity is required");
                }
            });

            var fieldHTML = '';
            if (flag === 0) {
                id++;
                fieldHTML += '<div id="element_' + id + '">';
                fieldHTML += '<div class="clearfix"></div>';
                fieldHTML += '<div class="RowDiv_' + id + '">';
                fieldHTML += '<div class="row">';
                fieldHTML += '<div class="col-lg-3">';
                fieldHTML += '<div class="form-group">';
                fieldHTML += '<select class="form-control form-control-lg requiredSK currier_type" name="currier_type[]" id="courier_type_' + id + '" onchange="currier_type(' + id + ')">';
                fieldHTML += '<option value="">Choose Type</option>';
                fieldHTML += '@foreach($courierTypeList as $courierType)';
                fieldHTML += '<option value="{{ $courierType->id }}" data-price="{{ $courierType->price }}" data-currency="{{ $gs->base_currency }}" data-unit="{{ $courierType->unit->name }}" >{{ $courierType->name }}</option>';
                fieldHTML += '@endforeach';
                fieldHTML += '</select>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-lg-3">';
                fieldHTML += '<div class="input-group input-group-lg">';
                fieldHTML += '<input class="form-control currier_quantity_' + id + ' currier_quantity requiredSK" type="number" name="currier_quantity[]" disabled onchange="currier_quantity(' + id + ')" onkeyup="currier_quantity(' + id + ')" placeholder="Quantity">';
                fieldHTML += '<div class="input-group-prepend">';
                fieldHTML += '<span class="input-group-text" id="unit_' + id + '"></span>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-lg-6">';
                fieldHTML += '<div class="row no-gutters">';
                fieldHTML += '<div class="col-lg-7">';
                fieldHTML += '<div class="form-group">';
                fieldHTML += '<input class="form-control form-control-lg mb-3 currier_fee_' + id + ' currier_fee" type="text" readonly=""  name="currier_fee[]" placeholder="Currier Fee">';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-lg-3 pt-2">';
                fieldHTML += '<div id="rate_' + id + '" class="text-info font-weight-bold" style="font-size:14px;">&nbsp;</div>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-lg-1">';
                fieldHTML += '<a href="javascript:void(0)" onclick="removeElement(' + id + ')"><span id="remove_' + id + '"><i class="far fa-times-circle fa-2x" style="color:red; border-radius:50%; margin-left:5px; margin-top: 5px;"></i></span></a>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                $("#currierDetailsRow").append(fieldHTML);
            }
        });
    });
    function removeElement(id) {
        var set_id = "#element_" + id;
        if (id > 0) {
            $(set_id).remove();
        }
    }
    $(document).on("keyup change focusout", ".requiredSK", function () {
        if ($(this).val() == '') {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
</script>
@endsection