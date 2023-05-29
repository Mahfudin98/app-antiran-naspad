@extends('layouts.baseuser')
@section('title', 'Antrian & Order')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card">
            <div class="payment-details">
                <h3>Detail Pesanan</h3>
                <p>Lengkapi data diri dan cek kembali pesanan kamu.</p>
            </div>
            <div class="input-text">
                <input type="text" placeholder="Masukan nama kamu">
                <span>Nama</span>
            </div>
            <div class="input-text">
                <input type="text" placeholder="Masukan nomor HP">
                <span>Nomor HP</span>
            </div>
            <div class="summary">
                <div class="text-data">
                    <p>Subtotal</p>
                    <p>Discount</p>
                    <p>VAT(20%)</p>
                    <h5>Total</h5>
                </div>
                <div class="numerical-data">
                    <p>$19.00</p>
                    <p>$5.00</p>
                    <p>$2.80</p>
                    <h5>$16.80</h5>
                </div>
            </div>
            <div class="pay mb-3">
                <button>Pay</button>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');

        .card {
            height: auto;
            width: 340px;
            border-radius: 10px;
            background-color: #fff;
            padding: 0 20px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .payment-details {
            margin-top: 20px;
        }

        .payment-details p {
            font-size: 12px;
            font-weight: 700;
            color: #89898e;
        }

        .input-text {
            position: relative;
            margin-top: 30px;
        }

        input[type="text"] {

            height: 40px;
            width: 100%;
            border-radius: 5px;
            border: none;
            outline: 0;
            border: 1px solid #f6f6f7;
            padding: 0 10px;
            box-sizing: border-box;
            font-size: 12px;
        }

        .input-text span {
            position: absolute;
            top: -16px;
            left: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .input-text-cvv {
            position: relative;
        }

        .input-text-cvv input[type="text"] {
            height: 40px;
            width: 70px;
            border: none;

            border-bottom: 1px solid #f6f6f7;
            border-top: 1px solid #f6f6f7;
            position: absolute;
            top: -40px;
            right: 60px;
        }

        .cvv input[type="text"] {
            position: absolute;
            right: 0;
            border-right: 1px solid #f6f6f7;
        }

        .billing {
            margin-top: 30px;
            position: relative;
        }

        .billing span {
            font-size: 12px;
            font-weight: 700;
            position: absolute;
            top: -16px;
            left: 10px;
        }

        .billing select {
            height: 35px;
            width: 100%;
            font-size: 12px;
            outline: 0;
            padding-left: 5px;
            border: 1px solid #f6f6f7;
            cursor: pointer;
        }

        .billing select option:nth-child(1) {
            display: none;

        }

        .zip-state {
            display: flex;
            width: 100%;
        }

        .zip {
            width: 50%;
        }

        .zip input[type="text"] {
            height: 35px;
        }

        .state {
            width: 50%;
        }

        .summary {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .text-data p {
            margin-top: 3px;
            font-size: 12px;
            font-weight: 600;
        }

        .numerical-data p {
            margin-top: 3px;
            font-size: 12px;
            font-weight: 600;
        }

        .pay {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pay button {
            height: 40px;
            width: 100%;
            background-color: #7047eb;
            border: none;
            outline: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.5s;
        }

        .pay button:hover {
            background-color: blue !important;
        }

        .secure {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            /*text-align:center;*/
            color: #aeaebc;
        }

        .secure p {
            font-size: 12px;
            font-weight: 600;
            color: #aeaebc;
            margin-left: 5px;
        }

        .last {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: 700;
        }

        .last p {
            margin-right: 5px;
        }

        .last a {
            color: blue;
            text-decoration: none;
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
                const pattern = el.getAttribute("placeholder"),
                    slots = new Set(el.dataset.slots || "_"),
                    prev = (j => Array.from(pattern, (c, i) => slots.has(c) ? j = i + 1 : j))(0),
                    first = [...pattern].findIndex(c => slots.has(c)),
                    accept = new RegExp(el.dataset.accept || "\\d", "g"),
                    clean = input => {
                        input = input.match(accept) || [];
                        return Array.from(pattern, c =>
                            input[0] === c || slots.has(c) ? input.shift() || c : c
                        );
                    },
                    format = () => {
                        const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                            i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                            return i < 0 ? prev[prev.length - 1] : back ? prev[i - 1] || first : i;
                        });
                        el.value = clean(el.value).join``;
                        el.setSelectionRange(i, j);
                        back = false;
                    };
                let back = false;
                el.addEventListener("keydown", (e) => back = e.key === "Backspace");
                el.addEventListener("input", format);
                el.addEventListener("focus", format);
                el.addEventListener("blur", () => el.value === pattern && (el.value = ""));
            }
        });
    </script>
@endsection
