 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <base href="./">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <meta name="description" content="Laravel core ui">
            <meta name="author" content="Sazzad Bin Ashique">
            <meta name="keyword" content="">
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>PMS</title>
            <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/coreui/assets/favicon/favicon-16x16.png')}}">
            <link rel="manifest" href="assets/favicon/manifest.json">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="{{asset('admin/coreui/assets/favicon/ms-icon-144x144.png')}}">
            <meta name="theme-color" content="#ffffff">
            <!-- Vendors styles-->
            <link rel="stylesheet" href="{{asset('admin/coreui/css/vendors/simplebar.css')}}">
            <link href="{{asset('admin/coreui/css/examples.css')}}" rel="stylesheet">
            <!-- We use those styles to show code examples, you should remove them in your application.-->
            <link rel="stylesheet" href="{{asset('admin/coreui/css/vendors/prism.css')}}">
            <!-- Main styles for this application-->
            <link href="{{asset('admin/coreui/css/style.css')}}" rel="stylesheet">
            <link href="{{asset('admin/coreui/css/coreui-chartjs.css')}}" rel="stylesheet">
            <link rel="stylesheet" href="{{asset('admin/coreui/css/fonts/all.min.css')}}" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            
            @yield('third_party_stylesheets')
        </head>

        <body>
            @include('partials.sidebar')
            <div class="wrapper d-flex flex-column min-vh-100 bg-light">
                @include('partials.header')
                <div class="body flex-grow-1 ">
                    @yield('content')
                </div>
                @include('partials.footer')
            </div>
            <div id='loader'></div>

            <script src="{{asset('admin/coreui/js/coreui.bundle.min.js')}}"></script>
            <!-- Option 2: Separate Popper and CoreUI for Bootstrap JS -->
            <!--
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
            <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/js/coreui.min.js" ></script>
            -->
            <!-- We use those scripts to show code examples, you should remove them in your application.-->
            <script src="{{asset('admin/coreui/js/prism.js')}}"></script>
            <script src="{{asset('admin/coreui/js/prism-autoloader.min.js')}}"></script>
            <script src="{{asset('admin/coreui/js/prism-unescaped-markup.min.js')}}"></script>
            <script src="{{asset('admin/coreui/js/prism-normalize-whitespace.js')}}"></script>
            <!-- Plugins and scripts required by this view-->
            <script type="text/javascript" src="{{asset('admin/coreui/js/loader.js')}}"></script>

            <script src="{{asset('admin/coreui/js/jquery-3.5.1.min.js')}}"></script>
            <script src="{{asset('admin/coreui/js/moment.min.js')}}"></script>
            <script src="{{asset('admin/coreui/js/chart.min.js')}}"></script>
            <script src="{{asset('admin/coreui/js/coreui-chartjs.js')}}"></script>
            <script src="{{asset('admin/coreui/js/coreui-utils.js')}}"></script>
            <script src="{{asset('admin/coreui/js/charts.js')}}"></script>
            <script src="{{asset('admin/coreui/js/main.js')}}"></script>

            @yield('third_party_scripts')
        </body>

        <script>
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            let data_array = [];
            let data_medicine=[];
            let data_product_id=[];
            let data_quantity=[];
            let data_purchase_price=[];
            let data_price_id=[];
            let data_sales_prcie=[];
            let data_discount_rate=[];
            let data_total_price=[];
            $('.grand_final').hide();

            function getPrice()
            {

                var product_id = $("#medicine_name").val();
                //alert(product_id);
                $.ajax({
                    type:'POST',
                    url:"{{ route('sales.price') }}",
                    data:{product_id:product_id, _token: '{{csrf_token()}}'},
                    success:function(data){            
                        $('#product_id').val(data.product_id);
                        $('#price_id').val(data.id); 
                        $('#purchase_price').val(data.purchase_price);     
                        $('#sales_price').val(data.sales_price);
                        $('#discount_rate').val(data.discount_rate);                      
                    }
                });
            }

            let grand_total=0, total_discount=0, sub_total=0;
            function addMedicine()
            {
                $('.grand_final').show();
                var medicine_name =  $("#medicine_name option:selected").text();
                var product_id = $("#product_id").val();
                var price_id = $("#price_id").val();
                var quantity = $("#quantity").val();
                var purchase_price = $("#purchase_price").val();
                var sales_price = $("#sales_price").val();
                var discount_rate = $("#discount_rate").val();
                var total_price =quantity*sales_price;
                var total_dis =quantity*discount_rate;
                grand_total = grand_total+parseFloat(total_price);
                total_discount = total_discount+parseFloat(total_dis);
                sub_total = parseFloat(grand_total) - parseFloat(total_discount);
                //var vat = parseFloat ((grand_total*10)/100);
                //var grand_total_with_vat = grand_total + vat;
                $("#mytable tbody").append("<tr class='rowtotal'><td class='medicine' >" + medicine_name + "</td><td class='quantity'>" + quantity + "</td> <td class='sales_prcie'>" + sales_price + "</td><td class='total_price'>" + total_price + "</td><td class='discount_rate'>" + discount_rate + "</td><td class='product_id' style='display: none;'>" + product_id + "</td><td class='price_id' style='display: none;'>" + price_id + "</td><td class='purchase_price' style='display: none;'>" + purchase_price +"</td><td><button class='btn-success'>Remove</button></td></tr>");
                $("#medicine_name").val('');
                $("#product_id").val('');
                $("#price_id").val('');
                $("#quantity").val('');
                $("#purchase_price").val('');
                $("#sales_price").val('');
                $("#discount_rate").val('');
                $("#total_sales_amount").val(grand_total);
                $("#total_discount_amnt").val(total_discount);
                $('#grand').html('Total Amount : '+grand_total+' Tk')
                $('#total_discount').html('Discount : '+total_discount+' Tk')
                $('#sub_total').html('Total Payable : '+sub_total+' Tk')


                // console.log(grand_total);
            }

            // Remove Product //
            $("#mytable").on('click', '.btn-success', function () {
                $('.grand_final').show();
                let c_price = $(this).closest('tr').find("td:eq(3)").text();
                let c_quantity = $(this).closest('tr').find("td:eq(1)").text();
                let c_discount_rate = $(this).closest('tr').find("td:eq(4)").text();
                if(c_discount_rate==''){c_discount_rate=0;}
                //  console.log('before'+grand_total);
                //  console.log(parseFloat(c_price));
                 grand_total= parseFloat(grand_total)-parseFloat(c_price);
                 total_discount= parseFloat(total_discount)-(parseFloat(c_quantity)*parseFloat(c_discount_rate));
                 sub_total = parseFloat(grand_total) - parseFloat(total_discount);
                 //var vat = parseFloat ((grand_total*10)/100);
                 //var grand_total_with_vat = grand_total + vat;
                 //grand_total= parseFloat (grand_total+(grand_total*10/100));
                //  console.log('after'+grand_total);
                 $(this).closest('tr.rowtotal').remove();
                 $("#total_sales_amount").val(grand_total);
                 $("#total_discount_amnt").val(total_discount);
                 $('#grand').html('Total Amount : '+grand_total+' Tk');
                 $('#total_discount').html('Discount : '+total_discount+' Tk');
                 $('#sub_total').html('Total Payable : '+sub_total+' Tk')

                });

            function getPay()
            {
                let my_object = {};
                $('#mytable tbody tr').each(function(index) {
                    let medicine = $(this).find(".medicine").html();
                    let product_id = $(this).find(".product_id").html();
                    let price_id = $(this).find(".price_id").html();
                    let quantity = $(this).find(".quantity").html();
                    let purchase_price = $(this).find(".purchase_price").html();
                    let sales_prcie = $(this).find(".sales_prcie").html();
                    let discount_rate = $(this).find(".discount_rate").html();
                    let total_price = $(this).find(".total_price").html();

                    //console.log(my_object);
                    // data_array.push(medicine,quantity,sales_prcie,total_price);
                    // console.log(data_array);

                    data_medicine.push(medicine);
                    data_product_id.push(product_id);
                    data_price_id.push(price_id);
                    data_quantity.push(quantity);
                    data_purchase_price.push(purchase_price);
                    data_sales_prcie.push(sales_prcie);
                    data_discount_rate.push(discount_rate);
                    data_total_price.push(total_price);

                    // console.log(data_medicine);
                    // console.log(data_quantity);
                    // console.log(data_sales_prcie);
                    // console.log(data_total_price);
                     let customer_name = $('#customer_name').val();
                     let customer_mobile = $('#customer_mobile').val();
                     let doctor_name = $('#doctor_name').val();
                     let total_sales_amount = $('#total_sales_amount').val();
                     let total_discount_amnt = $('#total_discount_amnt').val();


                });
                let customer_name = $('#customer_name').val();
                let customer_mobile = $('#customer_mobile').val();
                let doctor_name = $('#doctor_name').val();
                let total_sales_amount = $('#total_sales_amount').val();
                let total_discount_amnt = $('#total_discount_amnt').val();

                $.ajax({
                    type:'POST',
                    url:"{{ route('order.store')}}",
                    data:{
                        data_medicine:data_medicine,
                        data_product_id:data_product_id,
                        data_price_id:data_price_id,
                        data_quantity:data_quantity,
                        data_purchase_price:data_purchase_price,
                        data_sales_prcie:data_sales_prcie,
                        data_discount_rate:data_discount_rate,
                        data_total_price:data_total_price,
                        customer_name:customer_name,
                        customer_mobile:customer_mobile,
                        doctor_name:doctor_name,
                        total_sales_amount:total_sales_amount,
                        total_discount_amnt:total_discount_amnt,
                         _token: '{{csrf_token()}}'
                        },
                    success:function(data){
                        window.location.replace("{{url('/sales')}}/" + data.sales_id+`?message=${data.message}"`);
                    },
                    error:function(data){
                      console.log(data)
                    }
                });
                // let i=0;
                // var total=0;
                // //alert(data_total_price.length)
                //     for(i=0;i<data_total_price.length;i++)
                //     {

                //        total =total + parseFloat(data_total_price[i]);
                //     }

                //     console.log(total)
                // var temp = 0;
                // $('td').each(function(){

                // var tdTxt = $(this).text();
                //     if($(this).hasClass('total_price')) {
                //         $(this).text(temp);
                //         temp = 0;
                //     } else {
                //     temp+= parseFloat(tdTxt);
                //     }

                // });


              }



                //console.log(tdTxt)

        </script>



</html>











{{-- 
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
--}}
