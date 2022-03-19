<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whats App</title>
</head>
<body>

<!-- $value = '<img src="{{asset('images/tahir-logo.png')}}" alt='img' />'; -->
<!-- $image = '{{asset("images/tahir-logo.png")}}';
<img src= "<? //echo $image; ?>" alt="test"/> -->

<!-- <a href="https://api.whatsapp.com/send?phone=+923089224094&text=hi&source=&data=&attachment=c://users/downloads/invoice.pdf">Click me</a> -->

<?php $test = "hello world"; ?>

<a href="https://api.whatsapp.com/send?phone=+923089224094&text=<?php echo $test ?>&source=&data=&attachment=c://users/downloads/invoice.pdf">Click me</a>

    
</body>
</html>