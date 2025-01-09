@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                               {{--  <a href="{{url('sales/pdf/')}}/{{$sale->id}}" class="btn btn-info ml-4"><i class="ri-file-line mr-4"></i> Generate PDF</a>
                                <a href="https://web.whatsapp.com/" target="_blank" class="btn btn-success ml-4"><i class="ri-whatsapp-line mr-4"></i> Whatsapp</a> --}}
                                <a href="javascript:window.print()" class="btn btn-primary ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>

                                <div class="card-header">
                                   <h1 class="text-center mb-0">K&S GLOBAL TRADERS</h1>
                                   <h2 class="text-center">RICE EXPORTS</h2>
                                   <h4 class="text-center">COMMERIAL INVOICE - CUM PACKING LIST</h4>
                                </div>

                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12 ">
                            <div class="card-body p-4 pb-0 pt-0">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Seller </p>
                                        <h5 class="fs-16 mb-0"><strong>K&S Global Traders</strong></h5>
                                        <h5 class="fs-14 mb-0">Address: <strong>Shop# 27 2nd Floor Khan Tower Mocongy Roard, Quetta, Pakistan</strong></h5>
                                        <h5 class="fs-14 mb-0">Contact: <strong>+92 313 0000183 </strong></h5>
                                        <h5 class="fs-14 mb-0">Email: <strong> NAVEDJAN1996@GMAIL.COM</strong></h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Consignee </p>
                                        <h5 class="fs-16 mb-0"><strong>{{$invoice->customer->title}}</strong></h5>
                                        <h5 class="fs-14 mb-0">Address: <strong>{{$invoice->customer->address}}</strong></h5>
                                        <h5 class="fs-14 mb-0">Contact: <strong>{{$invoice->customer->contact}}</strong></h5>
                                        <h5 class="fs-14 mb-0">Vat: <strong>{{$invoice->customer->vat}}</strong></h5>
                                        <h5 class="fs-14 mb-0">Email: <strong> {{$invoice->customer->email}}</strong></h5>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4 pb-0">
                                <div class="row g-3">
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">PI No.</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-no">{{$invoice->pi}}</span></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-date">{{date('d M Y', strtotime($invoice->date))}}</span></h5>
                                        
                                    </div>
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Valid Till</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-date">{{date('d M Y', strtotime($invoice->valid))}}</span></h5>
                                        
                                    </div>
                                    <!--end col-->
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">FI No.</p>
                                        @php
                                            $fis = explode(',', $invoice->fi);
                                        @endphp
                                        @foreach ($fis as $fi)
                                            <h5 class="fs-11 m-0 p-0" id="invoice-date">{{$fi}}</h5>
                                        @endforeach
                                        
                                    </div>
                                    <!--end col-->
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Term</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{$invoice->payment_term}}</span></h5>
                                    </div>
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Delivery Term</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{$invoice->delivery_term}}</span></h5>
                                    </div>
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Port of Loading</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{$invoice->loading_port}}</span></h5>
                                    </div>
                                    <div class="col-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Port of Discharge</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{$invoice->discharge_port}}</span></h5>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4 pb-0" >
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Product Details:</h6>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" class="text-start">Product</th>
                                                <th scope="col" class="text-end">Master PP Bags</th>
                                                <th scope="col" class="text-end">M. Ton</th>
                                                <th scope="col" class="text-end">Price per Ton</th>
                                                <th scope="col" class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <tr class="border-1 border-dark">
                                                <td class="text-start m-1 p-1 border-1 border-dark">{{$invoice->product->name}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($invoice->qty / 20 * 1000, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($invoice->qty, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($invoice->price, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($invoice->amount, 2)}}</td>
                                               </tr>
                                               <tr>
                                                <td colspan="5" class="text-center m-1 p-1 border-1 border-dark ">{{numberToWords($invoice->amount, 0)}} Only</td>
                                               </tr>
                                        </tbody>
                                       
                                    </table><!--end table-->
                                </div>
                               
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4 pb-0">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Container Wise Packing Details</h6>
                                <p class="p-0 m-0">Net Weight Each Master PP Bags {{$invoice->pp_net}} Kgs</p>
                                <p class="p-0 m-0">Gross Weight Each Master PP Bags {{$invoice->pp_gross}} Kgs</p>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" class="text-end">Bag Qty</th>
                                                <th scope="col" class="text-end">Bag Weight</th>
                                                <th scope="col" class="text-end">Bags in Master PP</th>
                                                <th scope="col" class="text-end">Total Master PP Qty</th>
                                                <th scope="col" class="text-end">Gross Weight</th>
                                                <th scope="col" class="text-end">Net Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalqty = 0;
                                                $totalpp = 0;
                                                $totalgross = 0;
                                                $totalnet = 0;
                                            @endphp
                                            @foreach($containers as $container => $details)
                                            <tr class="border-1 border-dark p-0">
                                                    <!-- Display product name once -->
                                                    <th colspan="5" class="text-start p-0">{{ $container }}</th>
                                            </tr>
                                                    @foreach($details as $index => $detail)
                                                    <tr class="border-1 border-dark p-0">
                                                        <td class="text-end m-1 p-0 border-1 border-dark">{{number_format($detail->qty, 2)}}</td>
                                                        <td class="text-end m-1 p-0 border-1 border-dark">{{number_format($detail->size, 2)}} Kgs</td>
                                                        <td class="text-end m-1 p-0 border-1 border-dark">{{number_format($detail->packs_pp, 2)}}</td>
                                                        <td class="text-end m-1 p-0 border-1 border-dark">{{number_format($detail->totalpp, 2)}}</td>
                                                        <td class="text-end m-1 p-0 border-1 border-dark">{{number_format($detail->gross, 2)}} Kgs</td>
                                                        <td class="text-end m-1 p-0 border-1 border-dark">{{number_format($detail->net, 2)}} Kgs</td>
                                                    </tr>
                                                    @endforeach
                                                    @php
                                                        $totalqty += $details->sum('qty');
                                                        $totalpp += $details->sum('totalpp');
                                                        $totalgross += $details->sum('gross');
                                                        $totalnet += $details->sum('net');
                                                    @endphp
                                                    <tr class="border-1 border-dark p-0">
                                                        <th class="text-end m-1 p-0 border-1 border-dark">{{number_format($details->sum('qty'), 2)}}</th>
                                                        <th class="text-end m-1 p-0 border-1 border-dark"></th>
                                                        <th class="text-end m-1 p-0 border-1 border-dark"></th>
                                                        <th class="text-end m-1 p-0 border-1 border-dark">{{number_format($details->sum('totalpp'), 2)}}</th>
                                                        <th class="text-end m-1 p-0 border-1 border-dark">{{number_format($details->sum('gross'), 2)}} Kgs</th>
                                                        <th class="text-end m-1 p-0 border-1 border-dark">{{number_format($details->sum('net'), 2)}} Kgs</th>
                                                    </tr>
                                            @endforeach
                                            <tr class="border-1 border-dark p-0">
                                                <th class="text-end m-1 p-1 border-2 border-dark">{{number_format($totalqty, 2)}}</th>
                                                <th class="text-end m-1 p-1 border-2 border-dark"></th>
                                                <th class="text-end m-1 p-1 border-2 border-dark"></th>
                                                <th class="text-end m-1 p-1 border-2 border-dark">{{number_format($totalpp, 2)}}</th>
                                                <th class="text-end m-1 p-1 border-2 border-dark">{{number_format($totalgross, 2)}} Kgs</th>
                                                <th class="text-end m-1 p-1 border-2 border-dark">{{number_format($totalnet, 2)}} Kgs</th>
                                            </tr>
                                        </tbody>
                                       
                                    </table><!--end table-->
                                </div>
                               
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                            
                                <div class="mt-3">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Beneficiary Bank Details:</h6>
                                    <p class="text-muted mb-1">Title: <span class="fw-medium" id="payment-method">M/S K&S GLOBAL TRADERS</span></p>
                                    <p class="text-muted mb-1">Bank: <span class="fw-medium" id="card-holder-name">SONERI BANK LIMITED</span></p>
                                    <p class="text-muted mb-1">Account: <span class="fw-medium" id="card-number">0004-20013644145</span></p>
                                    <p class="text-muted mb-1">IBAN No: <span class="fw-medium" id="card-number">PK51SONE0000420013644145</span></p>
                                    <p class="text-muted mb-1">Swift Code:  <span class="fw-medium" id="card-number">SONEPKKAǪTA</span></p>
                                    <p class="text-muted mb-1">Branch Address:  <span class="fw-medium" id="card-number">MAIN BRANCH 0004 JINNAH ROAD ǪUETTA PAKISTAN</span></p>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->

                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
<link href='https://fonts.googleapis.com/css?family=Noto Nastaliq Urdu' rel='stylesheet'>
<style>
    .urdu {
        font-family: 'Noto Nastaliq Urdu';font-size: 12px;
    }
    </style>
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection

