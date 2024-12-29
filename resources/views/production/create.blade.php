@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('productions.store') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Production</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select name="productID" id="product" class="selectize">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" required class="form-control" step="any" id="qty">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" required class="form-control" value="{{date("Y-m-d")}}" id="date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="warehouse">Warehouse</label>
                                    <select name="warehouseID" id="warehouse" class="form-control">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <input type="number" name="cost" value="0" required class="form-control" id="expense">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account">Account</label>
                                    <select name="accountID" id="account" class="form-control">
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->title }}</option>
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="producingproduct">Producing Product</label>
                            <select name="producingproduct" id="producingproduct" class="selectize">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table w-100">
                            <thead>
                                <th>Product Name</th>
                                <th class="text-center">Quantity</th>
                                <th></th>
                            </thead>
                            <tbody id="productions">

                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary w-100">Save</button>
                    </div>

            </form>
        </div>

    </div>
    </div>
    <!-- Default Modals -->


@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".selectize").selectize({
        });

        $("#producingproduct").change(function () {
            var productID = $(this).val();
            var productname = $(this).text();
            addProduction(productID, productname);

        });
        var existingProducts = [];
        function addProduction(id, name)
        {

            let found = $.grep(existingProducts, function(element) {
                        return element === id;
            });
            if(found.length < 1)
            {
                existingProducts.push(id);
                $("#productions").append(`
                    <tr id="row_${id}">
                        <td>${name}</td>
                        <td><input type="number" step="any" name="quantity[]" min="0.1" class="form-control text-center"></td>
                        <td><button type="button" onclick="removeProduction(${id})" class="btn btn-danger">X</button></td>
                        <input type="hidden" name="ids[]" value="${id}">
                    </tr>
                `);
            }
        }

        function removeProduction(id)
        {
            $(`#row_${id}`).remove();
            existingProducts = existingProducts.filter(function(value, index, arr){
                return value != id;
            });
        }

    </script>
@endsection
