@extends('layouts.header')

@section('layout')
    <div class="col-sm-12 ">
        <div class="card">
            <div class="card-body">

                {{-- errors --}}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('inward_entry.store') }}" id="form" class="position-relative" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="product">Type</label>
                            <select class="form-control type" name="from">
                                <option value selected disabled>Select type</option>
                                <option value="from_employee" {{ old('from') == 'from_employee' ? 'selected' : '' }}>
                                    From
                                    Employee</option>
                                <option value="from_company" {{ old('from') == 'from_company' ? 'selected' : '' }}>
                                    From
                                    Company</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('from') }}</span>
                        </div>
                        <div class="form-group col-sm-4 text-right ">

                        </div>
                        <div class="form-group col-sm-4 ">
                            <label for=""> </label>
                            <div class="mt-2 text-right text-sm-left">
                                <button type="button" class="btn btn-primary text-left" id="add-product"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </div>


                    <div id="product-list">
                        @if (old('quantity'))
                            @foreach (old('quantity') as $key => $value)
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="product">Product</label>
                                        <select class="form-control product" name="products[]">
                                            <option value selected disabled>Select product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('products.' . $key) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('product.' . $key) }}</span>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="quantity">Quantity</label>
                                        <input class="form-control quantity" type="number" name="quantity[]"
                                            onkeyup="findTotal()" value="{{ old('quantity.' . $key) }}" />
                                        <span class="text-danger">{{ $errors->first('quantity.' . $key) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="product">Product</label>
                                    <select class="form-control product" name="products[]">
                                        <option value selected disabled>Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('products.*') }}</span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control quantity" name="quantity[]"
                                        onkeyup="findTotal()" />
                                    <span class="text-danger">{{ $errors->first('quantity.*') }}</span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="quantity"></label>
                                    <div>
                                        <button type="button" class="btn btn-danger  text-left remove-product mt-1"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-8">
                        <hr />
                    </div>

                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 ">
                            <div class="border rounded form-control">
                                total : <span class="total">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <hr />
                    </div>

                    <div class="row bill" style="display: none">
                        <div class="form-group col-sm-4">
                            <label for="name">Bill No.</label>
                            <input type='text' class="form-control" name="bill_no" />
                            <span class="text-danger">{{ $errors->first('bill_no') }}</span>

                        </div>
                        <div class="form-group col-sm-4">
                            <label for="name">Bill
                                Amount</label>
                            <input type='text' class="form-control" name="bill_amount" />
                            <span class="text-danger">{{ $errors->first('bill_amount') }}</span>
                        </div>
                    </div>

                    <div class="row employee" style="display: none">
                        <div class="form-group col-sm-4">
                            <label for="name">Employee</label>
                            <select class="form-control employee" name="employee">
                                <option value selected disabled>Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('employee') }}</span>
                        </div>
                    </div>

                    <div class="text-right col-sm-8 mt-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#add-product').click(function() {
                var product = $('#product').val();
                var quantity = $('#quantity').val();
                var product_name = $('#product option:selected').text();

                $('#product-list').append($('#product-list').children().first().clone());
                $('#product-list').children().last().find('.quantity').val('');
                $('#product-list').children().last().find('span').text('');

            });
            $(document).on('click', '.remove-product', function() {
                if ($('#product-list').children().length > 1) {
                    $(this).closest('.row').remove();
                }

            });

            $('.type').change(function() {
                var type = $(this).val();
                if (type == 'from_employee') {
                    $('.bill').hide();
                    $('.employee').show();
                } else {
                    $('.bill').show();
                    $('.employee').hide();
                }

            });

            @if (old('from') == 'from_employee')
                {
                    $('.bill').hide();
                    $('.employee').show();
                }
            @endif
            @if (old('from') == 'from_company')
                {
                    $('.bill').show();
                    $('.employee').hide();
                }
            @endif

        });

        function findTotal() {
            var total = 0;
            $('.quantity').each(function() {
                if ($(this).val() != '') {
                    total += parseInt($(this).val());
                }
            });
            $('.total').text(total);
        }
    </script>
@endsection
