<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            main {
                display: flex;
                justify-content: center;
            }

            tr:nth-child(odd) {
                background-color: #eee;
            }

            th {
                background-color: #555;
                color: #fff;
            }

            th,
            td {
                text-align: left;
                padding: 0.5em 1em;
            }
            .add_milking{
                background-color: #fff;
                cursor: pointer;
            }
            .milking_form {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/cows') }}">cows</a>
                        <a href="{{ url('/best_cows') }}">Best cows</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                            
                    @endauth
                    @if (Route::has('/cows'))
                            <a href="{{ route('/cows') }}">Our cows</a>
                        @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Cows
                </div>
                
                <main>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Breed</th>
                            <th>Age</th>
                        </tr>
                        @foreach ($cows as $cow)
                            <tr>
                                <td>{{ $cow->name }}</td>
                                <td>{{ $cow->breed }}</td>
                                <td>{{ $cow->age }}</td>
                                <td class="add_milking" id="milking_form_{{ $cow->id }}">Add milking</td>
                            </tr>
                            <tr class="milking_form milking_form_{{ $cow->id }}">
                                <td colspan="3">
                                <form>
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            Please fix the following errors
                                        </div>
                                    @endif

                                    {!! csrf_field() !!}
                                    <div class="form-group{{ $errors->has('milk_volume') ? ' has-error' : '' }}">
                                        <input type="text" class="form-control" id="milk_volume_{{ $cow->id }}" milk_volume="milk_volume" placeholder="Milk Volume" value="{{ old('milk_volume') }}">
                                        @if($errors->has('milk_volume'))
                                            <span class="help-block">{{ $errors->first('milk_volume') }}</span>
                                        @endif
                                        <button type="submit" cow_id="{{ $cow->id }}" class="btn btn-default btn-submit">Add</button>
                                    </div>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </main>
            </div>
        </div>
        <script type="text/javascript">
            $('.add_milking').click(function(e) {
                var form_id = $(this).attr('id');
                $('.'+form_id).show();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".btn-submit").click(function(e){
                e.preventDefault();
                var cow_id = $(this).attr('cow_id');
                var milk_volume = $("#milk_volume_"+cow_id).val();
                $.ajax({
                    type:'POST',
                    url:'/addDailyMilking',
                    data:{
                        milk_volume: milk_volume,
                        cow_id: cow_id
                    },
                    success: function( response ) {
                        $('.milking_form_'+cow_id).hide();
                    }
                });
            });
        </script>
    </body>
</html>
