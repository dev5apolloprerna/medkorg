<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Coming Soon | Shree Modasa Ekda Dasha Khadayata</title>

    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Shree Modasa Ekda Dasha Khadayata - Our website is currently under maintenance.">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 183, 77, 0.15), transparent 35%),
                radial-gradient(circle at 80% 80%, rgba(255, 112, 67, 0.12), transparent 35%),
                linear-gradient(135deg, #fffaf3 0%, #fff4e5 50%, #fffaf6 100%);
            color: #4a2c1a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            overflow: hidden;
        }

        .page {
            width: 100%;
            max-width: 850px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .symbol {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff8f00, #e65100);
            box-shadow: 0 15px 40px rgba(230, 81, 0, 0.22);
            color: #fff;
            font-size: 40px;
        }

        .organisation {
            font-size: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #d25b00;
            margin-bottom: 15px;
        }

        h1 {
            font-size: clamp(42px, 8vw, 78px);
            line-height: 1;
            color: #542b17;
            margin-bottom: 20px;
        }

        h1 span {
            color: #e86600;
        }

        .subtitle {
            max-width: 600px;
            margin: 0 auto;
            font-size: 18px;
            line-height: 1.7;
            color: #785a49;
        }

        .divider {
            width: 90px;
            height: 4px;
            border-radius: 10px;
            background: linear-gradient(90deg, #ff9800, #e65100);
            margin: 30px auto;
        }

        .maintenance-box {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 13px 22px;
            border: 1px solid rgba(230, 81, 0, 0.18);
            border-radius: 50px;
            background: rgba(255,255,255,0.65);
            box-shadow: 0 10px 30px rgba(90, 45, 20, 0.07);
            backdrop-filter: blur(10px);
            font-size: 14px;
            font-weight: 600;
            color: #71452d;
        }

        .dot {
            width: 9px;
            height: 9px;
            background: #ff7a00;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(255, 122, 0, 0.5);
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 122, 0, 0.45);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 122, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 122, 0, 0);
            }
        }

        .gujarati {
            margin-top: 35px;
            font-size: 17px;
            color: #8a5c43;
        }

        footer {
            margin-top: 55px;
            font-size: 13px;
            color: #aa8b78;
        }

        .circle {
            position: fixed;
            border-radius: 50%;
            z-index: 0;
            filter: blur(2px);
        }

        .circle.one {
            width: 280px;
            height: 280px;
            background: rgba(255, 167, 38, 0.08);
            top: -100px;
            left: -80px;
        }

        .circle.two {
            width: 350px;
            height: 350px;
            background: rgba(230, 81, 0, 0.06);
            right: -140px;
            bottom: -130px;
        }

        @media (max-width: 600px) {
            .symbol {
                width: 75px;
                height: 75px;
                font-size: 32px;
            }

            .organisation {
                font-size: 12px;
                letter-spacing: 2px;
            }

            .subtitle {
                font-size: 16px;
            }

            .gujarati {
                font-size: 15px;
            }

            footer {
                margin-top: 40px;
            }
        }
    </style>
</head>

<body>

    <div class="circle one"></div>
    <div class="circle two"></div>

    <main class="page">

        <div class="symbol">
            ॐ
        </div>

        <div class="organisation">
            Shree Modasa Ekda Dasha Khadayata
        </div>

        <h1>
            <span>Coming Soon.</span>
        </h1>

        <p class="subtitle">
            We'll be back soon.
        </p>

        <div class="divider"></div>

        <div class="maintenance-box">
            <span class="dot"></span>
            Website Coming Soon.
        </div>

        <div class="gujarati">
            વેબસાઈટ ટૂંક સમયમાં આપની સેવામાં ઉપલબ્ધ થશે.
        </div>

        <footer>
            &copy; <?php echo date('Y'); ?>
            Shree Modasa Ekda Dasha Khadayata Vastipatrak Samiti.
            All Rights Reserved.
        </footer>

    </main>

</body>
</html>