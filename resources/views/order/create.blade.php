@extends('layouts.header')
@section('layout')
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Booking</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="nm">Customer</label>
                            <input list="customers" class="form-control" id="customer_nm" onkeyup="addCustomers(this.value)"
                                onblur="addData(this.value)">
                            <datalist id="customers" onclick="alert('i am selected')">
                            </datalist>
                        </div>
                        <div class="form-group col-md-4">

                            <label for="address">Address</label>
                            <textarea type="text" class="form-control" name="address" id="address" readonly></textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 ">
                            <h4 class="bg-primary rounded p-2 text-light">Past Orders</h4>
                        </div>
                    </div>
                    <div class="row" id="past_order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Serial NO.</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 ">
                            <h4 class="bg-primary rounded p-2 text-light">New Orders</h4>
                        </div>
                        <table class="table col-12">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Product name</th>
                                    <th>price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="current_order">
                                <tr>
                                    <td>1</td>

                                    <td>
                                        <input type="text" class="form-control" name="product_name[]" list="products"
                                            id="product_name" onblur="setPrice(this)" autocomplete="off">
                                        <datalist id="products">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->name }}" data-id="{{ $product->id }}"
                                                    data-price='{{ $product->price }}'>
                                            @endforeach
                                        </datalist>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control price" readonly>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" name="quantity[]" id="quantity"
                                            onkeyup="calculateTotal(this)">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" id="total_price" readonly>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="addRow()"><i
                                                class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Total price --}}
                    <div class="row">
                        <div class="col-12">
                            <h4 class="bg-primary rounded p-2 text-light">Total Price</h4>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="final_price" readonly>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            function calculateTotal(e) {
                var quantity = e.value;
                var price = e.parentElement.previousElementSibling.children[0].value;
                var total = quantity * price;
                e.parentElement.nextElementSibling.children[0].value = total;
                calculateTotalAmount();
            }

            function calculateTotalAmount() {
                var total = 0;
                var rows = document.getElementById('current_order').children;
                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];
                    var total_price = row.children[4].children[0].value;
                    total += parseFloat(total_price);
                }
                document.getElementById('final_price').value = total;
            }

            function addCustomers(value) {

                index = value.indexOf('(');
                if (index != -1) {
                    value = value.substring(0, index);
                }

                $.ajax({
                    url: '{{ route('customer.search') }}',
                    type: 'GET',
                    data: {
                        'search': value
                    },
                    success: function(data) {
                        let html = "";
                        data.forEach(element => {
                            html += '<option data-value="' + element.id + '" value="' + element.name +
                                ' (' +
                                element.id + ')' +
                                '" />';

                        });
                        $('#customers').html(html);
                    }
                });
            }

            function addData(value) {
                let id = $("#customers option[value='" + value + "']").data('value');
                $.ajax({
                    url: '{{ route('customer.get') }}',
                    type: 'GET',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        console.log(data);
                        $('#address').val(data.address);
                        if (data.orders.length > 0) {
                            let html = "";
                            data.orders.forEach(element => {
                                html += `<tr>
                                    <td>${element.id}</td>
                                    <td>${element.serial_number}</td>
                                    <td>${element.total_quantity}</td>
                                    <td>${element.total_amount}</td>
                                    <td>${element.created_at}</td>
                                </tr>`;
                            });
                            $('#past_order tbody').html(html);
                        } else {
                            $('#past_order tbody').html(
                                '<p class="text-center w-100 text-danger">No past orders<p>');
                        }
                    }
                });
            }

            function setPrice(ele) {
                let price = $("#products option[value='" + ele.value + "']").data('price');
                $(ele).closest('tr').find('.price').val(price);
            }

            function addRow() {
                let row = '<tr>' +
                    '<td>' + ($('#current_order tr').length + 1) + '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control" list="products" name="product_name[]" id="product_name" onblur="setPrice(this)" autocomplete="off">' +
                    '</td>' +
                    `<td>
                                                <input type="text" class="form-control price" readonly>
                                            </td>` +
                    '<td>' +
                    '<input type="text" class="form-control" name="quantity[]" id="quantity" onkeyup="calculateTotal(this)">' +
                    '</td>' +
                    `<td>
                                        <input type="text" class="form-control" id="total_price" readonly>
                                    </td>` +
                    '<td>' +
                    '<button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>';
                $('#current_order').append(row);
            }

            function removeRow(ele) {
                $(ele).closest('tr').remove();
            }

            $(document).ready(function() {
                $('#form').submit(function(e) {
                    e.preventDefault();

                    let customer_id = $("#customers option[value='" + $('#customer_nm').val() + "']").data(
                        'value');
                    let product_ids = [];
                    let quantities = [];

                    $('#current_order tr').each(function(index, element) {
                        let productName = $('#current_order tr:eq(' + index + ') td:eq(1) input').val();
                        product_ids.push($("#products option[value='" + productName + "']")
                            .data('id'));
                        quantities.push($('#current_order tr:eq(' + index + ') td:eq(3) input')
                            .val());
                    });

                    let data = {
                        'customer_id': customer_id,
                        'product_ids': product_ids,
                        'quantities': quantities,
                        '_token': '{{ csrf_token() }}'
                    };
                    console.log(data);
                    $.ajax({
                        url: '{{ route('order.store') }}',
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            if (data == 'success') {
                                alert('Order created successfully');
                                window.location.reload();
                            } else {
                                alert(data);
                            }
                        },
                        error: function(response) {

                        },

                    });

                    $(document).ajaxError(function(event, jqxhr, settings, exception) {
                        var error = jqxhr.responseText;
                        console.log(error)
                    });

                    // $.ajax({
                    //     url: '{{ route('order.create') }}',
                    //     type: 'POST',
                    //     data: $(this).serialize(),
                    //     success: function(data) {
                    //         alert(data.message);
                    //         window.location.reload();
                    //     }
                    // });
                });
            });
        </script>
    @endsection
