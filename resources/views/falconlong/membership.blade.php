<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falcon Membership</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .package-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .package-card:hover {
            transform: scale(1.05);
        }

        .package-card h3 {
            margin: 10px 0;
            font-size: 20px;
        }

        .package-card p {
            color: #777;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #e60000;
        }

        .choose-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #e60000;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .choose-btn:hover {
            background-color: #cc0000;
        }

        /* Responsive Design */
        @media only screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .package-card {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Example of a package -->
    @foreach($packages as $package)
        <div class="package-card">
            <h3>Presale Early Bird - {{ $package->duration }} Months</h3>
            <p>{{ $package->details }}</p>
            <p class="price">IDR {{ number_format($package->price, 0, ',', '.') }}</p>
            @if($package->heart_rate_price)
                <p>+ Rp {{ number_format($package->heart_rate_price, 0, ',', '.') }} for Myzone Heart Rate tracker</p>
            @else
                <p>FREE Myzone Heart Rate tracker</p>
            @endif
            <a href="{{ route('falcon.packages.select', ['package_id' => $package->id]) }}" class="choose-btn">Choose Package</a>
        </div>
    @endforeach
</div>

</body>
</html>
