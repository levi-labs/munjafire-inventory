<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>$title</title>

    <style>
        body {
            margin: auto;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        header .header {
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .row {
            width: 100%;
            height: 140px;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .col-5 {
            width: 60%;
            height: 150px;
            justify-content: left;
            align-items: center;
            box-sizing: border-box;
            padding-right: 20%;
        }

        .col-5 h2 {
            margin: 2px 0;
            font-size: 2rem;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .text-left {
            text-align: left;
        }

        .text-item {
            text-align: center;
        }

        .logo {
            width: 300px;
            height: 100px;
        }

        .content-head p {
            margin: 4px 0;
        }

        .content-head {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .container-logo {
            width: 20%;
            text-align: center;
        }

        main {
            width: 100%;
            margin: auto;
        }

        table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        hr {
            border: 2px solid #000;
            /* border-top: 4px solid #000;
            border-bottom: 4px solid #000; */
            margin: 15px 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .btn-print {
                display: none;
            }

            header {
                padding: 0;
                position: relative;
            }

            .header {
                width: 100%;
                height: auto;
                /* padding: 10px; */
                background-color: #fff;
                /* border-bottom: 2px solid #000; */
            }

            .row {
                display: flex;
                justify-content: space-between;
                width: 100%;
                height: auto;
            }

            .col-5 {
                box-sizing: border-box;
                margin-left: 10%;
                width: 100%;
                height: auto;
            }

            .col-5 h2 {
                font-size: 1.2rem;
            }

            .content-head p {
                font-size: 0.8rem;
            }

            .logo {
                width: 245px;
                height: 80px;
            }

            .content-head {
                font-size: 1rem;
            }

            .container-logo {
                margin-top: -7%;
                width: 15%;
                text-align: left;
            }

            .main-content {
                margin-top: 0;
                padding: 10px 40px 40px 40px !important;
            }

            table {
                page-break-inside: auto;
                break-inside: auto;
            }

            tr,
            td,
            th {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            thead {
                display: table-header-group;
                /* ✅ agar header table muncul di setiap halaman */
            }

            tbody {
                display: table-row-group;
            }


        }
    </style>
</head>

<body>
    @include('print.header')
    <main>
        @yield('print-content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>

</html>
