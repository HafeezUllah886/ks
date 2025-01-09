@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Commercial Invoice </h3></div>
                                <div class="col-6 d-flex flex-row-reverse">
                                    <button onclick="window.close()" class="btn btn-danger">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">

                    <form action="{{ route('invoice.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select name="productID" required class="selectize" id="product">
                                        <option value=""></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="price">Price per Ton</label>
                                    <input type="number" required step="any" oninput="updateTotal()" value="0" name="price" id="price" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="customer">Customer</label>
                                    <select name="customerID" class="selectize" id="customerID">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="account">Account</label>
                                    <select name="accountID" class="selectize" id="accountID">
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 mt-2">
                                <div class="form-group">
                                    <label for="pi">PI No.</label>
                                    <input type="number" name="pi" id="pi" value="1" class="form-control">
                                </div>
                            </div>
                            <div class="col-2 mt-2">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" value="{{date('Y-m-d')}}" id="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-2 mt-2">
                                <div class="form-group">
                                    <label for="valid">Valid Till</label>
                                    <input type="date" name="valid" value="{{date('Y-m-d')}}" id="valid" class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="form-group">
                                    <label for="fi">FI No. (Separate with Comma)</label>
                                    <input type="text" name="fi" id="fi" value="SBL-EXP-322574-26092024, SBL-EXP-332758-26092024, SBL-EXP-117621-27092024" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="delivery_term">Delivery Term</label>
                                    <input type="text" name="delivery_term" id="delivery_term" value="CFR" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="payment_term">Payment Term</label>
                                    <input type="text" name="payment_term" id="payment_term" value="ADVANCE" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="loading_port">Port of Loading</label>
                                    <input type="text" name="loading_port" id="loading_port" value="Karachi" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="discharge_port">Port of Discharge</label>
                                    <input type="text" name="discharge_port" id="discharge_port" value="UK" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="ppgross">PP Bag Gross</label>
                                    <div class="input-group"><input type="number" step="any" value="20" name="ppgross" id="ppgross" class="form-control"><span class="input-group-text">KG</span></div>
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="ppnet">PP Bag Net</label>
                                    <div class="input-group"><input type="number" step="any" value="19.80" name="ppnet" id="ppnet" class="form-control"><span class="input-group-text">KG</span></div>
                                </div>
                            </div>
                            <div class="col-12">

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th width="20%">Container Number</th>
                                        <th class="text-center">Pack Size</th>
                                        <th class="text-center">Packs in PP Bag</th>
                                        <th class="text-center">Pack Qty</th>
                                        <th class="text-center">Gross Weight </th>
                                        <th class="text-center">Net Weight </th>
                                        <th class="text-center">Total PP Bags </th>
                                        <th></th>
                                    </thead>
                                    <tbody id="products_list">
                                        <tr>
                                            <td><input type="text"required name="container[]" class="form-control" id="container_0"></td>
                                            <td><div class="input-group"><input type="number" name="size[]" oninput="updateChanges(0)" class="form-control text-center" id="size_0"><span class="input-group-text">KG</span></div></td>
                                            <td><input type="number" name="packs[]" class="form-control text-center" id="packs_0" readonly></td>
                                            <td><input type="number" name="qty[]" class="form-control text-center" oninput="updateChanges(0)" id="qty_0" value="1"></td>
                                            <td><div class="input-group"><input type="number" name="gross[]" class="form-control text-center" value="0" id="gross_0" readonly><span class="input-group-text">KG</span></td>
                                            <td><div class="input-group"><input type="number" name="net[]" class="form-control text-center" value="0" id="net_0" readonly><span class="input-group-text">KG</span></td>
                                            <td><input type="number" name="pp[]" class="form-control text-center" value="0" id="pp_0" readonly></td>
                                            <td><span class="btn btn-success" onclick="addRow()">+</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-end">Total</th>
                                            <th></th>
                                            <th class="text-end" id="totalQty">0.00</th>
                                            <th class="text-end" id="totalGross">0.00 Kgs</th>
                                            <th class="text-end" id="totalNet">0.00 Kgs</th>
                                            <th class="text-end" id="totalPP">0.00</th>
                                        </tr>
                                        <tr>
                                            <th class="text-end" colspan="6">M. Ton</th>
                                            <th class="text-end" id="mt">0.00</th>
                                        </tr>
                                        <tr>
                                            <th class="text-end" colspan="6">Net Amount</th>
                                            <th class="text-end" id="amount">0.00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Create Invoice</button>
                            </div>
                </div>
            </form>
            </div>

        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->

@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
        .ui-autocomplete {
    font-family: 'Noto Sans', Arial, sans-serif;
}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(".selectize1").selectize();
        $(".selectize").selectize();

      
        var optionCount = 0;
        function addRow() {
            var lastContainerNumber = $('#container_' + (optionCount)).val();
            optionCount += 1;
            var html = `<tr id="row_${optionCount}">
                <td><input type="text" name="container[]" required value="${lastContainerNumber}" class="form-control" id="container_${optionCount}"></td>
                <td><div class="input-group"><input type="number" name="size[]" oninput="updateChanges(${optionCount})" class="form-control text-center" id="size_${optionCount}"><span class="input-group-text">KG</span></div></td>
                <td><input type="number" name="packs[]" class="form-control text-center" id="packs_${optionCount}" readonly></td>
                <td><input type="number" name="qty[]" class="form-control text-center" oninput="updateChanges(${optionCount})" id="qty_${optionCount}" value="1"></td>
                <td><div class="input-group"><input type="number" name="gross[]" value="0" class="form-control text-center" id="gross_${optionCount}" readonly><span class="input-group-text">KG</span></div></td>
                <td><div class="input-group"><input type="number" name="net[]" value="0" class="form-control text-center" id="net_${optionCount}" readonly><span class="input-group-text">KG</span></div></td>
                <td><input type="number" name="pp[]" class="form-control text-center" value="0" id="pp_${optionCount}" readonly></td>
                <td><span class="btn btn-sm btn-danger" onclick="deleteRow(${optionCount})">X</span></td>
            </tr>`;
            $("#products_list").append(html);
        }

        function updateChanges(id) {
            var size = parseFloat($('#size_' + id).val());
            var qty = parseFloat($('#qty_' + id).val());
            var ppgross = parseFloat($('#ppgross').val());
            var ppnet = parseFloat($('#ppnet').val());

            var packs = ppgross / size;
            var ppbags = qty * packs;
            var gross = qty * ppgross;
            var net = qty * ppnet;

            $("#packs_"+id).val(packs.toFixed(2));
            $("#pp_"+id).val(ppbags.toFixed(2));
            $("#gross_"+id).val(gross.toFixed(2));
            $("#net_"+id).val(net.toFixed(2));

            updateTotal();
        }

        function updateTotal() {
            var totalQty = 0;
            $("input[id^='qty_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalQty += parseFloat(inputValue);
            });
            $("#totalQty").html(totalQty.toFixed(2));

            var totalGross = 0;
            $("input[id^='gross_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalGross += parseFloat(inputValue);
            });
            $("#totalGross").html(totalGross.toFixed(2) + " Kgs");

            var totalNet = 0;
            $("input[id^='net_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalNet += parseFloat(inputValue);
            });
            $("#totalNet").html(totalNet.toFixed(2) + " Kgs");

            var totalPP = 0;
            $("input[id^='pp_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalPP += parseFloat(inputValue);
            });
            $("#totalPP").html(totalPP.toFixed(2));

            var mt = totalGross / 1000;

            var price = parseFloat($("#price").val());
            var amount = mt * price;

            $("#mt").html(mt.toFixed(2));
            $("#amount").html(amount.toFixed(2));

        }

        function deleteRow(id) {
            $('#row_'+id).remove();
            updateTotal();
        }
    </script>
@endsection
