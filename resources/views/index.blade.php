<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}">
    <title>Index Page</title>
</head>
<body>
<form class="form">
    @csrf
    <div class="input">
        <label for="state" class="form-label">Номер записи</label>
        <select class="form-select" id="state" required="" style="height: 45px; outline: none" name="record_id">
            <option disabled selected>Выберите запись или создайте новую</option>
            <option value="new">Новая запись</option>
            @foreach($result as $key => $item)
                <option value="{{$key}}">#{{$key}}</option>
            @endforeach
        </select>
    </div>
    <div class="input">
        <label for="text" class="form-label">Текст</label>
        <input type="text" class="form-control" id="text" placeholder="" value="" required="" name="text">
    </div>
    <div class="input">
        <label for="comment" class="form-label">Комментарий</label>
        <input type="text" class="form-control" id="comment" placeholder="" value="" required="" name="comment">
    </div>
    <button class="btn-add" type="submit">Добавить</button>
</form>

<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($result as $key => $record)
            <div class="col">
               <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="text-h1">Запись #{{$key}}</p>
                        @foreach($record as $item)
                            <div class="text">
                                <p class="text-p1 comment" style="color: grey; font-size: 15px">{{$item['comment']}}</p>
                                <p class="text-p1 text">{{$item['text']}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="new-text">
    <p class="text-id" style="font-size: 20px"></p>
    <p class="text-js"></p>
    <p class="text-comment"></p>
</div>
</body>
</html>

<script src="{{asset('js/jquery-v.3.7.0.min.js')}}"></script>
<script>
    $('.form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/added_record',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            async: false,
            dataType: "json",
            success: function (result) {
                $('.new-text').fadeIn().delay(5000).fadeOut();
                $('.text-id').text('Добавлена запись #' + result.record_id)
                $('.text-js').text('Текст: ' + result.text)
                $('.text-comment').text('Комментарий: ' + result.comment)
            }
        });
    })
</script>
