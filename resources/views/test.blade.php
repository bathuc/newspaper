<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Title</title>
    {!! Html::style('front/css/bootstrap.min.css') !!}
    {!! Html::style('front/css/style.css') !!}

    {!! Html::script('front/js/jquery.min.js') !!}
    {!! Html::script('front/js/jquery.validate.js') !!}
    {!! Html::script('front/js/popper.min.js') !!}
    {!! Html::script('front/js/bootstrap.min.js') !!}
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="pt-5"></div>
    <div class="articles">
        <div class="article d-flex justify-content-between">
            <div class="image-wrapper">
                <img src="/imgs/4.jpg" alt="" width="300px">
            </div>
            <div class="new-wrapper">
                <a href="#" class="title">Hé lộ gia thế khủng của chồng Tây siêu mẫu Phương Mai: Giám đốc tập đoàn tư vấn tài chính nổi tiếng, điển trai, sống xa hoa</a>
                <p class="category">Star - 1 giờ trước</p>
                <p class="description">Ít ai biết, chồng sắp cưới người ngoại quốc của siêu mẫu Phương Mai lại là doanh nhân có tiếng trong giới kinh doanh, gia thế khủng không kém cạnh bất kỳ đại gia nào.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .article{
        width: 800px;
    }
    .image-wrapper{
        margin-right: 20px;
    }
    a.title{
        font-size: 20px;
        line-height: 5px;
        color:black;
        font-weight: bold;
        text-decoration: none;
        margin-bottom: 10px;
    }
    p.category{
        margin-top:10px;
        margin-bottom: 10px;
        font-weight: bold;
    }
</style>
</body>
</html>
