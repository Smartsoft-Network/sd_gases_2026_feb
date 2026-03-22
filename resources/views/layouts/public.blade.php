<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/sdgases-logo.png') }}" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .whatsapp-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .whatsapp-popup {
            display: none;
            width: 280px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            animation: slideIn 0.3s ease-out;
        }

        .whatsapp-popup.active {
            display: block;
        }

        .whatsapp-popup-header {
            padding: 15px;
            text-align: center;
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
        }

        .whatsapp-popup-header h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
            font-weight: 700;
        }

        .whatsapp-popup-body {
            padding: 15px;
        }

        .whatsapp-number-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .whatsapp-number-item:hover {
            background: #f0f2f5;
            text-decoration: none;
        }

        .whatsapp-number-item svg {
            color: #25d366;
            margin-right: 15px;
        }

        .whatsapp-number-item span {
            color: #0084ff;
            font-weight: 600;
            font-size: 16px;
        }

        .whatsapp-popup-footer {
            padding: 15px;
            padding-top: 0;
            background: #fff;
        }

        .whatsapp-close-btn {
            display: block;
            width: 100%;
            padding: 8px;
            background: #4a69bd;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            transition: background 0.2s;
        }

        .whatsapp-close-btn:hover {
            background: #3c5496;
        }

        .whatsapp-float {
            width: 55px;
            height: 55px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            animation: whatsapp-main-pulse 2s infinite;
        }

        .whatsapp-close-icon {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 18px;
            height: 18px;
            background-color: #ffffff;
            color: #ff7f7f;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            cursor: pointer;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .whatsapp-container:hover .whatsapp-close-icon {
            opacity: 1;
            transform: scale(1);
        }

        .whatsapp-close-icon:hover {
            background-color: #e1e1e1;
            transform: scale(1.1) !important;
        }

        @keyframes whatsapp-main-pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }
        }

        .whatsapp-float::before,
        .whatsapp-float::after {
            content: '';
            position: absolute;
            border: 2px solid #25d36551;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            border-radius: 50%;
            animation: whatsapp-ring-pulse 2s linear infinite;
            opacity: 0;
            pointer-events: none;
        }

        .whatsapp-float::after {
            animation-delay: 1s;
        }

        @keyframes whatsapp-ring-pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
        }

        .whatsapp-float svg {
            width: 25px;
            height: 25px;
            fill: white;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-white" x-data="{ whatsappOpen: false, whatsappVisible: true }">
    <div class="min-h-screen flex flex-col">
        @include('layouts.header')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
    @include('partials.alerts')

    @php
        $whatsappNumbers = $generalData['whatsapp_numbers'] ?? [];
    @endphp

    @if (!empty($whatsappNumbers))
        <div class="whatsapp-container" x-show="whatsappVisible" style="display: none;">
            <!-- Popup -->
            <div class="whatsapp-popup" :class="{ 'active': whatsappOpen }">
                <div class="whatsapp-popup-header">
                    <h3>Inquiry Now</h3>
                </div>
                <div class="whatsapp-popup-body">
                    @foreach ($whatsappNumbers as $item)
                        @php
                            $number = $item['number'] ?? '';
                            $urlNumber = preg_replace('/[^0-9]/', '', $number);
                        @endphp
                        <a href="https://wa.me/{{ $urlNumber }}" target="_blank" class="whatsapp-number-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                            <div class="flex flex-col text-left">
                                @if (!empty($item['label']))
                                    <small class="text-gray-500 text-xs">{{ $item['label'] }}</small>
                                @endif
                                <span>{{ $number }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="whatsapp-popup-footer">
                    <button class="whatsapp-close-btn" @click="whatsappOpen = false">Close</button>
                </div>
            </div>

            <!-- Float Button -->
            <div class="whatsapp-float" @click="whatsappOpen = !whatsappOpen">
                <div class="whatsapp-close-icon" @click.stop="whatsappVisible = false">
                    <i class="fas fa-times"></i>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                    <path
                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                </svg>
            </div>
        </div>
    @endif
</body>

</html>
