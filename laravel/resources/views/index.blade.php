<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Получение кадастровых данных</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content container">
                <div class="col-sm" id="main-form" data-url="{{ url('cadastral') }}">
                    <div id="form-save-alert"></div>
                    <input id="token" name="_token" hidden value="{!! csrf_token() !!}"/>
                    <h2 style="margin-top: 20px;">Получение кадастровых данных</h2>
                    <h5>кадастровые номера</h5>
                    <input type="text" id="cadastral" class="form-control" value="69:27:0000022:1306, 69:27:0000022:1307" aria-label="кадастровые номера">
                    <div style="color: grey;">Введите кадастровые номера через запятую. Например, «69:27:0000022:1306, 69:27:0000022:1307»</div>
                    <button class="btn btn-primary" id="submit" type="button" style="margin-top: 10px;">Получить данные</button>
                    <hr>
                    <div class="spinner-border" id="spinner" role="status" style="display: none;">
                        <span class="sr-only">Загрузка...</span>
                    </div>
                    <div id="cadastrals"></div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('js/cadastral.js') }}"></script>
    </body>
</html>
