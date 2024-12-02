<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://www.paypal.com/sdk/js?
    client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"></script>
</head>
<body>
    <a href="{{route(processPaypal)}}" class="btn btn-success m-5">Pay 100$</a>
</body>
</html>